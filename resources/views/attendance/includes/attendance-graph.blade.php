<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Yearly Class Attendance<small>Month By Month</small></h2>
                <div class="filter">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>January 12, 2017 - February 10, 2017</span> <b class="caret"></b>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="demo-container" style="width:100%;height:280px">
                        <div id="attendance_chart" class="demo-placeholder" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1168px; height: 280px;" width="1168" height="280"></canvas>
                            {{--<div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 130px; top: 264px; left: 140px; text-align: center;">Jan 02</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 130px; top: 264px; left: 307px; text-align: center;">Jan 03</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 130px; top: 264px; left: 475px; text-align: center;">Jan 04</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 130px; top: 264px; left: 642px; text-align: center;">Jan 05</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 130px; top: 264px; left: 809px; text-align: center;">Jan 06</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 130px; top: 264px; left: 977px; text-align: center;">Jan 07</div></div>--}}
                            {{--<div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 252px; left: 13px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 232px; left: 7px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 213px; left: 7px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 194px; left: 7px; text-align: right;">30</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 174px; left: 7px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 155px; left: 7px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 136px; left: 7px; text-align: right;">60</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 116px; left: 7px; text-align: right;">70</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 97px; left: 7px; text-align: right;">80</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 78px; left: 7px; text-align: right;">90</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 58px; left: 1px; text-align: right;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 39px; left: 1px; text-align: right;">110</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 20px; left: 1px; text-align: right;">120</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">130</div></div>--}}
                        </div>
                    </div>
                </div>

                {{--<div class="col-md-3 col-sm-12 col-xs-12">--}}
                    {{--<div>--}}
                        {{--<div class="x_title">--}}
                            {{--<h2>Top Profiles</h2>--}}
                            {{--<ul class="nav navbar-right panel_toolbox">--}}
                                {{--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
                                {{--</li>--}}
                                {{--<li class="dropdown">--}}
                                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                                    {{--<ul class="dropdown-menu" role="menu">--}}
                                        {{--<li><a href="#">Settings 1</a>--}}
                                        {{--</li>--}}
                                        {{--<li><a href="#">Settings 2</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li><a class="close-link"><i class="fa fa-close"></i></a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                        {{--<ul class="list-unstyled top_profiles scroll-view">--}}
                            {{--<li class="media event">--}}
                                {{--<a class="pull-left border-aero profile_thumb">--}}
                                    {{--<i class="fa fa-user aero"></i>--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<a class="title" href="#">Ms. Mary Jane</a>--}}
                                    {{--<p><strong>$2300. </strong> Agent Avarage Sales </p>--}}
                                    {{--<p> <small>12 Sales Today</small>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="media event">--}}
                                {{--<a class="pull-left border-green profile_thumb">--}}
                                    {{--<i class="fa fa-user green"></i>--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<a class="title" href="#">Ms. Mary Jane</a>--}}
                                    {{--<p><strong>$2300. </strong> Agent Avarage Sales </p>--}}
                                    {{--<p> <small>12 Sales Today</small>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="media event">--}}
                                {{--<a class="pull-left border-blue profile_thumb">--}}
                                    {{--<i class="fa fa-user blue"></i>--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<a class="title" href="#">Ms. Mary Jane</a>--}}
                                    {{--<p><strong>$2300. </strong> Agent Avarage Sales </p>--}}
                                    {{--<p> <small>12 Sales Today</small>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="media event">--}}
                                {{--<a class="pull-left border-aero profile_thumb">--}}
                                    {{--<i class="fa fa-user aero"></i>--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<a class="title" href="#">Ms. Mary Jane</a>--}}
                                    {{--<p><strong>$2300. </strong> Agent Avarage Sales </p>--}}
                                    {{--<p> <small>12 Sales Today</small>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="media event">--}}
                                {{--<a class="pull-left border-green profile_thumb">--}}
                                    {{--<i class="fa fa-user green"></i>--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<a class="title" href="#">Ms. Mary Jane</a>--}}
                                    {{--<p><strong>$2300. </strong> Agent Avarage Sales </p>--}}
                                    {{--<p> <small>12 Sales Today</small>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
        </div>
    </div>
</div>