@extends('trangchu_master')
@section('content')
		<form method="post" role="form" class="form_login" action="../function/forgot.php">
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="Mssv" placeholder="Mã số sinh viên">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="Sdt" placeholder="Số điện thoại">
			</div>
			<div class="form-check">
				<button type="submit" class="btn btn-primary">Tiếp tục</button>
			</div>
		</form>
@endsection		