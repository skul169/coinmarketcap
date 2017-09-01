@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<style>
.table {
  table-layout:fixed;
  word-wrap: break-word;
}

</style>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Danh sách gửi tin</h3>
        <div class="pull-right">
            <a href="{{ route('transaction.create') }}" class="btn btn-primary">Thêm</a>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

            {!! Form::open(array('route' => ['transaction.index'], 'method' => 'GET')) !!}
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
                    <input class="btn btn-primary" type="submit" value="Tìm kiếm">
                </div>
            </div><!-- /.row -->
            {!! Form::close() !!}
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 5%">Id</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 50%;">Danh sách người nhận</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 25%;">Nội dung</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%;">Ngày</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr role="row" class="odd">
                                <td class="">{{$transaction->id }}</td>
                                <td class="">{{$transaction->mobile }}</td>
                                <td class="">{{$transaction->content }}</td>
                                <td class="">{{date('d/m/Y H:i:s', strtotime($transaction->create_date)) }}</td>
                                <td>
                                    <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-info">Xem</a>
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
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Số bản ghi: {{$transactions->total()}}</div>
                    <a href="{{ route('transaction.export',['from_date' => old('from_date'),'to_date' => old('to_date')]) }}" class="btn btn-primary">Kết xuất</a>
                </div>
                <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        {!! $transactions->setPath('')->appends(['from_date' => old('from_date'),'to_date' => old('to_date')])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>

@endsection
@section('inpage-script')
<script type="text/javascript">
    $(function () {
        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy',
        });
    });
</script>

@endsection
