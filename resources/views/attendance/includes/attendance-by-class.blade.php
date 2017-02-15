<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo date('F');?> Attendance<small>by class </small> </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            @foreach($attendanceByClass as $class)
                <article class="media event">
                    <a class="pull-left date">
                        {{--<p class="month">April</p>--}}
                        <p class="day">{{$class->count}}</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">{{$class->class_name}}</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</div>
