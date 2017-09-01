@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Quản lý nhận hưởng</h3>
    </div><!-- /.box-header -->
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#gioithieu" data-toggle="tab">Thưởng giới thiệu</a></li>
            <li class=""><a href="#guilai" data-toggle="tab">thưởng lưu trữ</a></li>
            <li class=""><a href="#guilaigioithieu" data-toggle="tab">thưởng lưu trữ giới thiệu</a></li>
            <li class=""><a href="#tructieptrader" data-toggle="tab">Thường trực tiếp Trader</a></li>
            <li class=""><a href="#levertrader" data-toggle="tab">Thưởng Lever trader</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="gioithieu">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Mã</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Nhận thưởng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Người nhận</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Nhận từ</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Ngày nhận</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($refers as $refer)
                                <tr role="row" class="odd">
                                    <td>#{{$refer->id }}</td>
                                    <td><span class="btn-xs btn btn-danger">{{$refer->value }}</span></td>
                                    <td>
                                        @if($refer->receiver)
                                        {{$refer->receiver->username}}
                                        @endif

                                    </td>
                                    <td>
                                        @if($refer->sender)
                                        {{$refer->sender->username}}
                                        @endif
                                    </td>
                                    <td>
                                      {{ $refer->created_at}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số nhận thưởng: {{$refers->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $refers->setPath('')->appends(['listall' => old('listall')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
<!----  lưu trữ---->

            <div class="tab-pane" id="guilai">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Mã</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Nhận thưởng</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Người nhận</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Ngày nhận</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rosedeposits as $rose)
                                <tr role="row" class="odd">
                                    <td>#{{$rose->id }}</td>
                                    <td><span class="btn-xs btn btn-danger">{{$rose->value }}</span></td>
                                    <td>
                                        {{ $rose->receiver->username}}
                                    </td>
                                    <td>
                                        {{ $rose->created_at}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số nhận thưởng: {{$rosedeposits->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                    {!! $rosedeposits->setPath('')->appends(['listall' => old('listall')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>

            <!----  lưu trữ giới thiệu---->

            <div class="tab-pane" id="guilaigioithieu">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Mã</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Nhận thưởng</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Người nhận</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Người giới thiệu</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Ngày nhận</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($referdeposits as $rose)
                                <tr role="row" class="odd">
                                    <td>#{{$rose->id }}</td>
                                    <td><span class="btn-xs btn btn-danger">{{$rose->value }}</span></td>
                                    <td>
                                        {{ $rose->receiver->username}}

                                    </td>
                                    <td>
                                        {{$rose->sender->username}}
                                    </td>
                                    <td>
                                        {{ $rose->created_at}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số nhận thưởng: {{$referdeposits->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $referdeposits->setPath('')->appends(['listall' => old('listall')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane" id="tructieptrader">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th class="col-md-1 ">{{trans('btcbank.account')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.generation')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.bonus')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.content')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.type')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($directcommissions as $commission)
                            <tr>
                                <td class="col-md-1 col-sm-2 col-xs-2">
                                    @if($commission->sender)
                                        {{$commission->sender->username }}
                                    @endif
                                </td>
                                <td class="col-md-3 col-sm-3 col-xs-4">
                                    @if($commission->child)
                                        F{{$commission->child }}
                                    @endif
                                </td>
                                <td class="col-md-1 col-sm-2 col-xs-2">{{$commission->value }}</td>
                                <td class="col-md-3 col-sm-3 col-xs-4">{{$commission->message }}</td>
                                <td class="col-md-2 hidden-sm hidden-xs">
                                    @if($commission->paytype_id == 9)
                                        {{trans('btcbank.direct')}}
                                    @elseif($commission->paytype_id == 10)
                                        {{trans('btcbank.indirect') }}
                                    @endif
                                </td>
                                <td class="col-md-2 col-sm-2 col-xs-3">{{date('d/m/Y', strtotime($commission->created_at)) }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="levertrader">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th class="col-md-1 ">{{trans('btcbank.account')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.generation')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.bonus')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.content')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.type')}}</th>
                                <th class="col-md-1 ">{{trans('btcbank.date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($indirectcommissions as $commission)
                            <tr>
                                <td class="col-md-1 col-sm-2 col-xs-2">
                                    @if($commission->sender)
                                        {{$commission->sender->username }}
                                    @endif
                                </td>
                                <td class="col-md-3 col-sm-3 col-xs-4">
                                    @if($commission->child)
                                        F{{$commission->child }}
                                    @endif
                                </td>
                                <td class="col-md-1 col-sm-2 col-xs-2">{{$commission->value }}</td>
                                <td class="col-md-3 col-sm-3 col-xs-4">{{$commission->message }}</td>
                                <td class="col-md-2 hidden-sm hidden-xs">
                                    @if($commission->paytype_id == 9)
                                        {{trans('btcbank.indirect')}}
                                    @elseif($commission->paytype_id == 10)
                                        {{trans('btcbank.inindirect') }}
                                    @endif
                                </td>
                                <td class="col-md-2 col-sm-2 col-xs-3">{{date('d/m/Y', strtotime($commission->created_at)) }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('inpage-script')
@endsection
