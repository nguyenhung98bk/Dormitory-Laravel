@extends('trangchu_master')
@section('content')
<div class="login-area">
			<div class="login-content">
				<form method="post" role="form" id="form_login" action="../function/registration.php">
					<table class="loginform_row" width="100%" cellpadding="10	" cellspacing="0" style="font-size: 10pt;" border="0">
					<tr><td><input type="text" class="input-field" name="Hoten" placeholder="Họ tên" required autocomplete="off" maxlength="30"></td>
					<td><input type="text" class="input-field" name="Username" placeholder="Tên đăng nhập" required autocomplete="off" maxlength="30"></td></tr>
					<tr><td><input type="Password" class="input-field" name="Password" placeholder="Mật khẩu" required autocomplete="off" maxlength="30"></td>
					<td><input type="Password" class="input-field" name="Confirmpassword" placeholder="Xác nhận mật khẩu" required autocomplete="off" maxlength="30"></td></tr>
					<tr><td><input type="text" class="input-field" name="Sdt" placeholder="Số điện thoại" required autocomplete="off" maxlength="11"></td>
						<td><input type="text" class="input-field" name="Mssv" maxlength="8" placeholder="Mã số sinh viên" required autocomplete="off"></td></tr>
					<tr>
					<td><input type="text" class="input-field" name="Lop" placeholder="Lớp-Khóa" required autocomplete="off" maxlength="10"></td>
					<td><input type="text" class="input-field" name="Quequan" placeholder="Quê quán" required autocomplete="off" maxlength="20"></td></tr>
					<tr><td width="220px"><div>Ngày sinh:</div></td>
						<td><input type="date" class="input-field" name="Ngaysinh" placeholder="Ngày sinh" required autocomplete="off"></td>
					</tr>
					</table>	
					<div class="Gioitinh">Giới tính: 
							<input type="radio" name="Gioitinh" value="nam" required checked="checked" autocomplete="off"> Nam <input type="radio" name="Gioitinh" value="nu" required autocomplete="off"> Nữ </div>					
					<button type="submit" class="btn btn-primary">Đăng Ký</button>
				</form>
			</div>
		</div>		
@endsection