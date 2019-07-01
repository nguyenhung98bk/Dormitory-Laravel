<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phong;
use App\khuktx;
use App\sinhvien;
use App\phieudangky;
use App\canboquanly;
use App\users;
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
        $ttphong = phong::where('id_khu','=',$id)->paginate(7);
        return view('pages.Student_dkphong',['ttphong'=>$ttphong]);
    }
    public function student_bancp(){
    	return view('pages.Student_bancp');
    }
    public function student_cbql(){
        $cbql = users::where('ltk','quanly')->get();
    	return view('pages.Student_cbql',['cbql'=>$cbql]);
    }
    public function student_doimk(){
    	return view('pages.Student_doimk');
    }
    public function student_ttcn(){
        $ttsv = sinhvien::where('email',Auth::user()->email)->first();
    	return view('pages.Student_ttcn',['ttsv'=>$ttsv]);
    }
    public function student_xemdk(){
        $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
        $lsdk = phieudangky::where('mssv','=',$mssv)->get();
        $count = phieudangky::where('mssv','=',$mssv)->count();
    	return view('pages.Student_xemdk',['lsdk'=>$lsdk,'count'=>$count]);
    }
    public function ql_phong(){
        return view('pages.ql_phong');
    }
    public function ql_duyetdk(){
        return view('pages.ql_duyetdk');
    }
    public function ql_ttsv(){
        return view('pages.ql_ttsv');
    }
    public function ql_cpsv(){
        return view('pages.ql_cpsvg');
    }
    public function ql_thongke(){
        return view('pages.ql_thongke');
    }
}
