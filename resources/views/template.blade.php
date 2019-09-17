<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siswaku</title>

    <link rel="stylesheet" href="{{ asset('bootstrap-3_3_6/css/bootstrap.min.css')}}">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('style.css')}}" rel="stylesheet"> --}}
</head>
<body>
    <div class="container">
        @include('navbar')
        @yield('main')
    </div>
    @include('footer')
    
<script src="{{ asset('js/jquery_2_2_1.min.js')}}"></script>
<script src="{{ asset('bootstrap-3_3_6/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/siswakuapp.js')}}"></script>

</body>
</html>