@extends('master')
@section('content')
@if(isset($khu))
<h3 onload="on()">
    <i class="fa fa-arrow-circle-o-right"></i></i>
        Sửa thông tin khu kí túc xá
</h3>
<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
                    Chỉnh sửa thông tin
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
        @if(Session::has('flag'))
            <div class="error"><p>{{Session::get('message')}}</p></div>
        @endif
        <div class="tab-content">
            <!----EDITING FORM STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                	<form action="{{url('ad_updatekhu',$khu->id)}}" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                        <div class="form-group">
                        	<label for="field-1" class="col-sm-3 control-label" style="float: left;">Trạng thái : </label>
                        	<div class="col-sm-5" style="text-align: center; font-size: 20px;">
								<div style="height: 36px; width: 140px; padding: 0px;">
									<div id="off" style="width: 50%;height: 100%; float: left; border-radius: 6px 0px 0px 6px;" onclick="ConfirmDialog1()">
										<span>OFF</span>
									</div>
									<div id="on" style="width: 50%;height: 100%; float: right; border-radius: 0px 6px 6px 0px;" onclick="ConfirmDialog2()">
										<span>ON</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">Giá phòng : </label>
							<div class="col-sm-3">
								<input type="number_format" class="form-control" name="giaphong" value="{{number_format($khu->giaphong)}}" required/>
							</div>
						</div>
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">Thêm tầng : </label>
							<div class="col-sm-3">
								<input id="tang" type="number" class="form-control" name="tang" value="0" required/>
							</div>
						</div>
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">Số người một phòng : </label>
							<div class="col-sm-3">
								<input id="tang" type="number" class="form-control" name="songuoi" value="0" required/>
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
		<script type="text/javascript">
			var off = function(){
				document.getElementById("on").style.backgroundColor = "#A9A9A9";
				document.getElementById("off").style.backgroundColor = "#DC143C";
			}
			var on = function(){
				document.getElementById("off").style.backgroundColor = "#A9A9A9";
				document.getElementById("on").style.backgroundColor = "	#7FFF00";
			}
			var plus = function(){
				tang = tang + 1;
				document.getElementById("tang").value = tang;
			}
		</script>
		@if($khu->trangthai==1)
			<script type="text/javascript">
				window.onload=on();
				function ConfirmDialog1()  {
					var result = confirm("Bạn có chắc chắn muốn thay đổi trạng thái");
					if(result){
						window.location="{{route('ad_updatetrangthai',[0,$khu->id])}}";
					}
				}
			</script>
		@else
			<script type="text/javascript">
				window.onload=off();
				function ConfirmDialog2()  {
					var result = confirm("Bạn có chắc chắn muốn thay đổi trạng thái");
					if(result){
						window.location="{{route('ad_updatetrangthai',[1,$khu->id])}}";
					}
				}
			</script>
		@endif
@endif
@endsection