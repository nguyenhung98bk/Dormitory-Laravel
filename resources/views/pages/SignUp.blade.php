@extends('trangchu_master')
@section('content')
<div class="login-area">
	<div class="login-content">
		<form method="post" role="form" id="form_login"
            action="{{url('register')}}">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }} ">
				<input type="text" class="input-field" name="name" placeholder="Họ tên"
                	required autocomplete="off" maxlength="30">
				<input type="email" class="input-field" name="email" placeholder="Email"
                	required autocomplete="off" maxlength="30">
				<input type="Password" class="input-field" name="password" placeholder="Mật khẩu"
                	required maxlength="30">
                <input id="password-confirm" type="password" class="input-field" name="password_confirmation" placeholder="Xác nhận mật khẩu" required maxlength="30">
                @if($errors->has('password'))
					<div class="error"><p>{{$errors->first('password')}}</p></div>
				@endif
				@if(Session::has('flag'))
					<div class="error"><p>{{Session::get('message')}}</p></div>
				@endif
				<button type="submit" class="btn btn-primary">Đăng ký</button>
			</div>
		</form>
		<div class="login-bottom-links">
			<a href="{{route('login')}}"><button class="links">Đăng nhập</button></a>
		</div>
	</div>
</div>		
@endsection