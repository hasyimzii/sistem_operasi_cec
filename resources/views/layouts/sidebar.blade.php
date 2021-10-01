<!--**********************************
            Sidebar start
        ***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Menu</li>
            <!-- Admin Sidebar -->
            @php
                $user = auth()->user()
            @endphp
            @if($user->role->name == 'admin')
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-cart-9"></i>
                    <span class="nav-text">Penjualan</span>
                </a>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="icon icon-app-store"></i><span class="nav-text">Produk</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('product.index') }}">Data Produk</a></li>
                    <li><a href="{{ route('stock.index') }}">Stok Produk</a></li>
                    <li><a href="{{ route('category.index') }}">Kategori</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-wallet-90"></i>
                    <span class="nav-text">Keuangan</span>
                </a>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="icon icon-chart-bar-33"></i><span class="nav-text">Peramalan</span></a>
                <ul aria-expanded="false">
                    <li><a href="./index.html">Peramalan Penjualan</a></li>
                    <li><a href="./index2.html">Komposisi Produk</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('user.index') }}" class="has-arrow" class="has-arrow" aria-expanded="false"><i class="icon icon-users-mm"></i>
                    <span class="nav-text">Karyawan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('outlet.index') }}" class="has-arrow" aria-expanded="false"><i class="icon icon-home-minimal"></i>
                    <span class="nav-text">Outlet</span>
                </a>
            </li>
            <li>
                <a href="{{ route('history') }}" class="has-arrow" aria-expanded="false"><i class="icon icon-time-3"></i>
                    <span class="nav-text">Riwayat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.show', $user->id) }}" class="has-arrow" aria-expanded="false"><i class="icon icon-single-04"></i>
                    <span class="nav-text">Akun</span>
                </a>
            </li>

            <!-- User Sidebar -->
            @else
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-cart-9"></i>
                    <span class="nav-text">Penjualan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('stock.index') }}" class="has-arrow" aria-expanded="false"><i class="icon icon-app-store"></i>
                    <span class="nav-text">Stok Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('outlet.index') }}" class="has-arrow" aria-expanded="false"><i class="icon icon-home-minimal"></i>
                    <span class="nav-text">Outlet</span>
                </a>
            </li>
            <li>
                <a href="{{ route('history') }}" class="has-arrow" aria-expanded="false"><i class="icon icon-time-3"></i>
                    <span class="nav-text">Riwayat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.show', $user->id) }}" class="has-arrow" aria-expanded="false"><i class="icon icon-single-04"></i>
                    <span class="nav-text">Akun</span>
                </a>
            </li>
            @endif
        </ul>
    </div>


</div>
<!--**********************************
            Sidebar end
        ***********************************-->