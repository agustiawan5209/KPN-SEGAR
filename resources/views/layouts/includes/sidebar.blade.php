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
                        <a class="@yield('datakepala')" href="{{ url('data-kepala') }}">
                            <i class="bi bi-circle"></i><span>sektretaris</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('Anggota')" href="{{ url('data-kepala') }}">
                            <i class="bi bi-circle"></i><span>Anggota</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
            <li class="nav-item flex-column">
                <a class="nav-link collapsed" @yield('asetbergerak') href="{{ route('barang') }}">
                    <i class="bi bi-journal-text"></i><span>Kelola Barang</span>
                </a>
            </li><!-- End Forms Nav -->

            <li class="nav-item flex-column">
                <a class="nav-link collapsed" data-bs-target="#potongan-nav" data-bs-toggle="collapse" href="@yield('potongan-nav')">
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
            </li><!-- End Forms Nav -->

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

@can('Anggota')
    <!-- ======= Sidebar Kepala Unit ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item flex-column @yield('components-nav')">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse">
                    <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse @yield('components-nav')" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class=" @yield('asalperolehan')" href="{{ url('dataasalperolehan') }}">
                            <i class="bi bi-circle"></i><span>Data Asal Perolehan</span>
                        </a>
                    </li>

                    <li>
                        <a class=" @yield('datasatuan')" href="{{ url('/datasatuan') }}">
                            <i class="bi bi-circle"></i><span>Data Satuan</span>
                        </a>
                    </li>

                    <li>
                        <a class=" @yield('jenisbarang')" href="{{ url('/jenisbarang') }}">
                            <i class="bi bi-circle"></i><span>Data Jenis Barang</span>
                        </a>
                    </li>
                    <li>
                        <a class=" @yield('lokasipenempatan')" href="{{ route('lokasi') }}">
                            <i class="bi bi-circle"></i><span>Data Lokasi</span>
                        </a>
                    </li>


                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item flex-column @yield('pembelian')">
                <a class="nav-link collapsed" data-bs-target="#pembelian" data-bs-toggle="collapse">
                    <i class="bi bi-menu-button-wide"></i><span>Data Pembelian</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pembelian" class="nav-content collapse @yield('pembelian')" data-bs-parent="#sidebar-nav">

                    {{-- <li>
                         <a class=" @yield('jenisaset')" href="{{ url('/datajenisaset') }}">
                             <i class="bi bi-circle"></i><span>Data Jenis Aset</span>
                         </a>
                     </li> --}}

                    <li>
                        <a class=" @yield('databunga')" href="{{ route('Pembelian.index') }}">
                            <i class="bi bi-circle"></i><span>Pembelian</span>
                        </a>
                    </li>
                    <li>
                        <a class=" @yield('databunga')" href="{{ route('Pembelian.data') }}">
                            <i class="bi bi-circle"></i><span>Riwayat Pembelian</span>
                        </a>
                    </li>




                </ul>
            </li><!-- End Forms Nav -->


            <li class="nav-item flex-column">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Pencatatan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="active" href="/pencatatan/barangmasuk">
                            <i class="bi bi-circle"></i><span>Stok Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a class="active" href="/pencatatan/barangkeluar">
                            <i class="bi bi-circle"></i><span>Stok/ Barang Keluar</span>
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
                        <a class="@yield('riwayat')" href="{{ url('/peminjaman/peminjaman') }}">
                            <i class="bi bi-circle"></i><span>Data Peminjaman</span>
                        </a>
                    </li>


                    <li>
                        <a class="@yield('riwayat')" href="{{ url('/peminjaman/riwayatpinjam') }}">
                            <i class="bi bi-circle"></i><span>Riwayat Peminjaman</span>
                        </a>
                    </li>


                </ul>
            </li><!-- End Icons Nav -->


        </ul>

    </aside><!-- End Sidebar Kepala unit-->
@endcan

@can('Pengguna')
    <!-- ======= Sidebar Peminjam ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{route('Pembelian.create')}}">
                    <i class="bi bi-cart-check-fill"></i>
                    <span> Pembelian</span>
                </a>
            </li>
            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{route('pinjamUang.index')}}">
                    <i class="bi bi-cart-check-fill"></i>
                    <span> Peminjaman Uang</span>
                </a>
            </li>
            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{route('staff/pinjam')}}">
                    <i class="bi bi-cart-check-fill"></i>
                    <span> Peminjaman Barang</span>
                </a>
            </li>





        </ul>

    </aside><!-- End Sidebar peminjam-->
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

            <li class="nav-item flex-column @yield('jenis-nav')">
                <a class="nav-link collapsed" data-bs-target="#jenis-nav" data-bs-toggle="collapse">
                    <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="jenis-nav" class="nav-content collapse @yield('jenis-nav')" data-bs-parent="#sidebar-nav">

                    {{-- <li>
                         <a class=" @yield('jenisaset')" href="{{ url('/datajenisaset') }}">
                             <i class="bi bi-circle"></i><span>Data Jenis Aset</span>
                         </a>
                     </li> --}}

                    <li>
                        <a class=" @yield('databunga')" href="{{ route('JenisBunga.index') }}">
                            <i class="bi bi-circle"></i><span>Data Bunga</span>
                        </a>
                    </li>




                </ul>
            </li><!-- End Forms Nav -->

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
                        <a class="@yield('datakepala')" href="{{ url('data-kepala') }}">
                            <i class="bi bi-circle"></i><span>bendahara</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->




            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{ route('staff/pinjam') }}">
                    <i class="bi bi-cart"></i>
                    <span>Peminjaman</span>
                </a>
            </li>

            <li class="nav-item flex-column ">
                <a class="nav-link collapsed" href="{{ route('staff/riwayat') }} ">
                    <i class="bi bi-cart-check-fill"></i>
                    <span>Riwayat Pembelian</span>
                </a>
            </li>





        </ul>

    </aside><!-- End Sidebar peminjam-->
@endcan
