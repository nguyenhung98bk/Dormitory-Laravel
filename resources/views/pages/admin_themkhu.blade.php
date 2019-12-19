@extends('master')
@section('content')
	<h3 style="">
        <i class="fa fa-arrow-circle-o-right"></i></i>
        Thêm khu kí túc xá
    </h3>
    <div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
                    Thêm khu kí túc xá
                </a>
            </li>
        </ul>
        </div>
        <div style="padding-top: 50px">
        <!------CONTROL TABS END------>
        @if(Session::has('flag'))
            <div class="error"><p>{{Session::get('message')}}</p></div>
        @endif
        <div class="tab-content">
            <!----EDITING FORM STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                	<form action="{{url('post_ad_themkhu')}}" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                		<input type="hidden" name="_token" value="{{ csrf_token() }} ">
                		<div class="form-group">
                            <label class="col-sm-2 control-label">Tên khu :</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="name" required/>
                            </div>
                            <label class="col-sm-2 control-label">Cán bộ quản lý :</label>
                            <div class="col-sm-3">
                            	<select name="email" class="form-control required">
                            		<option>Chọn</option>
                            		@if(isset($list_cbql))
                            			@foreach($list_cbql as $l)
                            				<option value="{{$l->email}}">{{$l->name}}</option>
                            			@endforeach
                            		@endif
                            	</select>
                        	</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Giá phòng :</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="price" required/>
                            </div>
                            <label class="col-sm-2 control-label">Số người tối đa:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="number_people" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số tầng :</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="sotang" required/>
                            </div>
                            <label class="col-sm-2 control-label">Số phòng mỗi tầng :</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="sophongtang" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-5">
                                <button type="submit" class="btn btn-info">Cập nhật thông tin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection