<div class="col-md-6">
    <div class="x_panel">
        <div class="x_title">
            <h2>Top Clients<small><?php echo date('F');?> Attendance </small> </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            @foreach($topClients as $client)
                <article class="media event">
                    <a class="pull-left date">
                        {{--<p class="month">April</p>--}}
                        <p class="day">{{$client->count}}</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">{{$client->first_nm}} {{$client->last_nm}}</a>
                    </div>
                </article>

            @endforeach
        </div>
    </div>
</div>
