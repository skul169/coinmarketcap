<div class="box profile">
    <div class="box-header with-border">
        <h3 class="box-title">PROFILE</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" action="{{route('member.update')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">User name</label>

                <div class="col-sm-10">
                    {!!Form::text('username',$profile->username,['class'=>'form-control','maxlength'=>'', 'id'=>'','readonly'=>'readonly'])!!}

                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Avatar</label>

                <div class="col-sm-8">
                    <input readonly="readonly" class="form-control form-control-disable" id="imgavatar"  type="text">

                </div>
                <div class="col-sm-1">
                    <div class="fileUpload btn btn-primary">
                        <span>Avatar</span>
                        <input id="uploadBtn3" type="file" class="upload" name="avatar" />
                    </div>
                </div>
            </div>

            @if($profile->avatar!="")
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-8">
                    @if($profile->avatar!="")
                    {!! HTML::image('uploads/images/avatar/'.$profile->avatar, 'Avatar', array('class' => 'thumb')) !!}
                    @endif
                </div>
            </div>
            @endif
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Link Referer</label>
                <div class="col-sm-8">
                    <input readonly="readonly" class="form-control form-control-disable" id="LinkReferer" name="LinkReferer" type="text" value="{{$referer}}">

                </div>
                <div class="col-sm-1">
                    <button type="button" onClick="copyfieldvalue(event, 'LinkReferer');return false"class="fileUpload btn btn-primary">Copy</button>
                </div>

            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name <span class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!!Form::text('name',$profile->name,['class'=>'form-control','maxlength'=>'35', 'id'=>'name'])!!}
                </div>
            </div>


            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email <span class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!!Form::email('email',$profile->email,['class'=>'form-control', 'id'=>'email'])!!}
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Phone number <span class="lable_red">*</span></label>
                <div class="col-sm-10">
                    {!!Form::text('phone',$profile->phone,['class'=>'form-control','maxlength'=>'11', 'id'=>'phone'])!!}
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Block chain <span class="lable_red">*</span></label>
                <div class="col-sm-10">

                    {!!Form::text('blockchain',$profile->blockchain,['class'=>'form-control','maxlength'=>'', 'id'=>'blockchain'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Person ID</label>
                <div class="col-sm-10">
                    {!!Form::text('peopleid',$profile->peopleid,['class'=>'form-control', 'id'=>'peopleid'])!!}

                </div>

            </div>


            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Images Person ID </label>

                <div class="col-sm-3">
                    <input id="imgpepole1" placeholder="Choose Fontside of Person ID" disabled="disabled" class="form-control" />
                </div>

                <div class="col-sm-2">
                    <div class="fileUpload btn btn-primary">
                        <span>Fontside</span>
                        <input id="uploadBtn1" type="file" class="upload" name="fontside" />
                    </div>
                </div>

                <div class="col-sm-3">
                    <input id="imgpepole2" placeholder="Choose Backside of Person ID" disabled="disabled" class="form-control" />
                </div>

                <div class="col-sm-2">
                    <div class="fileUpload btn btn-primary">
                        <span>Backside</span>
                        <input id="uploadBtn2" type="file" class="upload" name="backside" />
                    </div>
                </div>


            </div>



            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>

                <div class="col-sm-5">
                    @if($profile->fontside!="")
                    {!! HTML::image('uploads/images/personid/'.$profile->fontside, 'Fontside', array('class' => 'imgpersonid')) !!}
               @endif
                </div>

                <div class="col-sm-5">
                    @if($profile->backside!="")
                    {!! HTML::image('uploads/images/personid/'.$profile->backside, 'Backside', array('class' => 'imgpersonid')) !!}
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Day Of Birth <span class="lable_red">*</span></label>
                <div class="col-sm-10">

                        <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask name="birthday" value="{{$profile->birthday}}">

                </div>

            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Gender <span class="lable_red">*</span></label>
                <div class="col-sm-10">
                    <select class="form-control" id="gender" name="gender">

                        @if($gender==0)
                            <option value="0">[----Choose Gender----]</option>
                            <option  value="1">Male</option>
                            <option value="2">Female</option>
                        @else
                            <option value="{{$gender}}" selected="selected">{{$gender_name}}</option>
                            <option  value="{{$genderop_value}}">{{$genderop_name}}</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Address <span class="lable_red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$profile->address}}" name="address" id="address">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Country <span class="lable_red">*</span></label>
                <div class="col-sm-10">
                    <select class="form-control" data-val-required="Please choose the Country" aria-describedby="Country-error" id="country" name="country">

                        @if($profile->country!='')

                        <option value="{{$profile->country}}" selected="selected">{{$listcountry[$profile->country]}}</option>
                        @foreach($listcountry as $key =>$value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                        @else
                            <option value="" selected="selected">[---Choose Country---]</option>
                            @foreach($listcountry as $key =>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        @endif


                    </select>

                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group" align="center">
                <button type="submit" class="btn btn-primary" id="add_city">Update</button>
                <input type="reset" name="reset" value="Reset" class="btn btn-default">
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
</div>