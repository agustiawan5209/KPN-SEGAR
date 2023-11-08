@can('Pengurus')
    <!-- ======= Sidebar Admin ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">


            <li class="nav-item flex-column {{ request()->is('redirects*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item flex-column">
                <a class="nav-link collapsed" data-bs-target="#formss-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Data User</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="formss-nav" class="nav-content collapse @yield('formss-nav')" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="@yield('datauser')" href="{{ url('data-user') }} ">
                            <i class="bi bi-circle"></i><span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('dataadmin')" href="{{ url('data-admin') }}">
                            <i class="bi bi-circle"></i><span>Petugas</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('datakepala')" href="{{ url('data-Anggota') }}">
                            <i class="bi bi-circle"></i><span>sektretaris</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('Anggota')" href="{{ url('data-Anggota') }}">
                            <i class="bi bi-circle"></i><span>Anggota</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
            <li class="nav-item flex-column">
                <a class="nav-link collapsed" @yield('asetbergerak') href="{{ route('jenis-barang') }}">
                    <i class="bi bi-journal-text"></i><span>Katalog Barang</span>
                </a>
            </li><!-- End Forms Nav -->
            </li><!-- End Forms Nav -->
            <li class="nav-item flex-column">
                <a class="nav-link collapsed" @yield('asetbergerak') href="{{ route('barang') }}">
                    <i class="bi bi-journal-text"></i><span>Kelola Barang</span>
                </a>
            </li><!-- End Forms Nav -->

            {{-- <li class="nav-item flex-column">
                <a class="nav-link collapsed" data-bs-target="#potongan-nav" data-bs-toggle="collapse"
                    href="@yield('potongan-nav')">
                    <i class="bi bi-person"></i><span>Data Diskon/Promo</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="potongan-nav" class="nav-content collapse @yield('potongan-nav')" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="@yield('diskonli')" href="{{ route('Diskon.index') }} ">
                            <i class="bi bi-circle"></i><span>Diskon</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('promoli')" href="{{ route('Promo.index') }} ">
                            <i class="bi bi-circle"></i><span>Promo</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('voucherli')" href="{{ route('Voucher.index') }} ">
                            <i class="bi bi-circle"></i><span>Voucher</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!-- End Forms Nav -->

            <li class="nav-item flex-column">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse"
                    href="@yield('charts-nav')">
                    <i class="bi bi-bar-chart @yield('charts-nav')"></i><span>Pencatatan</span><i
                        class="bi bi-chevron-down ms-auto @yield('charts-nav')"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse  @yield('charts-nav')" data-bs-parent="#sidebar-nav">

                    <li>
                        <a class="@yield('barangmasuk')" href="{{ url('/barang-masuk') }}">
                            <i class="bi bi-circle"></i><span>Stok Masuk</span>
                        </a>
                    </li>

                    <li>
                        <a class="@yield('barangkeluar')" href="{{ url('/barang-keluar') }}">
                            <i class="bi bi-circle"></i><span>Stok Keluar</span>
                        </a>
                    </li>




                </ul>
            </li><!-- End Charts Nav -->
            <li class="nav-item flex-column">
                <a class="nav-link collapsed" data-bs-target="#iconss-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-cart" @yield('iconss-nav')></i><span>Data Transaksi</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="iconss-nav" class="nav-content collapse" @yield('iconss-nav') data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="@yield('riwayat')" href="{{ route('Pembelian.index') }}">
                            <i class="bi bi-circle"></i><span>Data Pembelian</span>
                        </a>
                    </li>


                    <li>
                        <a class="@yield('riwayat')" href="{{ url('/peminjaman/riwayatpinjam') }}">
                            <i class="bi bi-circle"></i><span>Riwayat Pembelian</span>
                        </a>
                    </li>


                </ul>
            </li><!-- End Icons Nav -->


            <li class="nav-item flex-column {{ request()->is('redirects*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="{{ url('/laporan/menu') }}">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    <span>Laporan</span>
                </a>
            </li>
        </ul>

    </aside><!-- End Sidebar Admin-->
@endcan

@can('Bendahara')
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <!-- End Forms Nav -->
            <li class="nav-item flex-column">
                <a class="nav-link collapsed @yield('pinjam')" href="{{ url('data-Anggota') }}">
                    <i class="bi bi-person"></i><span>Data Anggota</span></i>
                </a>
            </li><!-- End Forms Nav -->
            <li class="nav-item flex-column">
                <a class="nav-link collapsed" data-bs-target="#pinjam-uang-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Data Pinjaman Uang</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pinjam-uang-nav" class="nav-content collapse @yield('pinjam-uang-nav')" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="@yield('uanglinkCreate')" href="{{ route('pinjamUang.create') }}">
                            <i class="bi bi-cart"></i>
                            <span>Buat Peminjaman</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('uanglinkCreate')" href="{{ route('pinjamUang.index') }}">
                            <i class="bi bi-cart"></i>
                            <span>Data Pinjaman Uang</span>
                        </a>
                    </li>

                    <li>
                        <a class="@yield('riwayat')" href="{{ route('pinjamUang.riwayat') }}">
                            <i class="bi bi-circle"></i><span>Riwayat Peminjaman</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item flex-column">
                <a class="nav-link collapsed " data-bs-target="#pinjam-barang-nav" data-bs-toggle="collapse"
                    href="@yield('pinjam-barang-nav')">
                    <i class="bi bi-cart"></i><span>Data Pinjaman Barang</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pinjam-barang-nav" class="nav-content collapse @yield('pinjam-barang-nav')"  data-bs-parent="#sidebar-nav">

                    <li >
                        <a class=" @yield('pinjambarangcek') " href="{{ route('cekdata') }}">

                            <span>Buat Peminjaman Barang</span>
                        </a>
                    </li>
                    <li>
                        <a  class=" @yield('pinjam')" href="{{ route('staff/peminjaman') }} ">
                            <i class="bi bi-cart-check-fill"></i>
                            <span>Data Peminjaman Barang</span>
                        </a>
                    </li>
                    <li>
                        <a  class=" @yield('pinjam')" href="{{ route('staff/riwayat') }} ">
                            <i class="bi bi-cart-check-fill"></i>
                            <span>Riwayat Peminjaman Barang</span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>

    </aside><!-- End Sidebar peminjam-->
@endcan


@can('Pengguna')
    <!-- ======= Sidebar Peminjam ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{ route('dashboardUser') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{ route('Pembelian.index') }}">
                    <i class="bi bi-cart-check-fill"></i>
                    <span> Pembelian</span>
                </a>
            </li>
            @can('Anggota')
                <li class="nav-item flex-column @yield('pembelian')">
                    <a class="nav-link collapsed" data-bs-target="#pembelian" data-bs-toggle="collapse">
                        <i class="bi bi-menu-button-wide"></i><span>Data Simpanan</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="pembelian" class="nav-content collapse @yield('pembelian')" data-bs-parent="#sidebar-nav">
                        <li>
                            <a class=" @yield('databunga')" href="{{ route('simpanan.index') }}">
                                <i class="bi bi-circle"></i><span>Data Simpanan</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Forms Nav -->
                <li class="nav-item flex-column">
                    <a class="nav-link collapsed" data-bs-target="#iconss-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-cart" @yield('iconss-nav')></i><span>Data Pinjaman</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="iconss-nav" class="nav-content collapse" @yield('iconss-nav') data-bs-parent="#sidebar-nav">
                        <li>
                            <a class="@yield('riwayat')" href="{{ route('pinjamUang.riwayat') }}">
                                <i class="bi bi-circle"></i><span>Riwayat Peminjaman Uang</span>
                            </a>
                        </li>


                        <li>
                            <a class="@yield('riwayat')" href="{{ route('riwayat-peminjaman') }}">
                                <i class="bi bi-circle"></i><span>Riwayat Peminjaman Barang</span>
                            </a>
                        </li>


                    </ul>
                </li><!-- End Icons Nav -->
            @endcan

        </ul>

    </aside><!-- End Sidebar peminjam-->
@endcan
