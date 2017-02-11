<div class="col-md-offset-3 col-md-12 col-xs-12 widget widget_tally_box">
    <div style="margin-bottom:10%;"class="x_panel ui-ribbon-container">
        <div class="x_title">
            <h2>Success</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <h3 class="name_title">Added to Class</h3>
            <div class="divider"></div>
            <div style="text-align: center;">
                <span class="chart" >
                    <p>Added: {{$name}} <br/><br/> To {{$class}} <br/><br/> On {{$date}} </p>
                    {{--<canvas height="110" width="110"></canvas>--}}
                </span>
            </div>

            <center>
                <button onclick="window.location ='{{url('/attend')}}'" type="button" class="btn btn-round btn-success">Add Another</button>
            </center>

        </div>
    </div>
</div>

