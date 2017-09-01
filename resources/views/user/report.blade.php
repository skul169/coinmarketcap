@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Báo cáo</h3>
    </div><!-- /.box-header -->
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="tab-content">
            <div class="tab-pane active" id="summary">
                <div class="box login-pass">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box-header with-border">
                                <h3 class="box-title">Các báo cáo thống kê</h3>
                            </div>

                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Thống kê số lượng user trong hệ thống <span class="pull-right badge bg-blue">{{$total_user}}</span></a></li>
                                    <li><a href="#">Thống kê tổng số lượng BTC giao dịch<span class="pull-right badge bg-blue">{{$total_transaction_giaodich}}</span></a></li>
                                    <li><a href="#">Thống kê tổng số lượng BTC đang chờ xác nhận<span class="pull-right badge bg-blue">{{$total_transaction_choxacnhan}}</span></a></li>
                                    <li><a href="#">Thống kê tổng số lượng BTC đã xác nhận<span class="pull-right badge bg-blue">{{$total_transaction_approve}}</span></a></li>
                                    <li><a href="#">Thống kê tổng số lượng BTC đã hủy<span class="pull-right badge bg-blue">{{$total_transaction_reject}}</span></a></li>
                                    <li><a href="#">Thống kê tổng số doanh thu nhận được<span class="pull-right badge bg-blue">{{$total_user}}</span></a></li>
                                    <li><a href="#">Thống kê tổng số lợi nhuận<span class="pull-right badge bg-blue">{{$total_user}}</span></a></li>
                                    <li><a href="#">Tổng số Member đã active <span class="pull-right badge bg-blue">{{$total_member}}</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('inpage-script')
@endsection
