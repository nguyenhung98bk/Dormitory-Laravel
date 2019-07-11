@extends('trangchu_master')
@section('content')
<div class="login-area">
	<div class="login-content">
		<form method="post" role="form" id="form_login"
            action="{{url('login')}}">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }} ">
				<input type="email" class="input-field" name="email" placeholder="Email"
                	required maxlength="30">
                <br>
				<input type="Password" class="input-field" name="password" placeholder="Mật khẩu"
                	required maxlength="30">
                @if($errors->has('password'))
					<div class="error"><p>{{$errors->first('password')}}</p></div>
				@endif
                <br>
				<button type="submit" class="btn btn-primary">Đăng nhập</button>
				@if(Session::has('flag'))
					<div class="error"><p>{{Session::get('message')}}</p></div>
				@endif
			</div>
		</form>
		<div class="login-bottom-links">
			<a href="{{route('SignUp')}}" class="link"><button class="links">Tạo tài khoản</button></a>
			<br>
           	<a href="{{route('Forgot')}}" class="links">Quên mật khẩu ?</a>
		</div>
	</div>
</div>		
@endsection