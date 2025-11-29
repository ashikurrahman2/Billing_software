<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Ninja | @yield('title')</title>
    @include('frontend.layouts.style')
</head>
<body>
    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.script')

</body>
</html>