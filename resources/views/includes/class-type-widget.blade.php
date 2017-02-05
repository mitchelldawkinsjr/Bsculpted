<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Add/Remove Class Types</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <br/>
        <table id="class-type-table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="hide" rowspan="1" colspan="1" aria-label="" style="width: 16px;">class_type_id</th>
                    <th>Class Name</th>
                    <th>Created</th>
                    <th>Disabled</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide" rowspan="1" colspan="1" aria-label="" style="width: 16px;">class_type_id</th>
                    <th>Class Name</th>
                    <th>Created</th>
                    <th>Disabled</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($classTypes as $class)
                <tr class="odd">
                    <td class="hide">{{$class->class_type_id}}</td>
                    <td>{{$class->class_name}}</td>
                    <td>{{$class->created}}</td>
                    <td>{{$class->disabled}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br/>
        <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="dt-buttons btn-group">
                <a id="btn-add" class="btn btn-default buttons-html5 btn-sm" data-toggle="modal" data-target="#addClass" aria-controls="datatable-buttons"><span>Add Class Type</span></a>
                <a  class="btn-del btn btn-default buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span>Delete Selected</span></a>
            </div>
        </div>
        <div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/attendance/add-class" method="get">
                        <div class="modal-body">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class Name<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="class_name" name="class_name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button name="submit" type="submit" value="Submit" id="save" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
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
        $('#notify').show().setTimeout(explode, 2000);
    }else if(message[0] == 'Removal')
    {
        $('.ui-pnotify-text').html(message[1]);
        $('#notify').show();
    }else{
        $('#notify').hide();
    }
</script>