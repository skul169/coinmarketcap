<div class="box login-pass">
    <div class="box-header with-border">
        <h3 class="box-title">LOGIN PASSWORD</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" action="{{ route('member.changeloginpass')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Old Password</label>

                <div class="col-sm-8">
                    {!!Form::password('oldpassword',['class'=>'form-control', 'id'=>'oldpassword'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">New Password</label>
                <div class="col-sm-8">
                    {!!Form::password('newpassword',['class'=>'form-control', 'id'=>'newpassword'])!!}

                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Confirm New Password</label>
                <div class="col-sm-8">
                    {!!Form::password('confirmpassword',['class'=>'form-control', 'id'=>'confirmpassword'])!!}

                </div>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group" align="center">
                <button type="submit" class="btn btn-primary" id="add_city">Change Password</button>
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
</div>