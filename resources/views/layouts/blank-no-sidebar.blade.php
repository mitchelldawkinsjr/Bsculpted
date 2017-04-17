<!DOCTYPE html>
<html lang="en">

<head>
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="shortcut icon" href="http://bsculpted.com/home/storage/logo-smaller.png" type="image/x-icon">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bsculpted Dashboard</title>

    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script src="{{ asset("js/beep.js") }}"></script>

    <!-- Bootstrap -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset("css/green.css") }}" rel="stylesheet">

    @stack('stylesheets')

</head>

<body class="nav-md">
<div class="container">
    <div style="margin-top:20vh;" class="panel panel-default col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <div class="panel-body">
            @include('includes/sidebar2')

            @yield('main_container')
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset("js/jquery.min.js") }}"></script>
<!-- Bootstrap -->
<script src="{{ asset("js/bootstrap.min.js") }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset("js/gentelella.min.js") }}"></script>

@stack('scripts')

</body>
</html>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<style>
    .ui-helper-hidden-accessible{
        color: #fff;
        font-size: 2em;
        margin: 0 auto;
        text-align: center;
    }
</style>