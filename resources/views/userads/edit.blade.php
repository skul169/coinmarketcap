@extends('app')

@section('htmlheader_title')
Tạo quảng cáo
@endsection


@section('main-content')

<!---->
<div class="row">
    <div class="col-md-12">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
            <meta http-equiv="refresh" content="5;URL={{ url('/member/dashboard?type=myads') }}"/>
        </div>
        @endif
        <style type="text/css" media="screen">
            .box {
                background: #f8f9fa;
                border: 1px solid #d2d2dd;
                padding: 20px;
            }

            .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
                border: 1px solid #d2d2dd;
                border-bottom-style: dashed;
                border-top-style: dashed;
                width: 30%;
            }

            .control-label {
                text-align: left !important;
                padding-bottom: 5px;
            }

            .form-group {
                margin-bottom: 5px;

            }

            ul li:before {
                display: none !important;
            }


        </style>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('btcbank.pages.creatads.CreateyourAdvertising')}}</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route' => ['userads.update', $userads->id], 'method' => 'PUT', 'class' => 'form-horizontal')) !!}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
                    <div class="box-body">


                        <div class="form-group">
                            {!! Form::label('type', trans('btcbank.forms.labels.Youwant'), ['class' => 'col-sm-12 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('type', ['0' => trans('btcbank.sell'), '1' => trans('btcbank.buy')] , $userads->type, ['class' => 'form-control select2', 'placeholder' => ''])  !!}
                            </div>
                            <div class="col-sm-7">
                                    <i>{{trans('btcbank.spricebitusd')}}:<span> <b>{{number_format($price, 0, '.', ',')}}</b></span> {{$currency->code}} / BTC </i>
                                <p><i>{{trans('btcbank.blockchainnow')}}({{number_format($rate_usd, 2, '.', ',')}}).{{trans('btcbank.blockchainchange')}}.</i></p>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('payment_type', 'Loại giao dịch:', ['class' => 'col-sm-12 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('payment_type', ['0' => trans('btcbank.directdeposit'), '1' => trans('btcbank.banktranfers')],$userads->payment_type, ['class' => 'form-control select2', 'placeholder' => ''])  !!}
                            </div>
                            <div class="col-sm-7">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-12 control-label">{{trans('btcbank.bankname')}}<span
                                        class="lable_red">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" aria-hidden="true" name="bank_id">
                                    @foreach ($bank as $bank)
                                        <option value='{{ $bank['id'] }}'>{{ $bank['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-7">
                                <i>{{trans('btcbank.bankreceivename')}} </i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-12 control-label">{{trans('btcbank.bankno')}}<span class="lable_red">*</span></label>
                            <div class="col-sm-5">
                                {!!Form::text('bank_no',$userads->bank_no,['class'=>'form-control','placeholder'=>'','maxlength'=>'350'])!!}
                            </div>
                            <div class="col-sm-7">
                                <i> {{trans('btcbank.bankreceiveno')}}</i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-12 control-label">{{trans('btcbank.accountname')}}
                                <span
                                        class="lable_red">*</span></label>
                            <div class="col-sm-5">
                                {!!Form::text('bank_name',$userads->bank_name,['class'=>'form-control','placeholder'=>'','maxlength'=>'350'])!!}
                            </div>
                            <div class="col-sm-7">
                                <i>{{trans('btcbank.bankreceive_acc_no')}} </i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary btn-sm btn-option">Thêm lựa chọn</a>
                        <hr />
                        <div class="form-group option_area">
                            <label for="inputEmail3" class="col-sm-12 control-label">{{trans('btcbank.pricebitusd')}}
                                <span class="lable_red">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="currencyusd" name="currencyusd" placeholder="" value="{{number_format($currencyusd, 0, ',', '')}}">

                            </div>
                            <div class="col-sm-7">
                                <p>
                                    <i style="display: block;">Giá bán BTC : <span id="price"><b>{{number_format($price, 0, '.', ',')}}</b></span> {{$currency->code}} / BTC</i>
                                    <i style="display: block;" class="sell_area">Giá sàn bán: <span><b>{{number_format($rateSell*$rate_usd, 0, '.', ',')}}</b></span> {{$currency->code}} / BTC (Không được bán thấp hơn giá sàn)</i>
                                    <i style="display: block;" class="buy_area">Giá sàn mua: <span><b>{{number_format($rateBuy*$rate_usd, 0, '.', ',')}}</b></span> {{$currency->code}} / BTC (Không được mua cao hơn giá sàn)</i>
                                </p>
                            </div>
                        </div>

                        <div class="form-group option_area sell_area">
                            <label for="inputEmail3" class="col-sm-12 control-label">{{trans('btcbank.price_from')}}<span
                                        class="lable_red">*</span></label>
                            <div class="col-sm-5">
                                {!!Form::text('price_from',$userads->price_from,['class'=>'form-control','placeholder'=>'','maxlength'=>'350'])!!}
                            </div>
                            <div class="col-sm-7">
                                <i> {{trans('btcbank.price_from_description')}}</i>

                            </div>
                        </div>

                        <div class="form-group option_area buy_area">
                            <label for="inputEmail3" class="col-sm-12 control-label">{{trans('btcbank.price_to')}}<span
                                        class="lable_red">*</span></label>
                            <div class="col-sm-5">
                                {!!Form::text('price_to',$userads->price_to,['class'=>'form-control','placeholder'=>'','maxlength'=>'350'])!!}
                            </div>
                            <div class="col-sm-7">
                                <i> {{trans('btcbank.price_to_description')}}</i>
                            </div>
                        </div>

                        <div class="form-group option_area">
                            <label for="inputEmail3"
                                   class="col-sm-12 control-label">{{trans('btcbank.methodlimittimebill')}}
                                ({{trans('btcbank.min')}})<span
                                        class="lable_red">*</span></label>
                            <div class="col-sm-5">
                                {!! Form::select('time_payment', ['15' => 15, '30' => 30] ,$userads->time_payment, ['class' => 'form-control select2', 'placeholder' => ''])  !!}
                            </div>
                            <div class="col-sm-7">
                                <i>{{trans('btcbank.limittimebilling')}}</i>
                            </div>
                        </div>

                        <div class="form-group option_area">
                            <label for="inputEmail3"
                                   class="col-sm-12 control-label">{{trans('btcbank.limitquantitymin')}} <span
                                        class="lable_red">*</span></label>
                            <div class="col-sm-5 type_quantity_from">
                                {!!Form::text('quantity_from',$userads->quantity_from,['class'=>'form-control','placeholder'=>'','maxlength'=>'350'])!!}
                            </div>
                            <div class="col-sm-7">
                                <i>{{trans('btcbank.limitbtcmin')}}</i>
                            </div>
                        </div>

                        <div class="form-group option_area">
                            <label for="inputEmail3"
                                   class="col-sm-12 control-label">{{trans('btcbank.limitquantitymax')}}<span
                                        class="lable_red">*</span></label>
                            <div class="col-sm-5" id="quantity_sell" >
                                {!!Form::text('quantity_to',$userads->quantity_to,['class'=>'form-control','placeholder'=>'','maxlength'=>'350'])!!}
                            </div>
                            <div class="col-sm-7">
                                <i>{{trans('btcbank.limitbtcmax')}}</i>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <br>
                        <div class="box-footer">
                            <div class="form-group" align="center">
                                {!! Form::submit('Cập nhật',['class' => 'btn btn-sm btn-primary addBTCSubmitBtn']) !!}
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
            {!! Form::close() !!}

        </div>
    </div>
    <!--End col 7-->
</div>
<!--End row-->

@endsection
@section('inpage-script')
<script>
function adsTypeChange(e) {
    if($(".option_area").is(":visible") && $('#type').val() == 0){
        $(".option_area.sell_area").show();
        $(".option_area .sell_area").show();
        $(".option_area.buy_area").hide();
        $(".option_area .buy_area").hide();
        var quantityto = {{Auth::user()->amount_wallet}};
        $('#quantity_sell').html('<input type="text" class="form-control" id="vnd" name="quantity_to" placeholder="" value="' + quantityto + '">');
        //$('#changetype').html('Giá BTC bạn thực nhận');
    }else if($(".option_area").is(":visible")){
        $(".option_area.buy_area").show();
        $(".option_area .buy_area").show();
        $(".option_area.sell_area").hide();
        $(".option_area .sell_area").hide();
        $('#quantity_sell').html('<input type="text" class="form-control" id="vnd" name="quantity_to" placeholder="" value="100">');
        //$('#changetype').html('Giá BTC bạn thực trả');
    }else{
        $(".option_area.buy_area").hide();
        $(".option_area.sell_area").hide();
        $(".option_area .buy_area").hide();
        $(".option_area .sell_area").hide();

    }
}
$(document).ready(function () {
    $(".option_area").hide();
    $(".btn-option").click(function() {
        if($(".option_area").is(":visible")){
            $(".option_area").hide();
            $(".btn-option").show();
        }else{
            $(".option_area").show();
            $(".btn-option").hide();
            adsTypeChange();
        }

    });
    adsTypeChange();
    $('#type').on('change',adsTypeChange);
});
function changeRate(){
}
$('#currencyusd').keyup(function () {

    var currencyusd = $('#currencyusd').val();
    var price = currencyusd * {{$rate_usd}};
    $('#price').html('<b>' + addCommas(price) + '</b>');
});
function ChangeType(e) {
    if($('#type').val() == 0){
        $('#changetype').html('{{trans('btcbank.btcreal_receive')}} ');
    }else{
        $('#changetype').html('{{trans('btcbank.btcreal_pay')}} ');
    }
}
$('#type').on('change',ChangeType);
</script>

@endsection