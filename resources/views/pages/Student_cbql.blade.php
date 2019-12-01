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
            </tr>
        </thead>
        <tbody>
        	@foreach($cbql as $c)
        		<tr>
        			<td><img src="img/img_ql/{{$c->image}}" width="80px" max-height="100px"></td>
        			<td>{{$c->name}}</td>
        			<td>{{$c->email}}</td>
        		</tr>
        	@endforeach
        </tbody>
    </table>
@endsection