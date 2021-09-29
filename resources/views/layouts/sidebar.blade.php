<!--**********************************
            Sidebar start
        ***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Menu</li>
            <!-- Admin Sidebar -->
            @if(auth()->user()->role_id == 1)
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-cart-9"></i>
                    <span class="nav-text">Penjualan</span>
                </a>
            </li>
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-app-store"></i>
                    <span class="nav-text">Stok</span>
                </a>
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
                <a href="#" class="has-arrow" class="has-arrow" aria-expanded="false"><i class="icon icon-users-mm"></i>
                    <span class="nav-text">Karyawan</span>
                </a>
            </li>
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-home-minimal"></i>
                    <span class="nav-text">Outlet</span>
                </a>
            </li>
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-single-04"></i>
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
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-app-store"></i>
                    <span class="nav-text">Stok</span>
                </a>
            </li>
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-home-minimal"></i>
                    <span class="nav-text">Outlet</span>
                </a>
            </li>
            <li>
                <a href="#" class="has-arrow" aria-expanded="false"><i class="icon icon-single-04"></i>
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