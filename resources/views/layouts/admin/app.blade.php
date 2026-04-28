<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>mitra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta name="author" content="Themesberg">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('Assets-Admin/assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('Assets-Admin/assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('Assets-Admin/assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('Assets-Admin/assets/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('Assets-Admin/assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    @include('layouts.admin.css')
</head>

<body>

    @include('layouts.admin.sidebar')

    <main class="content">

        @include('layouts.admin.navbar')


        @yield('content')


        @include('layouts.admin.footer')
    </main>


    @include('layouts.admin.js')
</body>

</html>