@extends('app')

@section('htmlheader_title')
TRANSACTION
@endsection

@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Quản lý giao dịch</h3>
    </div><!-- /.box-header -->
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="{{ (app('request')->input('type') == null || app('request')->input('type') == 'nap')?'active':'' }}"><a href="{{url('transaction?type=nap')}}">Giao dịch nạp</a></li>
            <li class="{{ (app('request')->input('type') == 'tranhchap')?'active':'' }}"><a href="{{url('transaction?type=tranhchap')}}">Giao dịch mua bán BTC</a></li>
            <li class="{{ (app('request')->input('type') == 'rut')?'active':'' }}"><a href="{{url('transaction?type=rut')}}">Giao dịch rút</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane {{ (app('request')->input('type') == null || app('request')->input('type') == 'nap')?'active':'' }}" id="nap">
                <div class="row table-responsive">
                    <div class="col-sm-12 col-xs-12">
                        <b>Tổng doanh số: {{$totalSales}}</b> BTC <br />
                        <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">User</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Loại giao dịch</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Trạng thái</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Ngày tạo</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactionAdds as $tranaction)
                                <tr role="row" class="odd">
                                    <td class="">
                                        @if($tranaction->user)
                                        {{$tranaction->user->username }}
                                        @endif
                                    </td>
                                    <td class="">{{$tranaction->value }}</td>
                                    <td class="">
                                        @if($tranaction->paytype)
                                        {{$tranaction->paytype->name }}
                                        @endif
                                    </td>
                                    <td class="">
                                        @if($tranaction->status == 0)
                                        Pending
                                        @elseif($tranaction->status == 1)
                                        Approve
                                        @elseif($tranaction->status == 2)
                                        Reject
                                        @elseif($tranaction->status == 3)
                                        Dispute
                                        @endif
                                    </td>
                                    <td class="">{{date('d/m/Y H:i:s', strtotime($tranaction->created_at)) }}</td>
                                    <td>
                                        @if($tranaction->status == 3)
                                        <a href="{{url('member/mywallet/detail/'.$tranaction->id)}}" class="btn-xs btn btn-primary">Chi tiết tranh chấp</a>
                                        <a href="{{url('member/mywallet/completesell/'.$tranaction->id)}}" class="btn-xs btn btn-danger">Giao dịch hợp lệ</a>
                                        <a href="{{url('member/mywallet/cancel/'.$tranaction->id)}}" class="btn-xs btn btn-danger">Reject người mua</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Number of records: {{$transactions->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $transactionAdds->setPath('')->appends(['type' => 'nap'])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane {{ (app('request')->input('type') == 'tranhchap')?'active':'' }}" id="tranhchap">
                <div class="row table-responsive">
                    <div class="col-sm-12 col-xs-12">

                        <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">User</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Loại giao dịch</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Người bán</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Người nhận</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Trạng thái</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Ngày tạo</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $tranaction)
                                <tr role="row" class="odd">
                                    <td class="">
                                        @if($tranaction->user)
                                        {{$tranaction->user->username }}
                                        @endif
                                    </td>
                                    <td class="">{{$tranaction->value }}</td>
                                    <td class="">
                                        @if($tranaction->paytype)
                                        {{$tranaction->paytype->name }}
                                        @endif
                                    </td>
                                    <td class="">
                                        @if($tranaction->sender)
                                        {{$tranaction->sender->username }}
                                        @endif
                                    </td>
                                    <td class="">
                                        @if($tranaction->receiver)
                                        {{$tranaction->receiver->username }}
                                        @endif
                                    </td>
                                    <td class="">
                                        @if($tranaction->status == 0)
                                        Pending
                                        @elseif($tranaction->status == 1)
                                        Approve
                                        @elseif($tranaction->status == 2)
                                        Reject
                                        @elseif($tranaction->status == 3)
                                        Dispute
                                        @endif
                                    </td>
                                    <td class="">{{date('d/m/Y H:i:s', strtotime($tranaction->created_at)) }}</td>
                                    <td>
                                        @if($tranaction->status == 3)
                                        <a href="{{url('member/mywallet/detail/'.$tranaction->id)}}" class="btn-xs btn btn-primary">Chi tiết tranh chấp</a>
                                        <a href="{{url('member/mywallet/completesell/'.$tranaction->id)}}" class="btn-xs btn btn-danger">Giao dịch hợp lệ</a>
                                        <a href="{{url('member/mywallet/cancel/'.$tranaction->id)}}" class="btn-xs btn btn-danger">Reject người mua</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Number of records: {{$transactions->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $transactions->setPath('')->appends(['type' => 'tranhchap'])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane {{ (app('request')->input('type') == 'rut')?'active':'' }}" id="rut">
                <div class="row table-responsive">
                    <div class="col-sm-12 col-xs-12">

                        <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">User</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Loại giao dịch</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Trạng thái</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Ngày tạo</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactionWithdraws as $tranaction)
                                <tr role="row" class="odd">
                                    <td class="">
                                        @if($tranaction->user)
                                        {{$tranaction->user->username }}
                                        @endif
                                    </td>
                                    <td class="">{{$tranaction->value }}</td>
                                    <td class="">
                                        @if($tranaction->paytype)
                                        {{$tranaction->paytype->name }}
                                        @endif
                                    </td>
                                    <td class="">
                                        @if($tranaction->status == 0)
                                        Pending
                                        @elseif($tranaction->status == 1)
                                        Approve
                                        @elseif($tranaction->status == 2)
                                        Reject
                                        @elseif($tranaction->status == 3)
                                        Dispute
                                        @endif
                                    </td>
                                    <td class="">{{date('d/m/Y H:i:s', strtotime($tranaction->created_at)) }}</td>
                                    <td>
                                        @if($tranaction->status == 3)
                                        <a href="{{url('member/mywallet/detail/'.$tranaction->id)}}" class="btn-xs btn btn-primary">Chi tiết tranh chấp</a>
                                        <a href="{{url('member/mywallet/completesell/'.$tranaction->id)}}" class="btn-xs btn btn-danger">Giao dịch hợp lệ</a>
                                        <a href="{{url('member/mywallet/cancel/'.$tranaction->id)}}" class="btn-xs btn btn-danger">Reject người mua</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Number of records: {{$transactionWithdraws->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $transactionWithdraws->setPath('')->appends(['type' => 'rut'])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
		</div> <!---- close content-->
    </div><!-- /.box-body -->
</div><!---- box -->
@endsection


@section('inpage-script')

@endsection