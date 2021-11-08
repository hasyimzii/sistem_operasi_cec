@extends('layouts.app')

@section('title', 'Hasil Peramalan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Hasil Peramalan</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('forecast.list', $outlet->id) }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<!-- forecast -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Peramalan Penjualan Produk {{ $stock->product->name }}</h4>
            </div>
            <div class="card-body">
                <div class="panel">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ingredient -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Peramalan Kebutuhan Komposisi Produk {{ $stock->product->name }} Bulan Depan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display text-muted" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Nama Komposisi</th>
                                <th>Komposisi per Produksi</th>
                                <th>Jumlah Kebutuhan Bulan Depan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ingredient as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->amount }} {{ $data->unit }}</td>
                                    <td>{{ ($data->amount * $last) }} {{ $data->unit }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Highchart -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('chart', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Hasil Peramalan (MAPE = {{ $mape }}%)'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
        },
        xAxis: {
            categories: {!! json_encode($month) !!},
        },
        yAxis: {
            title: {
                text: 'Total Penjualan'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' unit'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'Penjualan',
            data: {!! json_encode($dataset) !!}
        }, {
            name: 'Peramalan',
            data: {!! json_encode($forecast) !!}
        }]
    });
</script>
@endsection