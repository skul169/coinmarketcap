@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Personal Information</h3>
    </div><!-- /.box-header -->
    <!-- form start -->

    @if (session('status'))
    <div class="alert alert-success">
        {{ session()->get('status') }}
    </div>
    @endif

    <!-- form start -->
    <form class="form-horizontal" method="POST" onsubmit="return submitform();
          " action="{{route('user.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Link Referer</label>
                <div class="col-sm-8">
                    <input readonly="readonly" class="form-control form-control-disable"
                           data-val-required="Please enter your UserName" aria-describedby="LinkReferer-error"
                           id="LinkReferer" name="referer" data-clipboard-demo=""
                           data-clipboard-target="#LinkReferer" type="text" value="{{$referer}}">
                </div>
                <div class="col-sm-1">
                    <button type="button" onClick="copyfieldvalue(event, 'LinkReferer');
                            return false"class="btn btn-block btn-primary btn-sm">Copy</button>
                </div>
                <div class="col-sm-1">
                    <input type="reset" name="reset" value="Reset" class="btn btn-block btn-primary btn-sm" style="background: #7da936">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">User name<span
                        class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter username']) !!}

                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Full name<span
                        class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter fullname']) !!}

                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email <span
                        class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!!Form::email('email', null, ['class'=>'form-control', 'id'=>'email' , 'placeholder' => 'Enter email'])!!}
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Blockchain <span
                        class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!!Form::text('blockchain', null, ['class'=>'form-control', 'id'=>'blockchain' , 'placeholder' => 'Enter blockchain'])!!}
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Phone number <span
                        class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!!Form::text('phone',null,['class'=>'form-control','maxlength'=>'11', 'id'=>'phone', 'placeholder' => 'Enter phone number'])!!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Country <span class="lable_red">*</span></label>
                <div class="col-sm-10">
                    <select class="form-control" data-val-required="Please choose the Country" 
                            aria-describedby="Country-error" id="country" name="country">
                        <option value="" selected="selected">[---Choose Country---]</option>
                        @foreach($listcountry as $key =>$value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Password<span
                        class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password<span
                        class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!! Form::password('repassword', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Terms of use</label>
                <div class="col-xs-10">
                    <div style="border: 1px solid #e5e5e5; height: 200px; overflow: auto; padding: 10px;">
                        {!!$termsofuse!!}
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Agree with terms and conditions<span
                        class="lable_red">*</span></label>
                <div class="col-sm-9">
                    <div class="checkbox">
                        <label>
                            <!--  <input type="checkbox" value="check" id="checkbox"> -->
                            {!! Form::checkbox('isCondition', '1') !!}
                        </label>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="form-group" align="center">
                    @if(count($errors) > 0)
                        {!! Form::submit('Register',['class' => 'addBTCSubmitBtn', 'disabled'=>'disabled','onclick' => 'submitform();']) !!}
                    @else
                        {!! Form::submit('Register',['class' => 'addBTCSubmitBtn','onclick' => 'submitform();']) !!}
                    @endif
                </div>
            </div>
            <!-- /.box-footer -->
        </div>
    </form>

</div>

@endsection
