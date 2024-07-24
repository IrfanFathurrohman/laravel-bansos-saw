<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPK Bansos</title>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css')}}">
    <script src="{{ asset('asset/js/jquery.min.js')}}"></script>
    <script src="{{ asset('asset/js/jquery.chained.min.js')}}"></script>
    <style>
        body {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
           @include('home.navbar')
        </nav>
        <div class="row">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('asset/js/bootstrap.min.js')}}"></script>
</body>
</html>
