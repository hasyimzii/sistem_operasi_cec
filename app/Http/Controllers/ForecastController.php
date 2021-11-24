<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $outlet = \App\Models\Outlet::where('id', '!=', 1)->get();
        return view('forecast.index',compact('outlet'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $stock = \App\Models\Stock::where('outlet_id', $id)->get();
        return view('forecast.list',compact('outlet','stock'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exponentialSmoothing($periode, $dataset)
    {
        // Adaptive Response Rate Single Exponential Smoothing
        // F[periode ke-t] = (alpha[t] * X[t]) + ((1 - alpha[t]) * F[t])
        $X = $dataset; // dataset
        $F = []; // peramalan
        $e = []; // error/kesalahan
        $E = []; // error dihaluskan
        $AE = []; //error absolut
        $alpha = []; // konstanta smoothing
        $beta = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9]; // range alpha
        $PE = []; // persentase error
        $MAPE = []; // rata rata kesalahan

        // perhitungan peramalan menggunakan nilai beta mulai dari 0.1 sampai 0.9
        for($i = 0; $i < count($beta); $i++) {
            // inisialisasi
            $F[$i][0] = $e[$i][0] = $E[$i][0] = $AE[$i][0] = $alpha[$i][0] = $PE[$i][0] = 0;
            $F[$i][1] = $X[0];
            $alpha[$i][1] = $beta[$i];

            for($j = 1; $j < count($periode); $j++){
                // perhitungan peramalan untuk periode berikutnya
                $F[$i][$j + 1] = ($alpha[$i][$j] * $X[$j]) + ((1 - $alpha[$i][$j]) * $F[$i][$j]);

                // menghitung selisih antara nilai aktual dengan hasil peramalan
                $e[$i][$j] = $X[$j] - $F[$i][$j]; 

                // menghitung nilai kesalahan peramalan yang dihaluskan
                $E[$i][$j] = ($beta[$i] * $e[$i][$j]) + ((1 - $beta[$i]) * $E[$i][$j - 1]);

                // menghitung nilai kesalahan absolut peramalan yang dihaluskan
                $AE[$i][$j] = ($beta[$i] * abs($e[$i][$j])) + ((1 - $beta[$i]) * $AE[$i][$j - 1]);

                // menghitung nilai alpha untuk periode berikutnya
                $alpha[$i][$j + 1] = $E[$i][$j] == 0 ? $beta[$i] : abs($E[$i][$j] / $AE[$i][$j]);

                // menghitung nilai kesalahan persentase peramalan
                $PE[$i][$j] = $X[$j] == 0 ? 0 : abs((($X[$j] - $F[$i][$j]) / $X[$j]) * 100);
            }

            // menghitung rata-rata kesalahan peramalan
            $MAPE[$i] = array_sum($PE[$i])/(count($periode) - 1);
        }
        
        // mendapatkan index beta dengan nilai mape terkecil
        $bestBetaIndex = array_search(min($MAPE), $MAPE);

        // menyatukan semua hasil perhitungan dan menginputkan hasil peramalan periode berikutnya
        $result = [];
        for ($i = 0; $i <= count($periode); $i++) {
            $result[$i] = round($F[$bestBetaIndex][$i]);
        }
        
        // masukkan hasil, beta, dan mape tebaik ke array
        $final = [
            'result' => $result,
            'last' => end($result),
            'mape' => $MAPE[$bestBetaIndex],
        ];
        
        return $final;
    }

    /**
     * Show the application dashboard.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function result(Request $request, $id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $stock = \App\Models\Stock::findOrFail($request->stock_id);

        // total sales orders grouped by month
        $totalSales = \App\Models\Order::selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m') as periode, SUM(orders.amount) as total")
            ->where('stock_id', $stock->id)
            ->join('sales', 'sales.id', '=', 'orders.sale_id')
            ->where('outlet_id', $outlet->id)
            ->groupBy('periode')->get();

        // all periode of sales
        $periode = \App\Models\Sale::selectRaw("DATE_FORMAT(sales.created_at, '%Y-%m') as periode")
            ->where('outlet_id', $outlet->id)
            ->groupBy('periode')->get();



        // check if product have sales
        $allSales = 0;
        $monthSales = [];
        foreach($totalSales as $data) {
            $allSales += $data['total'];
            $monthSales[] = $data['periode'];
        }
        if($allSales <= 0) {
            return back()->with('error', 'Produk masih belum pernah terjual!');
        }
        if(count($monthSales) <= 1) {
            return back()->with('error', 'Produk minimal harus terjual dalam 2 bulan!');
        }



        // sales per month for dataset
        $dataset = [];
        for($i=0; $i<count($periode); $i++) {
            for($j=0; $j<count($totalSales); $j++) {
                if($periode[$i]['periode'] == $totalSales[$j]['periode']){
                    $dataset[$i] = intval($totalSales[$j]['total']);
                    break;
                }else{
                    $dataset[$i] = 0;
                }
            }
        }
        
        // get periodes to array
        $month = [];
        for ($i = 0; $i <= count($periode); $i++) {
            if ($i < count($periode)) {
                $month[$i] = $periode[$i]['periode'];
            }
            else {
                $nextMonth = date('Y-m', strtotime("+1 month", strtotime(date($periode[$i-1]['periode']))));
                $month[$i] = $nextMonth;
            }
        }
        
        // result
        $exponentialSmoothing = $this->exponentialSmoothing($periode, $dataset);

        $forecast = $exponentialSmoothing['result'];
        $last = $exponentialSmoothing['last'];
        $mape = round($exponentialSmoothing['mape']);

        $ingredient = \App\Models\Ingredient::where('product_id', $stock->product->id)->get();
        return view('forecast.result',compact('outlet','stock','month','dataset','forecast','last','mape','ingredient'));
    }
}
