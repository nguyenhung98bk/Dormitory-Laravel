@extends('trangchu_master')
@section('content')
<div class="login-area">
	<div class="login-content">
		<form method="post" role="form" id="form_login"
            action="{{url('login')}}">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }} ">
				<input type="text" class="input-field" name="email" placeholder="Tài khoản"
                	required autocomplete="off" maxlength="30">
                <br>
				<input type="Password" class="input-field" name="password" placeholder="Mật khẩu"
                	required maxlength="30">
                <br>
				<button type="submit" class="btn btn-primary">Đăng nhập</button>
		@if(Session::has('flag'))
			<div class="error"><p>{{Session::get('message')}}<p></div>
		@endif
		<div class="login-bottom-links">
			<ul>
				<li><a href="{{route('SignUp')}}" class="link">Tạo tài khoản</a></li>
            	<li><a href="{{route('Forgot')}}" class="link">Quên mật khẩu</a></li>
            </ul>
		</div>
			</div>
		</form>
	</div>
</div>		
@endsection