<!DOCTYPE html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bsculpted Dashboard</title>

        <script src="{{ asset("js/jquery.min.js") }}"></script>

        <!-- Bootstrap -->
        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">
        <!-- ICheck Style -->
        <link href="{{ asset("css/green.css") }}" rel="stylesheet">
        <!-- DataTables-bs-.net Style -->
        <link href="{{ asset("css/dataTables.bootstrap.min.css") }}" rel="stylesheet">
        @stack('stylesheets')

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                @include('includes/sidebar')

                @include('includes/topbar')

                @yield('main_container')

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset("js/jquery.min.js") }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("js/bootstrap.min.js") }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset("js/gentelella.min.js") }}"></script>
        <!-- Icheck Scripts -->
        <script src="{{ asset("js/icheck.js") }}"></script>
        <script src="{{ asset("js/icheck.min.js") }}"></script>
        <!-- Datatables Scripts -->
        <script src="{{ asset("js/jquery.dataTables.js") }}"></script>
        <script src="{{ asset("js/jquery.dataTables.min.js") }}"></script>
        <!-- DataTables-bs Scripts -->
        <script src="{{ asset("js/dataTables.bootstrap.js") }}"></script>
        <script src="{{ asset("js/dataTables.bootstrap.min.js") }}"></script>
        <!-- Public Scripts -->
        <script src="{{ asset("js/public.js") }}"></script>
        @stack('scripts')

    </body>
</html>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>