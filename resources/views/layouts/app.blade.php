<!DOCTYPE html>
<html lang="en">

@php
    $settings = App\Models\Settings::get()->keyBy('key');
@endphp

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings['site_sys_name']->value ? $settings['site_sys_name']->value : 'Rental System' }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon"
        href="{{ $settings['site_logo']->value ? asset('storage/' . $settings['site_logo']->value) : asset('images/logo.png') }}" />
    <script src="//unpkg.com/alpinejs" defer></script>

    @stack('header-script')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('partials.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('partials.sidebar')
            <!-- partial -->
            <div class="main-panel">

                <div class="content-wrapper">

                    @include('partials.alert')

                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="text-center" style="font-size:12px">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.
                            {{ $settings['site_name']->value }}. All rights
                            reserved. </span>
                        <span class="float-none mt-1 mt-sm-0 text-center"> Developed & made with<i
                                class="ti-heart text-danger mr-1 ml-1"></i></span> by {{ config('app.developer') }}
                    </div>
                </footer>

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/dataTables.select.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <!-- endinject -->

    <script>
        $(document).ready(function() {
            // Retrieve the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Set the CSRF token in the request headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        });
    </script>

    @stack('footer-script')

</body>

</html>
