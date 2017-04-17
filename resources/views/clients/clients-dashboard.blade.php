@extends('layouts.blank')

@push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        @if(Session::has('message'))
            {!! Session::get('message') !!}
        @endif
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-female"></i></div>
                    <div class="count">{{$totalClients}}</div>
                    <h3>Total Clients</h3>
                </div>
            </div>
        </div>
    @include('clients.includes.client-insert')
    @include('clients.includes.client-filter-display')

    </div>

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            © 2017 BSculpted, LLC All Rights Reserved
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->

@endsection
