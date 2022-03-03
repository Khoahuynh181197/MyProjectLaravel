<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@include('admin.layouts.my_title')</title>   
    @include('admin.layouts.my_css')
</head>
<body>
    @include('admin.layouts.header')
    @include('admin.layouts.menu')
    @yield('content') 
    @include('admin.layouts.my_script')
</body>
</html>