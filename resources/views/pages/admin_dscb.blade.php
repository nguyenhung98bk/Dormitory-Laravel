@extends('master')
@section('content')
	<h3 style="">
        <i class="entypo-right-circled"></i>
        Cán bộ quản lý
    </h3>        
    <table class="table table-bordered datatable" id="table_export">
        <thead>
            <tr>
            	<th width="100"><div>Ảnh</div></th>
                <th><div>Tên</div></th>
                <th><div>E-mail</div></th>
                <th><div>Xem thông tin</div></th>
                <th><div>Xóa tài khoản</div></th>
            </tr>
        </thead>
        <tbody>
        	@foreach($cbql as $c)
        		<tr>
        			<td><img src="img/{{$c->image}}"></td>
        			<td>{{$c->name}}</td>
        			<td>{{$c->email}}</td>
                    <td><a href="{{route('ad_xemcb',$c->id)}}"><button>Xem</button></a></td>
                    <td><a href="{{route('ad_xoacb',$c->id)}}"><button>Xóa</button></a></td>
        		</tr>
        	@endforeach
        </tbody>
    </table>
@endsection