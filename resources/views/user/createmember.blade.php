<html>
    <head>
        <meta charset="UTF-8">
        <title> Romanbi system - @yield('htmlheader_title', 'Register') </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
              type="text/css"/>
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
        <!-- Datepicker -->
        <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
        <!-- Theme style -->
        <link href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet" type="text/css"/>
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="{{ asset('css/skins/skin-yellow-light.css') }}" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="{{ asset('plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css"/>

        <link href="{{ asset('css/global_style.css') }}" rel="stylesheet" type="text/css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="skin-yellow-light sidebar-mini">
        <div class="wrapper">

            <style>
                .main-header > .navbar {
                    -webkit-transition: margin-left 0.3s ease-in-out;
                    -o-transition: margin-left 0.3s ease-in-out;
                    transition: margin-left 0.3s ease-in-out;
                    margin-bottom: 0;
                    margin-left: 230px;
                    border: none;
                    min-height: 50px;
                    border-radius: 0;
                    background: #3c8dbc;
                }

                .main-header .logo {
                    -webkit-transition: width 0.3s ease-in-out;
                    -o-transition: width 0.3s ease-in-out;
                    transition: width 0.3s ease-in-out;
                    display: block;
                    float: left;
                    height: 50px;
                    font-size: 20px;
                    line-height: 50px;
                    text-align: center;
                    width: 230px;
                    font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                    padding: 0 15px;
                    font-weight: 300;
                    overflow: hidden;
                    background: #367fa9;
                    color: #fff;
                }

                .box-header {
                    color: #444;
                    display: block;
                    padding: 10px;
                    position: relative;
                    margin-left: 30px;
                }
            </style>
            <header class="main-header">

                <!-- Logo -->
                <a href="{{ url('/home') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">{!! HTML::image('uploads/images/avatar/'.$logo, 'User Image', array('width' => '50px')) !!}</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">{!! HTML::image('uploads/images/avatar/'.$logo, 'User Image', array('width' => '100px')) !!}</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->

                    <!-- Navbar Right Menu -->

                </nav>
            </header>

            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personal Information</h3>
                    </div><!-- /.box-header -->

                    @if (session('message'))
                    <div class="alert alert-success">
                        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>{!! session('message') !!}
                    </div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)

                        {{ $error }}<br>

                        @endforeach
                    </div>
                    @endif

                    @if (session('err'))
                    <div class="alert alert-danger">
                        {{ session()->get('err') }}
                    </div>
                    @endif

                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session()->get('status') }}
                        <META http-equiv="refresh" content="1;URL={{ url('/') }}">
                    </div>
                    @endif


                    <!-- form start -->

                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{{route('user.storemember')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">


                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">User Referer</label>
                                <div class="col-sm-9">
                                    <input readonly="readonly" class="form-control form-control-disable"
                                           data-val-required="Please enter your UserName" aria-describedby="LinkReferer-error"
                                           id="UserReferer" name="userreferer" type="text" value="{{$username}}">
                                </div>
                                <div class="col-sm-1">
                                    <input type="reset" name="reset" value="Reset" class="btn btn-success"
                                           style="background: #7da936">
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
                                <label for="inputBlockchain3" class="col-sm-2 control-label">Blockchain <span
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
                                <label for="inputEmail3" class="col-sm-2 control-label">Agree with term and condition<span
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

                                    {!! Form::submit('Register',['class' => 'addBTCSubmitBtn','onclick' => 'submitform();']) !!}
                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </body>
</html>


