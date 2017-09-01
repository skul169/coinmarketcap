@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Thống kê</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <div class="btn-group">
                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(array('route' => ['report.index'], 'method' => 'GET')) !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('from_date', 'Từ ngày:', ['class' => 'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {!! Form::text('from_date', old('from_date'), ['class' => 'form-control datepicker pull-right', 'placeholder' => '']) !!}
                    </div>
                </div>
            </div><!-- /.col -->
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('to_date', 'Đến ngày:', ['class' => 'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {!! Form::text('to_date', old('to_date'), ['class' => 'form-control datepicker pull-right', 'placeholder' => '']) !!}
                    </div>
                </div>
            </div><!-- /.col -->
            <div class="col-md-4">
                <div for="to_date" class="control-label" style="margin-bottom: 5px;">&nbsp;</div>
                <input class="btn btn-primary" type="submit" value="Tìm kiếm">
            </div>
        </div><!-- /.row -->
        {!! Form::close() !!}
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">
                    <strong>{!!old('from_date')!!} - {!!old('to_date')!!}</strong>
                </p>
                <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                </div><!-- /.chart-responsive -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- ./box-body -->
    <div class="box-footer">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="description-block border-right">
                    <h5 class="description-header">{{$countSmsMt}}</h5>
                    <span class="description-text">TOTAL MT</span>
                </div><!-- /.description-block -->
            </div>
        </div><!-- /.row -->
    </div><!-- /.box-footer -->
</div><!-- /.box -->


@endsection


@section('inpage-script')
<!-- FastClick -->
<script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('/plugins/chartjs/Chart.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript">
            $(function () {

            'use strict';
                    // Get context with jQuery - using jQuery's .get() method.
                    var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
                    // This will get the first returned node in the jQuery collection.
                    var salesChart = new Chart(salesChartCanvas);
                    var salesChartData = {
                    labels: {!!$key!!},
                            datasets: [
                            {
                            label: "MT",
                                    fillColor: "rgba(60,141,188,0.9)",
                                    strokeColor: "rgba(60,141,188,0.8)",
                                    pointColor: "#3b8bba",
                                    pointStrokeColor: "rgba(60,141,188,1)",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "rgba(60,141,188,1)",
                                    data: {!!$mt_data!!}
                            }
                            ]
                    };
                    var salesChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                            //Boolean - Whether grid lines are shown across the chart
                            scaleShowGridLines: false,
                            //String - Colour of the grid lines
                            scaleGridLineColor: "rgba(0,0,0,.05)",
                            //Number - Width of the grid lines
                            scaleGridLineWidth: 1,
                            //Boolean - Whether to show horizontal lines (except X axis)
                            scaleShowHorizontalLines: true,
                            //Boolean - Whether to show vertical lines (except Y axis)
                            scaleShowVerticalLines: true,
                            //Boolean - Whether the line is curved between points
                            bezierCurve: true,
                            //Number - Tension of the bezier curve between points
                            bezierCurveTension: 0.3,
                            //Boolean - Whether to show a dot for each point
                            pointDot: false,
                            //Number - Radius of each point dot in pixels
                            pointDotRadius: 4,
                            //Number - Pixel width of point dot stroke
                            pointDotStrokeWidth: 1,
                            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                            pointHitDetectionRadius: 20,
                            //Boolean - Whether to show a stroke for datasets
                            datasetStroke: true,
                            //Number - Pixel width of dataset stroke
                            datasetStrokeWidth: 2,
                            //Boolean - Whether to fill the dataset with a color
                            datasetFill: true,
                            //String - A legend template
                            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
                            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                            maintainAspectRatio: true,
                            //Boolean - whether to make the chart responsive to window resizing
                            responsive: true
                    };
                    //Create the line chart
                    salesChart.Line(salesChartData, salesChartOptions);
                    });

    $(function () {
        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy',
        });
    });
    $(function () {
        $(".select2").select2();
    });
</script>
<!-- AdminLTE for demo purposes -->

@endsection