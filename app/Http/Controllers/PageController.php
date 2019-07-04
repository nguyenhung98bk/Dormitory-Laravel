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
        $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
        $id_phong = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
            ['trangthaidk','success']
        ])->value('id_phong');
        $list = phieudangky::where([
            ['nam',date('Y')],
            ['trangthaidk','success'],
            ['id_phong',$id_phong]
        ])->get();
        $ttsv = sinhvien::all();
    	return view('pages.Student_bancp',['list'=>$list,'ttsv'=>$ttsv]);
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
        $ttphong = phong::all();
        $count = phieudangky::where('mssv','=',$mssv)->count();
        $ttkhu = khuktx::all();
    	return view('pages.Student_xemdk',['lsdk'=>$lsdk,'count'=>$count,'ttphong'=>$ttphong,'ttkhu'=>$ttkhu]);
    }
    public function ql_phong(){
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $ttphong = phong::where('id_khu',$id_khu)->paginate(7);
        return view('pages.ql_phong',['ttphong'=>$ttphong]);
    }
    public function ql_duyetdk(){
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $ttphong = phong::where('id_khu',$id_khu)->get();
        $max = phong::where('id_khu',$id_khu)->max('id');
        $count = phong::where('id_khu',$id_khu)->count();
        $list = phieudangky::where([
            ['nam',date('Y')],
            ['trangthaidk','registered'],
            ['id_phong','>',($max-$count)],
            ['id_phong','<=',$max]
        ])->get();
        return view('pages.ql_duyetdk',['list'=>$list,'ttphong'=>$ttphong]);
    }
    public function ql_ttsv(){
        return view('pages.ql_ttsv');
    }
    public function ql_cpsv(){
        return view('pages.ql_cpsv');
    }
    public function ql_thongke(){
        return view('pages.ql_thongke');
    }
}
