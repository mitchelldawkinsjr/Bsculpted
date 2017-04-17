<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>All Clients<small>double click to edit client info</small></h2>
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

        <table id="client-table" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="hide" rowspan="1" colspan="1" aria-label="" style="width: 16px;">Attendance_id</th>
                <th>Barcode Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Date Added</th>
                <th>Admin</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th class="hide" rowspan="1" colspan="1" aria-label="" style="width: 16px;">Attendance_id</th>
                <th>Barcode Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Class</th>
                <th>Date Added</th>
                <th>Admin</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($clients as $client)
                <tr class="odd">
                    <td>{{$client->client_id}}</td>
                    <td>{{$client->first_nm}}</td>
                    <td>{{$client->last_nm}}</td>
                    <td>{{$client->email_nm}}</td>
                    <td>{{$client->created}}</td>
                    <td>{{$client->admin}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="dt-buttons btn-group">
                <a id="btn-del-client" class="btn-del btn btn-default buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>Delete Selected</span></a>
                {{--<a id="btn-del-client" data-toggle="modal" data-target="#myModal" class="btn-del btn btn-default buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>Edit Selected</span></a>--}}
            </div>
        </div>

        @include('clients.includes.modal')

    </div>
</div>
