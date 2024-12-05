<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title ?? 'Inix App' }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    {{-- style --}}
    @include('layouts.be_style')
    @stack('styles')
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        {{-- navbar top --}}
        @include('layouts.components.be_navbar')

    </header><!-- End Header -->

    {{-- sidebar --}}
    @include('layouts.components.be_sidebar')

    {{-- contents main --}}
    <div class="my-4">
        @yield('content')
    </div>

    {{-- script --}}
    @include('layouts.be_script')

    @stack('scripts')

</body>

</html>
