@extends('app')

@section('htmlheader_title')
Quảng cáo
@endsection


@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Danh sách quảng cáo</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="{{ (app('request')->input('type') == null || app('request')->input('type') == 'buy')?'active':'' }}"><a href="{{url('userads?type=buy')}}">Quảng cáo mua</a></li>
                <li class="{{ (app('request')->input('type') == 'sell')?'active':'' }}"><a href="{{url('userads?type=sell')}}">Quảng cáo bán</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane {{ (app('request')->input('type') == null || app('request')->input('type') == 'buy')?'active':'' }}" id="buy">
                    <div class="row table-responsive">
                        <div class="col-sm-12 col-xs-12">
                            <b>Dư Mua: {{$totalBuy}}</b> BTC <br />
                            <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Ads</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Status</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userads_buy as $aBuyer)
                                    <tr role="row" class="odd">
                                        <td class="">
                                                  <p>
                                                    <div class="offer-body">
                                                        <offer-price offer="vm.offer" class="ng-isolate-scope" style="color:#f7931a;">
                                                            <strong class="offer-price" ng-class="vm.offer.offer_type == 'buy' ? 'text-danger':'text-success'">
                                                                <span ng-bind="vm.formattedPrice" class="ng-binding">{{number_format($aBuyer->price(),0, ',', '.')}} {{$aBuyer->currency->code}}</span>/<span ng-bind="vm.unit" ng-class="vm.isBtc ? 'text-btc-color':'text-primary'" class="ng-binding text-btc-color">BTC</span></strong>
                                                        </offer-price>
                                                        <span translate-once="via">{{trans('btcbank.via')}}</span> <span ng-switch="::vm.offer.payment_method"><!-- ngSwitchWhen: local_bank -->
                                                            <span ng-bind="::vm.offer.payment_descriptions" ng-switch-when="local_bank" class="ng-binding ng-scope">{{$aBuyer->bank->name}}</span><!-- end ngSwitchWhen: --><!-- ngSwitchDefault:  --></span>
                                                    </div>
                                                </p>
                                                <p><i><strong><span ng-bind="vm.offer.max_amount" class="ng-binding">{{$aBuyer->realquantity_to()}}</span> BTC </strong></i>
                                                </p>
                                              
                                        </td>
                                        <td class="">
                                           {{$aBuyer->user->username }}
                                        </td>
                                        <td class="">
                                            @if($aBuyer->status == 0)
                                                Pause
                                            @elseif($aBuyer->status == 1)
                                                Running
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{URL::to('userads/'.$aBuyer->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                                            <a data-title="Xác thực hủy giao dịch" data-body="Bạn có chắc muốn hủy giao dịch?" href="{{URL::to('userads/destroy/'.$aBuyer->id)}}" class="btn btn-sm btn-danger confirm-link">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                           
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                {!! $userads_buy->setPath('')->appends(['type' => 'buy'])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane {{ (app('request')->input('type') == 'sell')?'active':'' }}" id="sell">
                    <div class="row table-responsive">
                        <div class="col-sm-12 col-xs-12">
                            <b>Dư Bán: {{$totalSell}}</b> BTC <br />
                            <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Ads</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Status</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userads_sell as $aSeller)
                                    <tr role="row" class="odd">
                                        <td class="">
                                                  <p>
                                                    <div class="offer-body">
                                                        <offer-price offer="vm.offer" class="ng-isolate-scope" style="color:#f7931a;">
                                                            <strong class="offer-price" ng-class="vm.offer.offer_type == 'buy' ? 'text-danger':'text-success'">
                                                                <span ng-bind="vm.formattedPrice" class="ng-binding">{{number_format($aSeller->price(),0, ',', '.')}} {{$aSeller->currency->code}}</span>/<span ng-bind="vm.unit" ng-class="vm.isBtc ? 'text-btc-color':'text-primary'" class="ng-binding text-btc-color">BTC</span></strong>
                                                        </offer-price>
                                                        <span translate-once="via">{{trans('btcbank.via')}}</span> <span ng-switch="::vm.offer.payment_method"><!-- ngSwitchWhen: local_bank -->
                                                            <span ng-bind="::vm.offer.payment_descriptions" ng-switch-when="local_bank" class="ng-binding ng-scope">{{$aSeller->bank->name}}</span><!-- end ngSwitchWhen: --><!-- ngSwitchDefault:  --></span>
                                                    </div>
                                                </p>
                                                <p><i><strong><span ng-bind="vm.offer.max_amount" class="ng-binding">{{$aSeller->realquantity_to()}}</span> BTC </strong></i>
                                                </p>
                                              
                                        </td>
                                        <td class="">
                                           {{$aSeller->user->username }}
                                        </td>
                                        <td class="">
                                            @if($aSeller->status == 0)
                                                Pause
                                            @elseif($aSeller->status == 1)
                                                Running
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{URL::to('userads/'.$aSeller->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                                            <a data-title="Xác thực hủy giao dịch" data-body="Bạn có chắc muốn hủy giao dịch?" href="{{URL::to('userads/destroy/'.$aSeller->id)}}" class="btn btn-sm btn-danger confirm-link">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                           
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                {!! $userads_sell->setPath('')->appends(['type' => 'sell'])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite"></div>
                </div>
                <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">

                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>
@endsection
@section('inpage-script')
<script>
    $(function () {
        $('#table_userads').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

    });

</script>
@endsection
