/**
 * Created by ussignalmitchelldawkins on 2/4/17.
 */
$(document).ready(function() {
    var year = new Date().getFullYear();

    var attendance_chart_settings = {
        grid: {
            show: true,
            aboveData: true,
            color: "#3f3f3f",
            labelMargin: 10,
            axisMargin: 0,
            borderWidth: 0,
            borderColor: null,
            minBorderMargin: 5,
            clickable: true,
            hoverable: true,
            autoHighlight: true,
            mouseActiveRadius: 100
        },
        series: {
            lines: {
                show: true,
                fill: true,
                lineWidth: 2,
                steps: false
            },
            points: {
                show: true,
                radius: 4.5,
                symbol: "circle",
                lineWidth: 3.0
            }
        },
        legend: {
            position: "ne",
            margin: [0, -25],
            noColumns: 0,
            labelBoxBorderColor: null,
            labelFormatter: function(label, series) {
                return label + '&nbsp;&nbsp;';
            },
            width: 40,
            height: 1
        },
        colors: ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'],
        shadowSize: 0,
        tooltip: true,
        tooltipOpts: {
            content: "%s: %y.0",
            xDateFormat: "%d/%m",
            shifts: {
                x: -30,
                y: -50
            },
            defaultTheme: false
        },
        yaxis: {
            min: 0
        },
        xaxis: {
            mode: "time",
            minTickSize: [1, "month"],
            timeformat: "%m/%d/%y"
        }
    };

    if(year > 2017)
    {
        var arr_data1 = [];
    } else {
        var arr_data1 = [
            [gd(year, 1, 1), 30],
            [gd(year, 2, 1), 15]
        ];
    }

    var graphExists = document.getElementById("attendance_chart");

    if(graphExists)
    {
        $.getJSON( "/attendance/graph", function( data ){
            $.each(data, function (key, val) {
                arr_data1.push([gd(year,val[key].month,1),val[key].count]);
            });
        }).done(function(){$.plot( $("#attendance_chart"), [arr_data1],  attendance_chart_settings )});

        if($("#attendance_chart").get(0)){
            $.plot( $("#attendance_chart"), [arr_data1],  attendance_chart_settings );
        }
    }



    prepareTables($('#attendance-table'),'/attendance/delete',$('#btn-del1'));
    prepareTables($('#class-type-table'),'/attendance/class-type-delete',$('#btn-del2'));
    prepareTables($('#client-table'),'/clients/delete-client',$('#btn-del-client'));

    function prepareTables($tableSelector,$route,buttonId)
    {
        var table = $tableSelector.DataTable({});

        table.on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

        $('#client-table tbody tr').dblclick(function () {
            var row = table.row( this ).data();
            var client = [];
            $.each(row, function (key, val) {
                client.push(val);
            });
            $('#client-id').val(client[0]);
            $('#first-name').val(client[1]);
            $('#last-name').val(client[2]);
            $('#email').val(client[3]);
            $('#myModal').modal('show');
        } );

        buttonId.on('click',function () {
            var allData = table.rows('.selected').data();

            console.log(allData);

            var jsonData = [];
            for(var x = 0; x < table.rows('.selected').data().length; x++) {
                var list = {};
                list = {
                    id: allData[x][0],
                    name: allData[x][1],
                    class: allData[x][2],
                    date: allData[x][3]
                };
                jsonData.push(list);
            }
            console.log(jsonData);
            $.ajax({
                method: 'GET',
                url: $route,
                data : {data : jsonData},
                success:function(data){
                    console.log(data);
                    if($route == '/attendance/delete' || $route == '/attendance/class-type-delete')
                        document.location.href = '/attendance/edit';
                    if($route == '/clients/delete-client')
                        document.location.href = '/clients/dashboard';
                }
            });
        });
    }

    $('#myModal').modal('hide');


    // //instantiate a Pusher object with our Credential's key
    // var pusher = new Pusher('b0c3172ec1b6dc846846');
    // //Subscribe to the channel we specified in our Laravel Event
    // var channel = pusher.subscribe('status-update');
    // //Bind a function to a Event (the full Laravel class)
    // channel.bind('App\\Events\\Status', addMessage);
    // console.log('after');
});

