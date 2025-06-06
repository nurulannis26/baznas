<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- into js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/intro.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/intro.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/intro.min.js.map"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs-rtl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs-rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs-rtl.min.css.map">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs.min.css.map">
    <script src="https://cdn.jsdelivr.net/npm/intro.js@6.0.0/intro.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intro.js@6.0.0/intro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intro.js@6.0.0/intro.module.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js@6.0.0/introjs.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js@6.0.0/introjs-rtl.css">
    <script src="https://cdn.bootcdn.net/ajax/libs/intro.js/6.0.0/intro.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/intro.js/6.0.0/intro.min.js"></script>
    <link href="https://cdn.bootcdn.net/ajax/libs/intro.js/6.0.0/introjs-rtl.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/intro.js/6.0.0/introjs-rtl.min.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/intro.js/6.0.0/introjs.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/intro.js/6.0.0/introjs.min.css" rel="stylesheet">
    <!-- intro js end -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">




    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            overflow-x: hidden;
        }

        .select2-selection {
            min-height: 38px !important;
        }

        .select2-selection__arrow {
            min-height: 38px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #28a745 !important;
            color: #ffffff !important;
            /* Use white color for better contrast with green background */
            border: #28a745 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff !important;
        }
    </style>
    <title>E-DISDAY</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/baznas.png') }}">
    @include('template.css')

    @yield('css')
    @livewireStyles
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">


    <div class="wrapper">
        <!-- Navbar -->
        @include('template.nav')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('template.side')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        {{-- @include('template.footer') --}}
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('template.js')

    @yield('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    @livewireScripts
    @stack('script')
    @stack('cart-js-internal-pc')
    @stack('script-permohonan')
    @stack('filter_umum_upzis')
    @stack('filter_umum_ranting')
    @stack('filter_gabungan')



    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
        });

        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail.message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });
    </script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"

            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>


    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>


</body>

<script>
    $(document).ready(function() {
        $('#nav-tab a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>
{{-- 
<script>
    $.cookie('last-scroll-top', $(window).scrollTop());
    document.location.reload(true);

    var lastScrollTop = $.cookie('last-scroll-top');
    if (lastScrollTop) {
        $(window).scrollTop(lastScrollTop);
        $.removeCookie('last-scroll-top');
    }
</script> --}}


<script>
    // $(document).ready(function() {
    //     $('.select2dulu').select2();
    // });
</script>
<script>
    // $('#id_program_pilars').on('change', function() {
    //     var s = $("#id_program_pilars").val();
    //     var x = '{{ url('/jenis-program/') }}';
    //     var a = x + '/' + s;
    //     $('#jenis_program').select2({
    //         ajax: {
    //             url: a,
    //             dataType: 'json',
    //             processResults: function(data) {
    //                 return {
    //                     results: data.items
    //                 }
    //             }
    //         }
    //     });
    // });
</script>


</html>
