@extends('master')
@section('content')
	<h3 style="">
         <i class="fa fa-arrow-circle-o-right"></i>
            Danh sách sinh viên         
    </h3>
	<table class="table table-bordered table-striped datatable" id="table_export">
		<tr>
			<th>Mssv</th>
			<th>Họ tên</th>
			<th>Trạng thái đăng ký</th>
			<th>Ngày đăng ký</th>
			<th>Ngày duyệt</th>
			<th>Xem thông tin</th>
		</tr>
		@foreach($list as $l)
		<tr>
			<td>{{$l->mssv}}</td>
			<td>{{$l->name}}</td>
			<td>{{$l->trangthaidk}}</td>
			<td>{{$l->ngaydk}}</td>
			<td>{{$l->updated_at}}</td>
			<td><a href="{{route('get_ql_ttsv',$l->mssv)}}"><button>Xem</button></a></td>
		</tr>
		@endforeach
	</table>
@endsection