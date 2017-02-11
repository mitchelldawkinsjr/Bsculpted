@extends('layouts.blank-no-sidebar')

@push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div>
        @include('attendance.includes.attendance-widget-input')
            <ol>
                <li>Begin typing client name</li>
                <li>Auto-Complete will begin to search after first 3 letters</li>
                <li>Once name appears select it and add this person to a class</li>

            </ol>
        @if(Session::has('message'))
            {!! Session::get('message') !!}
        @endif
    </div>
    <!-- /page content -->

    <!-- footer content -->
    @include('includes/footer')
    <!-- /footer content -->
@endsection