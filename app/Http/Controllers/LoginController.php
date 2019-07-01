<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use App\users;
use App\User;
use Hash;
use App\sinhvien;

class LoginController extends Controller
{
    public function getLogin() {
    	return view('pages.login');
    }
    public function postLogin(Request $request) {
    	$rules = [
    		'email' =>'required|email',
    		'password' => 'required|min:6'
    	];
    	$messages = [
    		'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
    		$email = $request->input('email');
    		$password = $request->input('password');

    		if( Auth::attempt(['email' => $email, 'password' =>$password])) {
    			return redirect()->intended('/');
    		} else {
    			return redirect()->back()->with(['flag'=>'danger','message'=>'Tài khoản hoặc mật khẩu không chính xác']);
    		}
    	}
	}
	public function logout(){
		Auth::logout();
		return redirect('login');
	}
    public function register(Request $request){
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6|confirmed'
        ];
        $messages = [
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $count = users::where('email',$email)->count();
            if($count>0){
                return redirect()->back()->with(['flag'=>'danger','message'=>'Email đã được sử dụng']);   
            }
            else{
                $user = new User();
                sinhvien::insert(['email'=>$email]);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->image = "user.jpg";
                $user->ltk = "sinhvien";
                $user->save();
                return redirect()->back()->with(['flag'=>'danger','message'=>'Tạo thành khoản thành công']);   
            }
        }
    }
}

?>