@extends('master')
@section('content')
<h3 style="">
    <i class="fa fa-arrow-circle-o-right"></i>
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
        @if(Session::has('flag2'))
            <div class="error"><p>{{Session::get('message')}}</p></div>
        @endif
        <div class="tab-content">
            <!----EDITING FORM STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                	<form action="{{url('student_suatt')}}" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-5 control-label">Ảnh thẻ sinh viên</label>
                            <div class="col-sm-5">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 300px;" data-trigger="fileinput">
                                        <img src="../img/img_user/{{Auth::user()->image}}" alt="...">
                                    </div>
                                    <p id="linkImage"></p>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new">Thay đổi ảnh cá nhân</span>
                                            <input id="link" type="file" name="userfile" onchange="hasLink()">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function hasLink(){
                                var x = document.getElementById("link").value;
                                document.getElementById("linkImage").innerHTML = x;
                            }
                        </script>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Tên</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{Auth::user()->name}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">E-mail</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{Auth::user()->email}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Mã số sinh viên</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{$ttsv->mssv}}</label>
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
                                <select name="gtsv" class="form-control required">
                                    @if($ttsv->gtsv=="nam")
                                        <option value="">Chọn</option>
                                        <option value="nam" selected>Nam</option>
                                        <option value="nu">Nữ</option>
                                    @elseif($ttsv->gtsv=="nu")
                                        <option value="">Chọn</option>
                                        <option value="nam">Nam</option>
                                        <option value="nu" selected="">Nữ</option>
                                    @else
                                        <option value="">Chọn</option>
                                        <option value="nam">Nam</option>
                                        <option value="nu">Nữ</option>
                                    @endif
                              </select>
                            </div>
                            <label class="col-sm-2 control-label">Quê Quán</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="qqsv" value="{{$ttsv->qqsv}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lớp</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="lop" value="{{$ttsv->lop}}" required/>
                            </div>
                            <label class="col-sm-2 control-label">Khóa</label>
                            <div class="col-sm-3">
                                <select name="khoa" class="form-control required">
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