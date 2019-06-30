<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phieudangky;
use App\sinhvien;
use Illuminate\Support\Facades\Auth;
use App\phong;
use App\khuktx;

class LoadController extends Controller
{
   	public function get_student_dkphong($id){
   		$mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
   		$id_khu = phong::where('id',$id)->value('id_khu');
   		$giaphong = khuktx::where('id',$id_khu)->value('giaphong');
   		phieudangky::insert(['id_phong'=>$id,'mssv'=>$mssv,'nam'=>date('Y'),'trangthaidk'=>'registered','ngaydk'=>date('Y-m-d'),'lephi'=>$giaphong*(13-date('m')),'name'=>Auth::user()->name]);
   		return redirect('student_xemdk');
   	}
}
