@extends('coinmarketcap')

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

    <script>
        var coin_id = '{{$coin_info->tokens[1]}}';
        var url = 'http://socket.coincap.io';
        var socket = io(url, {
            'secure': true,
            'reconnect': true,
            'reconnection delay': 5000,
            'max reconnection attempts': 10
        });

        socket.on('trades', function (tradeMsg) {
            if (tradeMsg.message.coin == coin_id) {
                $("#market_cap_id").html("$" + formatNumber(tradeMsg.message.msg.mktcap));
                $("#quote_price").html("$" + formatNumber(tradeMsg.message.msg.price));
                $("#supply_id").html(formatNumber(tradeMsg.message.msg.supply) + " " + tradeMsg.message.msg.short);
                $("#volumn_24h_id").html("$" + formatNumber(tradeMsg.message.msg.usdVolume));
                $("#quote_percent_change").html(' (' + tradeMsg.message.msg.cap24hrChange + '%)');
                if (tradeMsg.message.msg.cap24hrChange >= 0) {
                    $("#quote_percent_change").removeClass('negative_change').addClass('positive_change');
                } else {
                    $("#quote_percent_change").removeClass('positive_change').addClass('negative_change');
                }
            }
        });
    </script>
@endsection


@section('main-content')
    <div id="top-nav-outer-container" role="navigation">
        <div class="row">
            <div id="top-nav-inner-container" class="container">
                <div class="hidden-xs col-sm-3">
                    <div id="global-stats-counts" class="small"></div>
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div id="global-stats-values" class="small">
                        <ul class="list-inline stat-counters">
                            Market Cap: <strong><a href="/">${{number_format($global->total_market_cap_usd)}}</a></strong>
                            <li>
                                / 24h Vol: <strong><a href="/">${{number_format($global->total_24h_volume_usd)}}</a></strong>
                                / BTC Dominance: <strong><a href="/">{{$global->bitcoin_percentage_of_market_cap}}%</a></strong>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hidden-xs col-sm-2 text-right">
                    <div id="twitter-follow" class="pull-right">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                <h1 id="title"><a href="/">CryptoCurrency Market Capitalizations</a></h1>
                <hr/>
                <nav id="nav-main" class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="/" class="dropdown-toggle" data-toggle="dropdown">Market Cap <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/">All</a></li>
                                    <li><a href="/">Currencies</a></li>
                                    <li><a href="/">Assets</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form action="/currencies/search/" class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <span class="twitter-typeahead" style="position: relative; display: inline-block; direction: ltr;"><input type="text" id="quick-search-box" class="form-control js-quick-search tt-input" placeholder="Search Currencies" name="q" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none; right: auto;"><div class="tt-dataset-currencies"></div></span></span>
                                <button class="btn btn-primary hidden-sm hidden-md hidden-lg" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                            <button class="btn btn-primary hidden-xs" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </form>
                        <div class="bottom-margin-1x hidden-sm hidden-md hidden-lg"></div>
                    </div>
                </nav>
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
                        <span id="quote_percent_change" class="text-large @if($coin_detail->percent_change_24h < 0)negative_change @else positive_change @endif ">({{$coin_detail->percent_change_24h}}%)</span>
                        <br>
                        <small class="text-gray">{{$coin_detail->price_btc}} BTC</small>
                        <small class="@if($coin_detail->percent_change_1h < 0) negative_change @else positive_change @endif"> ({{$coin_detail->percent_change_1h}}%)</small>
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
                    <div class="hidden-xs hidden-sm col-md-4 text-left">
                        <a href="http://b-eth.com/buy" target="_blank">
                            <div class="btn btn-primary">
                                <span class="glyphicon glyphicon-flash"></span> Buy instantly with credit card
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row bottom-margin-2x">
                    <div class="col-xs-4 col-sm-4">
                        <ul class="list-unstyled">
                            @if(isset($json_config->$coinname->website))
                                <li>
                                    <span class="glyphicon glyphicon-link text-gray" title="Website"></span>
                                    <a href="{{$json_config->$coinname->website}}" target="_blank">Website</a>
                                </li>
                            @endif
                            @if(isset($json_config->$coinname->website2))
                                <li>
                                    <span class="glyphicon glyphicon-link text-gray" title="Website"></span>
                                    <a href="{{$json_config->$coinname->website2}}" target="_blank">Website 2</a>
                                </li>
                            @endif
                            @if(isset($json_config->$coinname->explorer))
                                <li>
                                    <span class="glyphicon glyphicon-search text-gray" title="Explorer"></span>
                                    <a href="{{$json_config->$coinname->explorer}}" target="_blank">Explorer</a>
                                </li>
                            @endif
                            @if(isset($json_config->$coinname->explorer2))
                                <li>
                                    <span class="glyphicon glyphicon-search text-gray" title="Explorer"></span>
                                    <a href="{{$json_config->$coinname->explorer2}}" target="_blank">Explorer 2</a>
                                </li>
                            @endif
                            @if(isset($json_config->$coinname->message_board))
                                <li>
                                    <span class="glyphicon glyphicon-list text-gray" title="Message Board"></span>
                                    <a href="{{$json_config->$coinname->message_board}}" target="_blank">Message Board</a>
                                </li>
                            @endif
                            @if(isset($json_config->$coinname->message_board2))
                                <li>
                                    <span class="glyphicon glyphicon-list text-gray" title="Message Board"></span>
                                    <a href="{{$json_config->$coinname->message_board2}}" target="_blank">Message Board 2</a>
                                </li>
                            @endif
                            @if(isset($json_config->$coinname->rank))
                                <li>
                                    <span class="glyphicon glyphicon glyphicon-star text-gray" title="Rank"></span>
                                    <small><span class="label label-success"> {{$json_config->$coinname->rank}}</span></small>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-xs-8 col-sm-8">
                        <div class="coin-summary-item col-xs-6  col-md-3">
                            <div class="coin-summary-item-header">
                                <h3>Market Cap</h3>
                            </div>
                            <div class="coin-summary-item-detail">
                                <a id="market_cap_id">${{number_format($coin_detail->market_cap_usd)}}</a><br>
                                <span class="text-gray">{{number_format($coin_detail->market_cap_usd/($coin_detail->price_usd/$coin_detail->price_btc))}} BTC</span> <br>
                            </div>
                        </div>

                        <div class="coin-summary-item col-xs-6  col-md-3">
                            <div class="coin-summary-item-header">
                                <h3>Volume (24h)</h3>
                            </div>
                            <div class="coin-summary-item-detail">
                                <?php $index_name = '24h_volume_usd'; ?>
                                <a id="volumn_24h_id">${{number_format($coin_detail->$index_name)}}</a><br>
                                <span class="text-gray">{{number_format($coin_detail->$index_name/($coin_detail->price_usd/$coin_detail->price_btc))}} BTC</span>

                            </div>
                        </div>

                        <div class="vertical-spacer col-xs-12 hidden-md hidden-lg"></div>

                        <div class="coin-summary-item col-xs-6  col-md-3">
                            <div class="coin-summary-item-header">
                                <h3>Circulating Supply</h3>
                            </div>
                            <div class="coin-summary-item-detail">
                                <a id="supply_id">{{number_format($coin_detail->total_supply)}} {{$coin_info->tokens[1]}}</a>
                            </div>
                        </div>
                        <div class="coin-summary-item col-xs-6  col-md-3 ">
                            <div class="coin-summary-item-header">
                                <h3>Max Supply</h3>
                            </div>
                            <div class="coin-summary-item-detail">
                                21,000,000 {{$coin_info->tokens[1]}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bottom-margin-1x">
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs text-left" role="tablist">
                            <li class="active"><a href="#charts" role="tab" data-toggle="tab"> <span
                                            class="glyphicon glyphicon-stats text-gray"></span> Charts </a></li>
                            @if(isset($json_config->$coinname->buy))
                                <li>
                                    <a href="{{$json_config->$coinname->buy}}">
                                        <span class="glyphicon glyphicon-import text-gray"></span> Buy
                                    </a>
                                </li>
                            @endif
                            @if(isset($json_config->$coinname->sell))
                                <li>
                                    <a href="{{$json_config->$coinname->sell}}">
                                        <span class="glyphicon glyphicon-export text-gray"></span> Sell
                                    </a>
                                </li>
                            @endif
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
                                <div class="hidden-xs hidden-sm col-md-4 text-left">
                                    <a href="http://b-eth.com/buy" target="_blank">
                                        <div class="btn btn-primary"><span class="glyphicon glyphicon-flash"></span> Buy {{$coin_info->name}}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="social" class="tab-pane">
                            <div class="tab-header">
                                <div class="hidden-xs hidden-sm col-md-4 text-left">
                                    <a href="http://b-eth.com/sell" target="_blank">
                                        <div class="btn btn-primary"><span class="glyphicon glyphicon-flash"></span> Sell {{$coin_info->name}}</div>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div id="footer" class="row">
                    <div class="col-xs-12 col-md-6">&copy; 2017 TotalCoinMarket
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
