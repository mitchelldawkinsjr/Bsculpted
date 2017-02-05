@extends('layouts.blank')

@push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main" style="min-height: 3734px;">
        <div class="page-title">
            <div class="title_left">
                <h3>Class Attendance</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="disabled" placeholder="BSculpted LLC">
                        <span class="input-group-btn">
                      <button class="hide" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        @include('includes/attendance-widget-input')
        @include('includes/class-type-widget')
        @include('includes/attendance-filter-display')
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            All Rights Reserved Bsculpted LLC 2016
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->

@endsection