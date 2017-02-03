@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i>Total Clients</span>
                <div class="count">{{$totalClients}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i>Total Classes Attended</span>
                <div class="count">{{$totalClasses}}</div>
                <span class="count_bottom">This Month</span>
            </div>
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-user"></i> Total Males</span>--}}
                {{--<div class="count green">2,500</div>--}}
                {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
            {{--</div>--}}
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-user"></i> Total Females</span>--}}
                {{--<div class="count">4,567</div>--}}
                {{--<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>--}}
            {{--</div>--}}
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-user"></i> Total Collections</span>--}}
                {{--<div class="count">2,315</div>--}}
                {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
            {{--</div>--}}
            {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
                {{--<span class="count_top"><i class="fa fa-user"></i> Total Connections</span>--}}
                {{--<div class="count">7,325</div>--}}
                {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
            {{--</div>--}}
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    {{--<footer>--}}
        {{--<div class="clearfix"></div>--}}
    {{--</footer>--}}
    <!-- /footer content -->
@endsection