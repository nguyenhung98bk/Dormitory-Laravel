@extends('master')
@section('content')
<h3 style="">
    <i class="entypo-right-circled"></i>
    Quản lý hồ sơ           
</h3>
﻿<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
                    Quản lý hồ sơ
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----EDITING FORM STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                	<form action="" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tên</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{Auth::user()->name}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{Auth::user()->email}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mã số sinh viên</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="mssv" value="{{$ttsv->mssv}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số điện thoại</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="phone" value="{{$ttsv->sdt}}" required/>
                            </div>
                            <label class="col-sm-2 control-label">Ngày sinh</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control datepicker " name="birthday" data-format="dd/mm/yyyy" value="{{$ttsv->nssv}}" data-start-view="2" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Giới tính</label>
                            <div class="col-sm-3">
                                <select name="sex" class="form-control required">
                                  <option value="">Chọn</option>
                                  <option value="male" selected>Nam</option>
                                  <option value="female">Nữ</option>
                              </select>
                            </div>
                            <label class="col-sm-2 control-label">Quê Quán</label>
                            <div class="col-sm-3">
                            	<select name="QueQuan" id = "fa_province" class="form-control required">
                            		<option value="">Chọn tỉnh</option>
                            		<option value="Ha Noi" >Thành phố Hà Nội</option>
                            		<option value="Ha Giang" >Tỉnh Hà Giang</option>
                            		<option value="Cao Bang" >Tỉnh Cao Bằng</option>
                            		<option value="Bac Kan" >Tỉnh Bắc Kạn</option>
                            		<option value="Tuyen Quang" >Tỉnh Tuyên Quang</option>
                            		<option value="Lao cai" >Tỉnh Lào Cai</option>
                            		<option value="Dien Bien" >Tỉnh Điện Biên</option>
                            		<option value="Lai Chau" >Tỉnh Lai Châu</option>
                            		<option value="Son La" >Tỉnh Sơn La</option>
                            		<option value="Yen Bai" >Tỉnh Yên Bái</option>
                            		<option value="17" >Tỉnh Hoà Bình</option>
                            		<option value="19" >Tỉnh Thái Nguyên</option>
                            		<option value="20" >Tỉnh Lạng Sơn</option>
                            		<option value="22" >Tỉnh Quảng Ninh</option>
                            	</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lớp</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="lop" value="{{$ttsv->lop}}" required/>
                            </div>
                            <label class="col-sm-2 control-label">Khóa</label>
                            <div class="col-sm-3">
                                <select name="sex" class="form-control required">
                                	@if($ttsv->khoa!=null)
                                		<option value="{{$ttsv->khoa}}">{{strtoupper($ttsv->khoa)}}</option>
                                	@endif
                                  <option value="">Chọn</option>
                                  <option value="k60">K60</option>
                                  <option value="k61">K61</option>
                                  <option value="k62">K62</option>
                                  <option value="k63">K63</option>
                                  <option value="k64">K64</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
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