<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', 'Dashboard')</title>
    @include('inc.header')
</head>
<body class="login-page bg-body-secondary">

    @yield('content')

    @include('inc.footer')
</body>
</html>
