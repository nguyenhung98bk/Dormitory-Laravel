@extends('master')
@section('content')
	@if($count!=0)
		<h3 style="">
         	<i class="fa fa-arrow-circle-o-right"></i>
                Lịch sử đăng ký           
        </h3>
		<div class="lsdk">
		<table class="table table-bordered table-striped datatable" id="table_export">
		<thead>
			<tr>
				<th>Mssv</th>
				<th>Họ Tên</th>
				<th>Năm</th>
				<th>Trạng thái đăng ký</th>
				<th>Ngày đăng ký</th>
				<th>Ngày duyệt</th>
				<th>Lệ phí ở</th>
				<th>Mã số cán bộ xác nhận</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lsdk as $l)
			<tr>
				<td>{{$l->mssv}}</td>
				<td>{{$l->name}}</td>
				<td>{{$l->nam}}</td>
				<td><span class="label label-success" style="font-size: 15px;">{{$l->trangthaidk}}</span></td>
				<td>{{$l->ngaydk}}</td>
				<td>{{$l->ngayduyet}}</td>
				<td>{{$l->lephi}}</td>
				<td>{{$l->mscb}}</td>		
			</tr>
			@endforeach
		</tbody>
		</table>
		</div>
		</div>
	@else 
	<div>
		<h2>Bạn chưa có lịch sử đăng ký</h2>
	</div>
	@endif
@endsection