@extends('app')

@section('htmlheader_title')
Profile Information
@endsection
@section('main-content')
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">My Profile</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <!-------->
                <div id="content">
                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="<?php echo $active[changeprofile] ?>"><a href="#profile" data-toggle="tab">PROFILE</a></li>
                        <li class="<?php echo $active[changeloginpass] ?>"><a href="#loginpassword" data-toggle="tab">LOGIN PASSWORD</a></li>
                    </ul>
                    <div id="my-tab-content" class="tab-content">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session()->get('status') }}
                        </div>
                        @endif


                        <div class="tab-pane <?php echo $active[changeprofile] ?>" id="profile">
                            @include('member.profileform')
                        </div>
                        <div class="tab-pane <?php echo $active[changeloginpass] ?>" id="loginpassword">
                            @include('member.loginpass')
                        </div>

                    </div>
                </div>


                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        $('#tabs').tab();
                    });
                </script>
            </div><!-- /.box-body -->
        </div>

    </div>
    <div class="col-md-4">

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">My Sponsor</h3>
            </div><!-- /.box-header -->
            <div class="box-body box-profile">
                @if ($sponsor)
                    @if ($sponsor->avatar == '')
                    {!! HTML::image('img/avatar.png', 'User Image', array('class' => 'profile-user-img img-responsive img-circle')) !!}
                    @else
                    {!! HTML::image('uploads/images/avatar/'.$sponsor->avatar, 'User Image', array('class' => 'profile-user-img img-responsive img-circle')) !!}
                    @endif

                    <h3 class="profile-username text-center">{{ $sponsor->name }}</h3>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Email:</b>{{ $sponsor->email }}
                        </li>
                        <li class="list-group-item">
                            <b>Phone: </b>{{ $sponsor->phone }}
                        </li>
                        <li class="list-group-item">
                            <b>Level: </b>
                            @if ($sponsor->level == 0)
                                Non Active
                            @elseif ($sponsor->level != 0)
                                {!! HTML::image('img/Up'.$sponsor->level.'.png', '', array('width' => 40 )) !!}
                            @endif
                        </li>
                    </ul>
                @endif
            </div>
            <!-- /.box-body -->
        </div>
    </div>
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

