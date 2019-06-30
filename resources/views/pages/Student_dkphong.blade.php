@extends('master')
@section('content')
	@if(isset($ttphong))
	<table>
		<tr>
			<td>Số phòng</td>
			<td>Số người đk hiện tại</td>
			<td>Số người tối đa</td>
			<td>Đăng ký</td>
		</tr>
		@foreach($ttphong as $p)
		<tr>
			<td>{{$p->sophong}}</td>
			<td>{{$p->sncur}}</td>
			<td>{{$p->snmax}}</td>
			<td><a href="{{route('get_student_dkphong',$p->id)}}">Đăng ký</a></td>
		</tr>
		@endforeach
	</table>
	<div class="list_page"> 
		{!! $ttphong->links() !!}
	</div>
	@else
	<table>
		<tr>
			<td>STT</td>
			<td>Tên Khu ở</td>
			<td>Giá phòng</td>
			<td>Danh sách phòng</td>
		</tr>
		@foreach($ttkhu as $k)
		<tr>
			<td>{{$k->id}}</td>
			<td>{{$k->tenkhu}}</td>
			<td>{{$k->giaphong}}</td>
			<td><a href="{{route('student_chonphong',$k->id)}}">Xem</a></td>
		</tr>
		@endforeach
	</table>
	@endif
@endsection