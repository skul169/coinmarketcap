@extends('appindex')

@section('htmlheader_title')
    Home
@endsection

@section('inpage-script')
    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="//code.highcharts.com/highcharts.js"></script>
    <script src="//code.highcharts.com/modules/exporting.js"></script>
    <script>
        Highcharts.chart('highcharts-graph', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '{{$coin_info->name}} chart'
            },
            subtitle: {
//                text: document.ontouchstart === undefined ?
//                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Exchange rate'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Price (USD)',
                data: {{$data_json}}
            }]
        });
    </script>
@endsection


@section('main-content')
    <style>
        body {
            font-family: Arial !important;
        }
        .text-large {
            font-size: 28px;
            line-height: 1.1;
        }
        .negative_change {
            color: #d14836;
        }
        .positive_change {
            color: #093;
        }
    </style>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
            <div id="title">
                <a href="/">CryptoCurrency Market Capitalizations</a>
            </div>
            <hr>
            <div class="row bottom-margin-1x">
                <div class="col-xs-6 col-sm-4 col-md-4">
                    <h1 class="text-large">
                        <img src="https://files.coinmarketcap.com/static/img/coins/32x32/{{$coinname}}.png"
                                class="currency-logo-32x32" alt="{{$coin_info->name}}"> {{$coin_info->name}}
                        <small class="bold">({{$coin_info->tokens[1]}})</small>
                    </h1>
                </div>
                <div class="col-xs-6 col-sm-8 col-md-4 text-left">
                    <span class="text-large" id="quote_price">${{$coin_detail->price_usd}}</span>
                    <span class="text-large  positive_change ">({{$coin_detail->percent_change_24h}}%)</span>
                    <br>
                    <small class="text-gray">{{$coin_detail->price_btc}} BTC</small>
                    <small class=" positive_change "> ({{$coin_detail->percent_change_1h}}%)</small>
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-12 col-sm-12 hidden-md hidden-lg text-left">--}}
                            {{--<!-- Mobile Button -->--}}
                            {{--<a href="https://changelly.com/exchange/BTC/BCC/1?ref_id=coinmarketcap" target="_blank">--}}
                                {{--<div class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-flash"></span> Buy--}}
                                    {{--/ Sell Instantly--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="row bottom-margin-2x">
                <div class="col-xs-4 col-sm-4">
                </div>
                <div class="col-xs-8 col-sm-8">
                    <div class="coin-summary-item col-xs-6  col-md-3">
                        <div class="coin-summary-item-header">
                            <h3>Market Cap</h3>
                        </div>
                        <div class="coin-summary-item-detail">
                            ${{number_format($coin_detail->market_cap_usd)}} <br>
                            <span class="text-gray">{{number_format($coin_detail->market_cap_usd/($coin_detail->price_usd/$coin_detail->price_btc))}} BTC</span> <br>
                        </div>
                    </div>

                    <div class="coin-summary-item col-xs-6  col-md-3">
                        <div class="coin-summary-item-header">
                            <h3>Volume (24h)</h3>
                        </div>
                        <div class="coin-summary-item-detail">
                            <?php $index_name = '24h_volume_usd'; ?>
                            ${{number_format($coin_detail->$index_name)}}<br>
                            <span class="text-gray">{{number_format($coin_detail->$index_name/($coin_detail->price_usd/$coin_detail->price_btc))}} BTC</span>

                        </div>
                    </div>

                    <div class="vertical-spacer col-xs-12 hidden-md hidden-lg"></div>

                    <div class="coin-summary-item col-xs-6  col-md-3">
                        <div class="coin-summary-item-header">
                            <h3>Circulating Supply</h3>
                        </div>
                        <div class="coin-summary-item-detail">
                            {{number_format($coin_detail->total_supply)}} BCH
                        </div>
                    </div>
                    {{--<div class="coin-summary-item col-xs-6  col-md-3 ">--}}
                        {{--<div class="coin-summary-item-header">--}}
                            {{--<h3>Max Supply</h3>--}}
                        {{--</div>--}}
                        {{--<div class="coin-summary-item-detail">--}}
                            {{--21,000,000 BCH--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="row bottom-margin-1x">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs text-left" role="tablist">
                        <li class="active"><a href="#charts" role="tab" data-toggle="tab"> <span
                                        class="glyphicon glyphicon-stats text-gray"></span> Charts </a></li>
                        <li><a href="#markets" role="tab" data-toggle="tab"><span
                                        class="glyphicon glyphicon-transfer text-gray"></span> Markets </a></li>
                        <li><a href="#social" role="tab" data-toggle="tab"><span
                                        class="glyphicon glyphicon-globe text-gray"></span> Social </a></li>
                        <li><a href="#tools" role="tab" data-toggle="tab"><span
                                        class="glyphicon glyphicon-wrench text-gray"></span> Tools </a></li>
                        <li><a href="#"><span
                                        class="glyphicon glyphicon-calendar text-gray"></span> Historical Data </a></li>
                    </ul>
                </div>
                <div class="col-xs-12 tab-content">
                    <div id="charts" class="tab-pane active">
                        <div class="tab-header">
                            <div id="highcharts-loading" class="text-center" style="display: none;">Loading data from
                                server...
                                <div><span class="loading"></span></div>
                            </div>
                            <div id="highcharts-nodata" class="hidden text-center">No chart data found</div>
                            <div class="clear"></div>
                        </div>
                        <div id="highcharts-graph" style="min-width: 310px; height: 600px; margin: 0 auto">
                        </div>
                    </div>
                    <div id="markets" class="tab-pane">
                        <div class="tab-header">
                            <h2 class="pull-left">{{$coin_info->name}} Markets</h2><br>
                        </div>
                    </div>
                    <div id="social" class="tab-pane">
                        <div class="tab-header">
                            <h2 class="pull-left">{{$coin_info->name}} Social Media Feeds</h2>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div id="tools" class="tab-pane">
                        <div class="tab-header">
                            <h2 class="pull-left">Tools for {{$coin_info->name}}</h2>
                            <div class="clear bottom-margin-1x"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
