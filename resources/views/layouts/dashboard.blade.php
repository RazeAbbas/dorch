<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js') }}"
        crossorigin="anonymous"></script>

    {{-- favicon icon --}}
    <link rel="icon" type="image/x-icon" href="{{asset('images/123.png')}}">

    @if (isset($page))
        @if ($page == 'dashboard')
            <link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
            <link rel="stylesheet"
                href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
            <link href="{{ asset('file_resources/upload.css') }}" rel="stylesheet" />
        @endif
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title }}</title>
</head>

<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ url('/dashboard') }}">Dorch</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    @if (Auth::user()->role  == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('dashboard/employee') }}">Manage Users</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard/document') }}">Manage Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard/document/search') }}">Doc Search</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('assets/images/avatar-1.jpg') }}" alt=""
                                class="user-avatar-md rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <h5 class="dropdown-header">{{Auth::user()->name}}</h5>
                            <a class="dropdown-item" href="{{url('dashboard/employee/profile')}}"><i class="fas fa-user mr-2"></i>Account</a>
                            {{-- <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a> --}}
                            <a class="dropdown-item" href="{{ url('user/logout') }}"><i
                                    class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="mt-5">
        <div class="container-fluid dashboard-content">
            @yield('breadcrums')
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    @if (isset($page))
        @if ($page == 'dashboard')
            <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
            <script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
            <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
            <script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
            <script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
            <script src="{{ asset('assets/libs/js/dashboard-ecommerce.js') }}"></script>
        @endif
    @endif


    <div class="footer fixed-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 ">
                    Copyright © 2024 <a href="{{ url('https://www.dixeam.com') }}">Dixeam</a>.
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 ">
                    <div class="text-md-right footer-links d-none d-sm-block">
                        <a href="javascript: void(0);">Site Map</a>
                        {{-- <a href="javascript: void(0);">Support</a> --}}
                        <a href="javascript: void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('script')
</body>

<!-- Toastr JavaScript -->
<script src="{{ asset('file_resources/toastr.js') }}"></script>
<script src="{{ asset('file_resources/file_upload.js') }}"></script>

<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    @endif
</script>

<script>
    // Initialize Toastr
    toastr.options = {
        "closeButton": true,
        'timeOut': 2000,
        "positionClass": "toast-top-right", // Set the position
        "preventDuplicates": true, // Prevent duplicate toasts
        "showMethod": "slideDown",
        // Additional options...
    };
</script>

</html>
<script src="https://dixeam.com/cdn/basejs/3.0/base.js"></script>
<script type="text/javascript">
    baseJS.init({
        "site_url": "{{ url('/') }}",
        "current_url": "{{ url()->current() }}",
        "lang": "en"
    });
</script>
