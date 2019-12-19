@extends('master')
@section('content')
	<div class="container-content">
	@if(isset($ttphong))
		<div class="list_phong">
			<h3 style="">
         		<i class="fa fa-arrow-circle-o-right"></i>
                	Thông tin khu {{$khu->tenkhu}}         
        	</h3>
        	<div class="row" style="padding-top: 20px">
			    <div class="col-md-12">
			        <!------CONTROL TABS START------>
			        <ul class="nav nav-tabs bordered">
			            <li class="active">
			                <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
			                    Danh sách phòng
			                </a>
			            </li>
			        </ul>
			    </div>
		@if(Session::has('flag'))
			<div class="error"><p>{{Session::get('message')}}</p></div>
		@endif
	<table class="table table-bordered table-striped datatable" id="table_export">
		<tr>
			<th>Số phòng</th>
			<th>Số người đk hiện tại</th>
			<th>Số người tối đa</th>
			<th>Giới tính</th>
			<th>Trạng thái</th>
			<th>Chỉnh sửa</th>
		</tr>
		@foreach($ttphong as $p)
		<form action="{{url('post_ad_suaphong',$p->id)}}" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }} ">
			<tr>
				<td>{{$p->sophong}}</td>
				<td>{{$p->sncur}}</td>
				<td><input type="number" class="form-control" value="{{$p->snmax}}" name="snmax" required/></td>
				<td>
					<select name="gioitinh" class="form-control required">
                        @if($p->gioitinh=="nam")
                            <option value="nam" selected>Nam</option>
                            <option value="nu">Nữ</option>
                        @else
                            <option value="nam">Nam</option>
                            <option value="nu" selected="">Nữ</option>
                        @endif
                	</select>
				</td>
				<td>
					@if($p->trangthai==1)
						<span class="label label-success"><a href="{{route('ad_updatettphong',[0,$p->id])}}">ON</a></span>
					@else
						<span class="label label-danger"><a href="{{route('ad_updatettphong',[1,$p->id])}}">OFF</a></span>
					@endif
				</td>
				<td><button>Chỉnh sửa</button></td>
			</tr>
		</form>
		@endforeach
	</table>
</div>
<div class="row">
	<div class="col-xs-6 col-left"></div>
	<div class="col-xs-6 col-right"> 
		<div class="dataTables_paginate paging_bootstrap">
			{!! $ttphong->links() !!}
		</div>
	</div>
</div>
	@else
	<h3 style="">
        <i class="fa fa-arrow-circle-o-right"></i>
        Danh sách khu kí túc xá           
    </h3>
	<table class="table table-bordered table-striped datatable" id="table_export">
		<tr>
			<th>STT</th>
			<th>Tên Khu ở</th>
			<th>Giá phòng</th>
			<th>Trạng thái</th>
			<th>Danh sách phòng</th>
			<th>Chỉnh sửa</th>
		</tr>
		@foreach($ttkhu as $k)
		<tr>
			<td>{{$k->id}}</td>
			<td>{{$k->tenkhu}}</td>
			<td>{{number_format($k->giaphong)}}</td>
			<td>
				@if($k->trangthai==1)
					<span class="label label-success">ON</span>
				@else
					<span class="label label-danger">OFF</span>
				@endif
			</td>
			<td><a href="{{route('ad_chonphong',$k->id)}}"><button>Xem</button></a></td>
			<td><a href="{{route('ad_suakhu',$k->id)}}"><button>Chỉnh sửa</button></a></td>
		</tr>
		@endforeach
	</table>
</div>
	</div>
	@endif
@endsection