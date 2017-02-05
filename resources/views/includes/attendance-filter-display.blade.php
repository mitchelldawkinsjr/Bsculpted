<div class="alert alert-success ui-pnotify" aria-live="assertive" aria-role="alertdialog" id="notify" style="position:fixed;width:20%;z-index:1;top:20px;right:20px;cursor: auto;">
    <div class="alert ui-pnotify-container ui-pnotify-shadow" role="alert" style="min-height: 16px;"><div class="ui-pnotify-closer" aria-role="button" tabindex="0" title="Close" style="cursor: pointer; visibility: hidden; display: none;">
            <span class="glyphicon glyphicon-remove"></span></div><div class="ui-pnotify-sticker" aria-role="button" aria-pressed="true" tabindex="0" title="Unstick" style="cursor: pointer; visibility: hidden; display: none;">
            <span class="glyphicon glyphicon-play" aria-pressed="true"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-info-sign"></span>
        </div>
        <h4 class="ui-pnotify-title">Success</h4>
        <div class="ui-pnotify-text" aria-role="alert">{{$notification}}</div>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Attendance Records</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    {{--<ul class="dropdown-menu" role="menu">--}}
                        {{--<li><a href="#">Settings 1</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#">Settings 2</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        {{--<div class="x_content">--}}
            {{--<div id="datatable-checkbox_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-sm-12">--}}
                        {{--<table id="datatable-2" class="table table-striped table-bordered bulk_action dataTable no-footer" role="grid" aria-describedby="datatable-checkbox_info">--}}
                            {{--<thead>--}}
                            {{--<tr role="row">--}}
                                {{--<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 12px;"></th>--}}
                                {{--<th class="sorting" tabindex="0" aria-controls="datatable-checkbox" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 182px;">Name</th>--}}
                                {{--<th class="sorting" tabindex="0" aria-controls="datatable-checkbox" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 294px;">Class</th>--}}
                                {{--<th class="sorting" tabindex="0" aria-controls="datatable-checkbox" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 136px;">Date</th>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr role="row" class="odd">--}}
                                {{--<td>--}}
                                {{--</td>--}}
                                {{--<td value="">name</td>--}}
                                {{--<td value="">name</td>--}}
                                {{--<td value="">erfgtrdf</td>--}}
                            {{--</tr>--}}

                            {{--<tr role="row" class="odd">--}}
                                {{--<td>--}}
                                {{--</td>--}}
                                {{--<td value="">name</td>--}}
                                {{--<td value="">name</td>--}}
                                {{--<td value="">erfgtrdf</td>--}}
                            {{--</tr>--}}

                            {{--<tr role="row" class="odd">--}}
                                {{--<td>--}}
                                {{--</td>--}}
                                {{--<td value="">name</td>--}}
                                {{--<td value="">name</td>--}}
                                {{--<td value="">erfgtrdf</td>--}}
                            {{--</tr>--}}
                            {{--@foreach($unfilteredAttendance as $attend)--}}
                            {{--<tr role="row" class="odd">--}}
                                {{--<td>--}}
                                {{--</td>--}}
                                    {{--<td value="">{{$attend->first_nm}},{{$attend->last_nm}}</td>--}}
                                    {{--<td value="">{{$attend->class_name}}</td>--}}
                                    {{--<td value="">{{$attend->created}}</td>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                        {{--<div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">--}}
                            {{--<div class="dt-buttons btn-group">--}}
                                {{--<a class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>CSV</span></a>--}}
                                {{--<a id="btn-test" class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>Delete Selected</span></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
            <br/>
            <br/>

            <table id="attendance-table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="hide" rowspan="1" colspan="1" aria-label="" style="width: 16px;">Attendance_id</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="hide" rowspan="1" colspan="1" aria-label="" style="width: 16px;">Attendance_id</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Date</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($unfilteredAttendance as $attend)
                    <tr class="odd">
                        <td class="hide">{{$attend->attendance_id}}</td>
                        <td>{{$attend->first_nm}},{{$attend->last_nm}}</td>
                        <td>{{$attend->class_name}}</td>
                        <td>{{$attend->created}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="dt-buttons btn-group">
                    <a id="#csv" class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>CSV</span></a>
                    <a class=" btn-del btn btn-default buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>Delete Selected</span></a>
                </div>
            </div>
        </div>
    </div>

<script>
    var message = $('.ui-pnotify-text').html().split(',');
    var explode = function(){
        $('#notify').hide();
    };
   if(message[0] == 'Success')
   {
       $('.ui-pnotify-text').html((message[2]+' was added to '+(message[1]+' class.')));
       $('#notify').show();
   }else if(message[0] == 'Removal')
   {
       $('.ui-pnotify-text').html(message[1]);
       $('#notify').show();
   }else{
        $('#notify').hide();
   }
</script>