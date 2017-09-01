@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
{{--*/ $userads = $transaction->userads /*--}}
<div class="box box-primary">
    <div class="title-bordered border__dashed">
        <h5 class="box-title">Chi tiết giao dịch</h5>
    </div>
    <div class="box-body">
        <div class="tab-pane active" id="profile">
            <div class="title-bordered border__dashed">
                <h5>Thông tin thanh toán</h5>
            </div>
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <tbody>
                    <tr role="row" class="odd">
                        <td>{{trans('btcbank.methodbill')}}</td>
                        <td>
                            @if($userads->payment_type == \App\UserAds::PAYMENT_TYPE_CHUYENKHOAN)
                            {{trans('btcbank.banktranfers')}}
                            @elseif($userads->payment_type == \App\UserAds::PAYMENT_TYPE_TRUCTIEP)
                            {{trans('btcbank.directdeposit')}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{trans('btcbank.price')}}:</td>
                        <td><span style="color:red">{{number_format($transaction->price ,2,',','.')}}</span></td>
                    </tr>
                    <tr>
                        <td>{{trans('btcbank.bankname')}}:</td>
                        <td>
                            {{$userads->bank->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>{{trans('btcbank.bankno')}}</td>
                        <td>{{$userads->bank_no }}</td>
                    </tr>
                    <tr>
                        <td>{{trans('btcbank.accountname')}}</td>
                        <td>{{$userads->bank_name }}</td>
                    </tr>
                    <tr>
                        <td>{{trans('btcbank.contentpay')}}</td>
                        <td>
                            {{$transaction->receiver->username }} mua ROMAN từ {{$transaction->sender->username }}  -  {{trans('btcbank.advertisting')}} #{{$userads->id}}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
        <div class="tab-pane active" id="profile">

            <div class="title-bordered border__dashed">
                <h5>Luồng trao đổi</h5>
            </div>

            <div class="col-sm-12">
                <ul class="chat-list">
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection


@section('inpage-script')
<script>
function updateRealtimeChat() {
    var lastid = $(".chat-list > li").first().data('id');
    if(lastid == undefined){
        lastid = 0;
    }
    $.ajax({
        url: "{{url('ajax/ajaxGetMessages?id='.$transaction->id)}}",
        data: {'last_chat_id': lastid},
        crossDomain: true,
        dataType: 'json',
        success: function (data) {
            if(data.status !='success'){
                return;
            }
            $(data.messages).each(function(index, value) {
                if(value.type == '1'){
                    $(".chat-list").prepend('<li data-id="'+value.id+'">['+value.created_at+']@'+value.username+' : '+value.message+'</li>');
                }else{
                    $(".chat-list").prepend('<li data-id="'+value.id+'">['+value.created_at+']@'+value.username+' : <img style="height: 150px" src="https://romanbi.com/uploads/chat/'+value.message+'" /></li>');
                }
            });
        }
    });
}
$(document).ready(function () {
    updateRealtimeChat();
    setInterval(updateRealtimeChat, 1000 * 2);
});
</script>
@endsection