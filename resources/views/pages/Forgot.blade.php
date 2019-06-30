@extends('trangchu_master')
@section('content')
<div class="login-area">
	<div class="login-content">
		<form method="post" role="form" id="form_login" action="../function/forgot.php">
			<input type="text" class="input-field" name="Username" placeholder="Tên đăng nhập" required autocomplete="off">
			<input type="text" class="input-field" name="Mssv" placeholder="Mã số sinh viên" required autocomplete="off">
			<input type="text" class="input-field" name="Sdt" placeholder="Số điện thoại" required autocomplete="off">		<button type="submit" class="btn btn-primary">Tiếp tục</button>
		</form>
	</div>
</div>
@endsection		