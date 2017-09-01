@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Quản lý lưu trữ</h3>
    </div><!-- /.box-header -->
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#luutru" data-toggle="tab">Tất cả lưu trữ</a></li>
            <li class=""><a href="#dangchay" data-toggle="tab">Đang chạy</a></li>
            <li class=""><a href="#hoanthanh" data-toggle="tab">Hoàn thành</a></li>
            <li class=""><a href="#dahuy" data-toggle="tab">Đã hủy</a></li>
            <li class=""><a href="#tralai" data-toggle="tab">Thống kê hoàn lại</a></li>


        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="luutru">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Mã</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Kỳ hạn</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Lãi nhận</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $deposit)
                                <tr role="row" class="odd">
                                    <td>#{{$deposit->id }}</td>
                                    <td>{{$deposit->user->username }}</td>
                                    <td><span class="btn-xs btn btn-danger">{{$deposit->value }}</span></td>
                                    <td>
                                        @if($deposit->type == 3)
                                         3 tháng
                                            <br>
                                            {{date('d/m/Y H:i:s', strtotime($deposit->created_at)) }}
                                        @elseif($deposit->type == 6)
                                           6 tháng
                                        @elseif($deposit->type == 12)
                                            12 tháng
                                        @endif
                                    </td>
                                    <td>
                                        @if($deposit->valuereceived!=null)
                                         Chưa nhận thưởng lưu trữ
                                        @endif

                                        @if($deposit->valuereceived==null && $deposit->status==1 || $deposit->valuereceived==null && $deposit->status==3)
                                            Đã nhận thưởng
                                        @endif

                                            @if($deposit->valuereceived!=null && $deposit->status==1 || $deposit->valuereceived!=null && $deposit->status==3)
                                               Đã hết kỳ hạn chưa nhận thưởng
                                            @endif
                                            @if($deposit->valuereceived==null && $deposit->status==0)
                                               Chưa hết kỳ hạn
                                            @endif
                                    </td>
                                    @if($deposit->status == 0)
                                        <td>
                                           Đang lưu trữ</td>
                                    @elseif($deposit->status == 1)
                                        <td>
                                            Hoàn thành kỳ hạn lưu trữ</td>
                                    @elseif($deposit->status == 2)
                                        <td>
                                            Bị hủy bỏ giao dịch lưu trữ</td>
                                    @elseif($deposit->status == 3)
                                        <td>
                                            Đã hoàn gốc</td>
                                    @elseif($deposit->status == 4)
                                        <td>
                                            Bị hủy bỏ giao dịch lưu trữ</td>
                                    @endif
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
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số lưu trữ: {{$deposits->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $deposits->setPath('')->appends(['listall' => old('listall')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!--- Dang gui lai --->
            <div class="tab-pane" id="dangchay">
                <div class="box login-pass">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Mã</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Kỳ hạn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($runs as $run)
                                    <tr role="row" class="odd">
                                        <td>#{{$run->id }}</td>
                                        <td>{{$run->user->username }}</td>
                                        <td><span class="btn-xs btn btn-danger">{{$run->value }}</span></td>
                                        <td>
                                            @if($run->type == 3)
                                                3 tháng
                                                <br>
                                                {{date('d/m/Y H:i:s', strtotime($run->created_at)) }}
                                            @elseif($run->type == 6)
                                                6 tháng
                                            @elseif($run->type == 12)
                                                12 tháng
                                            @endif
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
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số lưu trữ: {{$runs->total()}}</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                {!! $runs->setPath('')->appends(['runs' => old('runs')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!----- --->


            <!--- Hoan thanh gui lai --->
            <div class="tab-pane" id="hoanthanh">
                <div class="box login-pass">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Mã</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Kỳ hạn</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">thưởng lưu trữ</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($finishs as $finish)
                                    <tr role="row" class="odd">
                                        <td>#{{$finish->id }}</td>
                                        <td>#{{$finish->user->username }}</td>
                                        <td><span class="btn-xs btn btn-danger">{{$finish->value }}</span></td>
                                        <td>
                                            @if($finish->type == 3)
                                                3 tháng
                                                <br>
                                                {{date('d/m/Y H:i:s', strtotime($finish->created_at)) }}
                                            @elseif($finish->type == 6)
                                                6 tháng
                                            @elseif($finish->type == 12)
                                                12 tháng
                                            @endif
                                        </td>
                                        <td>
                                            @if($finish->valuereceived!=null)
                                                <span class="btn-xs btn btn-danger">{{$finish->valuereceived}}</span>
                                            @endif

                                            @if($finish->valuereceived==null && $finish->status==1 || $finish->valuereceived==null && $finish->status==3)
                                                    <span class="btn-xs btn btn-info">Đã nhận thưởng</span>
                                            @endif

                                            @if($finish->valuereceived==null && $finish->status==0)
                                                Chưa hết kỳ hạn
                                            @endif
                                        </td>
                                        @if($finish->status == 0)
                                            <td>
                                                Đang lưu trữ</td>
                                        @elseif($finish->status == 1)
                                            <td>
                                                Hoàn thành kỳ hạn lưu trữ</td>
                                        @elseif($finish->status == 2)
                                            <td>
                                                Bị hủy bỏ giao dịch lưu trữ</td>
                                        @elseif($finish->status == 3)
                                            <td>
                                                Hoàn gốc giao dịch</td>
                                        @elseif($finish->status == 4)
                                            <td>
                                                Hoàn gốc giao dịch hủy lãi</td>
                                        @endif
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
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số lưu trữ: {{$finishs->total()}}</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                {!! $finishs->setPath('')->appends(['finish' => old('finish')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!----- --->

            <!--- Huy giao dich gui lai --->
            <div class="tab-pane" id="dahuy">
                <div class="box login-pass">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Mã</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Kỳ hạn</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">thưởng lưu trữ</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rejected as $finish)
                                    <tr role="row" class="odd">
                                        <td>#{{$finish->id }}</td>
                                        <td>{{$finish->user->username }}</td>
                                        <td><span class="btn-xs btn btn-danger">{{$finish->value }}</span></td>
                                        <td>
                                            @if($finish->type == 3)
                                                3 tháng
                                                <br>
                                                {{date('d/m/Y H:i:s', strtotime($finish->created_at)) }}
                                            @elseif($finish->type == 6)
                                                6 tháng
                                            @elseif($finish->type == 12)
                                                12 tháng
                                            @endif
                                        </td>
                                        <td>
                                            @if($finish->valuereceived!=null)
                                                <span class="btn-xs btn btn-danger">Chưa nhận thưởng lưu trữ</span>
                                            @endif

                                            @if($finish->valuereceived==null && $finish->status==1 || $finish->valuereceived==null && $finish->status==3)
                                                <span class="btn-xs btn btn-info">Đã nhận thưởng</span>
                                            @endif

                                            @if($finish->valuereceived!=null && $finish->status==1 || $finish->valuereceived!=null && $finish->status==3)
                                                Đã hết kỳ hạn chưa nhận thưởng
                                            @endif
                                            @if($finish->valuereceived==null && $finish->status==0)
                                                Chưa hết kỳ hạn
                                            @endif
                                        </td>
                                        @if($finish->status == 0)
                                            <td>
                                                Đang lưu trữ</td>
                                        @elseif($finish->status == 1)
                                            <td>
                                                Hoàn thành kỳ hạn lưu trữ</td>
                                        @elseif($finish->status == 2)
                                            <td>
                                                Bị hủy bỏ giao dịch lưu trữ</td>
                                        @elseif($finish->status == 3)
                                            <td>
                                                Hoàn gốc giao dịch</td>
                                        @elseif($finish->status == 4)
                                            <td>
                                                Hoàn gốc giao dịch hủy lãi</td>
                                        @endif
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
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số lưu trữ: {{$rejected->total()}}</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                {!! $rejected->setPath('')->appends(['rejected' => old('rejected')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!----- --->

            <!--- Thống kê phải hoàn lại BTC --->
            <div class="tab-pane" id="tralai">
                <div class="box login-pass">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Mã</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Kỳ hạn</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">thưởng lưu trữ</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr role="row" class="odd">
                                    <td><b>Tổng Hoàn gốc:</b></td>
                                    <td></td>
                                    <td><span class="btn-xs btn btn-warning">{{$Totalhoangoc }}</span></td>
                                    <td>
                                        <b>Tổng Hoàn thưởng lưu trữ:</b>
                                    </td>
                                    <td>
                                        <span class="btn-xs btn btn-warning">{{$Totalhoanlai }}</span>
                                    </td>
                                    <td>

                                        <span class="btn-xs btn btn-danger"><b>{{$Totalhoanlai + $Totalhoangoc }}</b> Bitcoin</span>
                                    </td>
                                </tr>
                                @foreach($feedbacks as $finish)
                                    <tr role="row" class="odd">
                                        <td>#{{$finish->id }}</td>
                                        <td>{{$finish->user->username }}</td>
                                        <td><span class="btn-xs btn btn-info">{{$finish->value }}</span></td>
                                        <td>
                                            @if($finish->type == 3)
                                                3 tháng
                                                <br>
                                                {{date('d/m/Y H:i:s', strtotime($finish->created_at)) }}
                                            @elseif($finish->type == 6)
                                                6 tháng
                                            @elseif($finish->type == 12)
                                                12 tháng
                                            @endif
                                        </td>
                                        <td>
                                            @if($finish->valuereceived!=null)
                                                <span class="btn-xs btn btn-info">{{$finish->valuereceived}}</span>
                                            @endif

                                            @if($finish->valuereceived==null && $finish->status==1 || $finish->valuereceived==null && $finish->status==3)
                                                <span class="btn-xs btn btn-info">Đã nhận thưởng</span>
                                            @endif

                                            @if($finish->valuereceived==null && $finish->status==0)
                                                Chưa hết kỳ hạn
                                            @endif
                                        </td>
                                        @if($finish->status == 0)
                                            <td>
                                                Đang lưu trữ</td>
                                        @elseif($finish->status == 1)
                                            <td>
                                                Hoàn thành kỳ hạn lưu trữ</td>
                                        @elseif($finish->status == 2)
                                            <td>
                                                Bị hủy bỏ giao dịch lưu trữ</td>
                                        @elseif($finish->status == 3)
                                            <td>
                                                Hoàn gốc giao dịch</td>
                                        @elseif($finish->status == 4)
                                            <td>
                                                Hoàn gốc giao dịch hủy lãi</td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr role="row" class="odd">
                                    <td><b>Tổng Hoàn gốc:</b></td>
                                    <td></td>
                                    <td><span class="btn-xs btn btn-warning">{{$Totalhoangoc }}</span></td>
                                    <td>
                                        <b>Tổng Hoàn thưởng lưu trữ:</b>
                                    </td>
                                    <td>
                                        <span class="btn-xs btn btn-warning">{{$Totalhoanlai }}</span>
                                    </td>
                                  <td>

                                      <span class="btn-xs btn btn-danger"><b>{{$Totalhoanlai + $Totalhoangoc }}</b> Bitcoin</span>
                                  </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số lưu trữ: {{$feedbacks->total()}}</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                {!! $feedbacks->setPath('')->appends(['rejected' => old('rejected')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!----- --->

        </div>
    </div>
</div>


@endsection


@section('inpage-script')
@endsection
