@extends('app')

@section('htmlheader_title')
   FAQ
@endsection

@section('main-content')
    <div class="box">
        <div class="box-body">
            <!-------->
            <div id="content">

                    <div class="box-body">
                        <div class="row" style="margin-bottom: 15px">
                            <div class="col-sm-12" align="center">
                                <span class="my_token_current"> <strong></strong> SUPPORT MEMBER  </span>
                            </div>
                        </div>
                        <!--- Table data -->
                        <!-- /.box-header -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><span class="my_invest_current"><strong>FAQ</strong></span></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="box-group" id="accordion">
                                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        @foreach($faq as $index=>$value)
                                            <div class="panel box {{$boxcolor[$index+1]}}">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#{{$value->id}}">
                                                            {{$index+1}}. {{$value->question}}?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="{{$value->id}}" class="panel-collapse collapse">
                                                    <div class="box-body">
                                                        {{$value->answer}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- /.box-body -->
                    </div>
            </div> <!---- close content-->
        </div><!-- /.box-body -->
    </div><!---- box -->
@endsection

