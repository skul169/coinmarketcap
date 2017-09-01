@extends('app')

@section('htmlheader_title')
Profile Information
@endsection
@section('main-content')
<style type="text/css" media="screen">
	.page-section{
		padding: 0px!important;
	}
</style>
<div class="row">
   <section id="section-contacts">
		<div class="container">
			<div class="section-title-wrapper1">
				<div class="section-title-inner1">
					<h1 class="section-title">Biểu mẫu tạo quảng cáo</h1>
				</div>
			</div>

			<div class="content-wrapper">
                <section class="page-section">
                    <div class="container">
                                                
						<div class="box box-primary">
						    <div class="box-header with-border">
						        <h3 class="box-title">Tạo quảng cáo</h3>
						    </div><!-- /.box-header -->
						    <!-- form start -->
						    <form class="form-horizontal" method="POST" action="">
						        <input type="hidden" name="_token" value="G6MZUoRoqHGiaoRv6xFE6mBzCAVYyivA8aOwTXQg">
						        <div class="box-body">


						            <div class="form-group">
						                <label for="type" class="col-sm-3 control-label">Parent:</label>
						                <div class="col-sm-9">
						                    <select class="form-control select2" placeholder="Enter type" id="type" name="type"><option value="0">Bán</option><option value="1">Mua</option></select>
						                </div>
						            </div>

						            <div class="form-group">
						                <label for="payment_type" class="col-sm-3 control-label">Parent:</label>
						                <div class="col-sm-9">
						                    <select class="form-control select2" placeholder="Enter payment_type" id="payment_type" name="payment_type"><option value="0">Chuyển khoản</option><option value="1">Trực tiếp</option></select>
						                </div>
						            </div>

						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-3 control-label">Số tài khoản<span class="lable_red">*</span></label>
						                <div class="col-sm-9">
						                    <input class="form-control" placeholder="Enter Question" maxlength="350" name="bank_no" type="text">
						                </div>
						            </div>

						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-3 control-label">Tên tài khoản<span class="lable_red">*</span></label>
						                <div class="col-sm-9">
						                    <input class="form-control" placeholder="Enter Question" maxlength="350" name="bank_name" type="text">
						                </div>
						            </div>

						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-3 control-label">Thời gian thanh toán<span class="lable_red">*</span></label>
						                <div class="col-sm-9">
						                    <input class="form-control" placeholder="Enter Question" maxlength="350" name="time_payment" type="text">
						                </div>
						            </div>

						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-3 control-label">Số lượng nhỏ nhất<span class="lable_red">*</span></label>
						                <div class="col-sm-9">
						                    <input class="form-control" placeholder="Enter Question" maxlength="350" name="quantity_from" type="text">
						                </div>
						            </div>

						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-3 control-label">Số lượng lớn nhất<span class="lable_red">*</span></label>
						                <div class="col-sm-9">
						                    <input class="form-control" placeholder="Enter Question" maxlength="350" name="quantity_to" type="text">
						                </div>
						            </div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						                <div class="form-group" align="center">
						                    <input class="btn btn-sm btn-primary addBTCSubmitBtn" type="submit" value="Tạo">
						                </div>
						            </div>
						            <!-- /.box-footer -->
						        </div>
						    </form>

						</div>

                    </div>
                </section>
            </div>
			
		</div>					
	</section>
</div>
@endsection
@section('inpage-script')
<script>
    $('#uploadBtn1').change(function () {
        $('#imgpepole1').val(this.value);
    });

    $('#uploadBtn2').change(function () {
        $('#imgpepole2').val(this.value);
    });

    $('#uploadBtn3').change(function () {
        $('#imgavatar').val(this.value);
    });


    $("#RecoverTransactionPasswordBtn").click(function () {
        $(".wait").css("display", "block");
        $("#RecoverTransactionPasswordBtn").attr('disabled', 'disabled');
    });

</script>
@endsection

