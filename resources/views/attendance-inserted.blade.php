@extends('layouts.blank-no-sidebar')

@push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        @include('includes/attendance-widget-success')
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
    </footer>
    <!-- /footer content -->
@endsection