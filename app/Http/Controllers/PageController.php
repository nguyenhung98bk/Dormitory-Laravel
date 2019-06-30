<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phong;
use App\khuktx;
use App\sinhvien;
use App\phieudangky;
use DB;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
	public function trangchu(){
    	return view('pages.trangchu');
    }
    public function student_dkphong(){
        $ttkhu = khuktx::ALL();
        return view('pages.Student_dkphong',['ttkhu'=>$ttkhu]);
    }
    public function student_chonphong($id){
        $ttphong = phong::where('id_khu','=',$id)->paginate(5);
        return view('pages.Student_dkphong',['ttphong'=>$ttphong]);
    }
    public function student_bancp(){
    	return view('pages.Student_bancp');
    }
    public function student_cbql(){
    	return view('pages.Student_cbql');
    }
    public function student_doimk(){
    	return view('pages.Student_doimk');
    }
    public function student_ttcn(){
    	return view('pages.Student_ttcn');
    }
    public function student_xemdk(){
        $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
        $lsdk = phieudangky::orderBy('nam', 'asc')->get();
    	return view('pages.Student_xemdk',['lsdk'=>$lsdk]);
    }
}
