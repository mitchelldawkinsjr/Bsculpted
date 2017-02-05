@extends('layouts.blank-no-sidebar')

@push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div>
        @include('includes/attendance-widget-input')
    </div>
    <!-- /page content -->

    <!-- footer content -->
    @include('includes/footer');
    <!-- /footer content -->
@endsection