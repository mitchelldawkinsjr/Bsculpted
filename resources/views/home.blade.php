@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-female"></i></div>
                    <div class="count">{{$totalClients}}</div>
                    <h3>Total Clients</h3>
                    <p>Sign Up More </p>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-star"></i></div>
                    <div class="count">{{$totalClasses}}</div>
                    <h3>Total Classes Attended</h3>
                    <p><?php echo date('F');?></p>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-trophy"></i></div>
                    <div class="count">
                        @if ($topClass)
                            @foreach($topClass as $class)
                                {{$class->count}}
                            @endforeach
                        @endif
                    </div>
                    <h3>
                        @if ($topClass)
                            @foreach($topClass as $class)
                                {{$class->class_name}}
                            @endforeach
                        @endif
                    </h3>
                    <p>Top Attended Class Of <?php echo date('F');?></p>
                </div>
            </div>
        </div>
        @include('attendance.includes.top-client')
        @include('attendance.includes.attendance-by-class')
        @include('attendance.includes.attendance-graph')

    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            All Rights Reserved BSculpted LLC 2016
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
@endsection