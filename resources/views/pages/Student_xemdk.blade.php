@extends('master')
@section('content')
	
		<table>
			<tr>
				<td>Mssv</td>
				<td>Họ Tên</td>
				<td>Năm</td>
				<td>Trạng thái đăng ký</td>
				<td>Ngày đăng ký</td>
				<td>Ngày duyệt</td>
				<td>Lệ phí ở</td>
				<td>Mã số cán bộ xác nhận</td>
			</tr>
			@foreach($lsdk as $l)
			<tr>
				<td>{{$l->mssv}}</td>
				<td>{{$l->name}}</td>
				<td>{{$l->nam}}</td>
				<td>{{$l->trangthaidk}}</td>
				<td>{{$l->ngaydk}}</td>
				<td>{{$l->ngayduyet}}</td>
				<td>{{$l->lephi}}</td>
				<td>{{$l->mscb}}</td>		
			</tr>
			@endforeach
		</table>
	
@endsection