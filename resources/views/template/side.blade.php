<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('images/baznas.png') }}" class="brand-image " style="opacity: .8">
        <span class="brand-text font-weight-bold">E-DISDAY</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <div class="text-center">
            <h5 class="btn-hilang mt-4">BAZNAS CILACAP</p>
            </h5>
            <span class="btn-hilang">Nurul Annisa</span><br>
            <span class="m-0 badge badge-success badge-sm badge-hilang" style="border-radius: 10px">

                <marquee behavior="" scrolldelay="300" direction="" class="pt-1">
                    Kepala Cabang
                </marquee>
            </span><br>
            <a class="btn btn-white btn-sm btn-hilang"><i class="fas fa-cog"></i>
                <p> Pengaturan</p>
            </a>

            <a href="/logout" class="btn btn-white btn-sm btn-hilang"><i class="fa fa-sign-out-alt"></i>
                <p> Keluar</p>
            </a>
        </div>


        <hr>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                {{-- <li class="nav-item  @yield('dashboard') ">
                    <a href="/{{ $role }}/dashboard" class="nav-link  @yield('dashboard') card-dashboard">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li> --}}
                <li class="nav-header">E-Disday</li>

                <li class="nav-item">
                    <a href="{{ route('permohonan') }}" class="nav-link @yield('permohonan')">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Data Permohonan
                        </p>
                    </a>
                </li>


                <li class="nav-header mt-1">Data Master</li>
                {{-- pc (program) --}}
                <li class="nav-item">
                    <a href="{{ route('program') }}" class="nav-link @yield('program')">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Data Program
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pengurus') }}" class="nav-link @yield('pengurus')">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Data Pengurus
                        </p>
                    </a>
                </li>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
