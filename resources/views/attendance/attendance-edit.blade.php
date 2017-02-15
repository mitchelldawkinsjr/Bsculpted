@extends('layouts.blank')

@push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main" style="min-height: 3734px;">
        @if(Session::has('message'))
            {!! Session::get('message') !!}
        @endif
        <div class="page-title">
            <div class="title_left">
                <h3>Class Attendance</h3>
            </div>

            <div class="title_right">
                <h4>BSculpted LLC </h4>
            </div>
        </div>
        @include('attendance.includes.attendance-widget-input')
        @include('attendance.includes.class-type-widget')
        @include('attendance.includes.attendance-filter-display')

    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            © 2017 BSculpted, LLC All Rights Reserved
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->

@endsection