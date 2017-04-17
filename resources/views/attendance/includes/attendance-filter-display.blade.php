<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Attendance Records</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
            <br/>
            <br/>

            <table id="attendance-table" class="display table-striped table-bordered dataTable" cellspacing="0" width="100%">
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
                    {{--<a id="#csv" class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>CSV</span></a>--}}
                    <a id="btn-del1" class=" btn-del btn btn-default buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>Delete Selected</span></a>
                </div>
            </div>
        </div>
    </div>
