<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phieudangky;
use App\canboquanly;
use App\sinhvien;
use Illuminate\Support\Facades\Auth;
use App\phong;
use App\khuktx;
use App\users;
use DB;
use Validator;
use Illuminate\Support\MessageBag;

class LoadController extends Controller
{
   	public function get_student_dkphong($id){
   		$ttsv = sinhvien::where('email',Auth::user()->email)->first();
   		$ttphong = phong::where('id',$id)->first();
   		$id_khu = $ttphong->id_khu;
   		$giaphong = khuktx::where('id',$id_khu)->value('giaphong');
   		$mssv = $ttsv->mssv;
   		$gtsv = $ttsv->gtsv;
   		$sncur = $ttphong->sncur;
   		$snmax = $ttphong->snmax;
   		$gioitinh = $ttphong->gioitinh;
   		$count = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
            ['trangthaidk','!=','cancelled']
         ])->count();
         $count1 = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
            ['trangthaidk','=','cancelled']
         ])->count();
         if($gtsv==""){
            return redirect()->back()->with(['flag'=>'danger','message'=>'Vui lòng cập nhật thông tin cá nhân  ']);
         }
         else{
       		if($count!=0){
       			return redirect()->back()->with(['flag'=>'danger','message'=>'Sinh viên đã đăng ký ở năm nay']);
       		}
       		elseif($gtsv!=$gioitinh){
            return redirect()->back()->with(['flag'=>'danger','message'=>'Giới tính không đúng']);   	
          }
          elseif ($sncur>=$snmax) {
   			    return redirect()->back()->with(['flag'=>'danger','message'=>'Phòng đã đầy']);
          }
          else{
            if($count1==0){
              phieudangky::insert(['id_phong'=>$id,'mssv'=>$mssv,'nam'=>date('Y'),'trangthaidk'=>'registered','ngaydk'=>date('Y-m-d'),'lephi'=>$giaphong*(13-date('m')),'name'=>Auth::user()->name]);
              $sncur=$sncur+1;
              DB::table('phong')->where('id',$id)->update(['sncur'=>$sncur]);
              return redirect('student_xemdk');
            }
            else{
              phieudangky::where([
                ['mssv',$mssv],
                ['nam',date('Y')]
                ])->update(['trangthaidk'=>'registered']);
              $sncur=$sncur+1;
              DB::table('phong')->where('id',$id)->update(['sncur'=>$sncur]);
              return redirect('student_xemdk');
            }
          }
        }
   	  }
    public function getStudent_chinhsua(){
       return view('pages.Student_chinhsua');
    }
    public function changePassword(Request $request){
       $rules = [
          'password' => 'required|min:6|confirmed'
       ];
       $messages = [
          'password.min' => 'Mật khẩu mới phải chứa ít nhất 6 ký tự',
          'password.confirmed' => 'Xác nhận mật khẩu không đúng'
       ];
       $validator = Validator::make($request->all(), $rules, $messages);

       if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
       } 
       else {
          $email = Auth::user()->email;
          $password = $request->input('password_cur');
          $password_new = $request->input('password');

          if( Auth::attempt(['email' => $email, 'password' =>$password])) {
             users::where('email',$email)->update(['password'=>bcrypt($password_new)]);
             return redirect()->back()->with(['flag'=>'success','message'=>'Đổi mật khẩu thành công']);;
          } 
          else {
             return redirect()->back()->with(['flag'=>'danger','message'=>'Mật khẩu không chính xác']);
          }
       }
    }

    public function ql_ttphong($id){
       $list = phieudangky::where([
          ['id_phong',$id],
          ['nam',date('Y')],
          ['trangthaidk','!=','cancelled']
       ])->get();
       return view('pages.ql_ttphong',['list'=>$list]);
    }
    public function get_ql_duyetdk($mssv){
       $mscb = canboquanly::where('email',Auth::user()->email)->value('mscb');
       phieudangky::where([
          ['mssv',$mssv],
          ['nam',date('Y')],
       ])->update(['trangthaidk'=>"success",'mscb'=>$mscb]);
       return redirect()->back();
    }
    public function get_ql_huydk($mssv){
       $mscb = canboquanly::where('email',Auth::user()->email)->value('mscb');
       $id_phong = phieudangky::where([
          ['mssv',$mssv],
          ['nam',date('Y')],
       ])->value('id_phong');
       $sncur = phong::where('id',$id_phong)->value('sncur');
       $sncur = $sncur-1;
       phieudangky::where([
          ['mssv',$mssv],
          ['nam',date('Y')],
       ])->update(['trangthaidk'=>"cancelled",'mscb'=>$mscb]);
       phong::where('id',$id_phong)->update(['sncur'=>$sncur]);
       return redirect()->back();
    }
    public function get_ql_ttsv($mssv){
       $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
       $max = phong::where('id_khu',$id_khu)->max('id');
       $count = phong::where('id_khu',$id_khu)->count();
       $ttsv = sinhvien::where('mssv',$mssv)->first();
       $name = users::where('email',$ttsv->email)->value('name');
       $lsdk = phieudangky::where([
          ['mssv',$mssv],
          ['trangthaidk','!=','cancelled'],
          ['id_phong','>',($max-$count)],
          ['id_phong','<=',$max]
       ])->orderBy('nam','desc')->get();
       $ttphong = phong::all();
       return view('pages.ql_ttsv',['ttsv'=>$ttsv,'name'=>$name,'ttphong'=>$ttphong,'lsdk'=>$lsdk]);
    }
    public function post_ql_ttsv(Request $request){
       $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
       $mssv = $request->input('mssv');
       $max = phong::where('id_khu',$id_khu)->max('id');
       $count = phong::where('id_khu',$id_khu)->count();
       $id_phong = phong::where('id_khu',$id_khu)->get();
       $lsdk = phieudangky::where([
          ['mssv',$mssv],
          ['trangthaidk','!=','cancelled']
       ])->orderBy('nam','desc')->whereIn('id_phong',$id_phong)->get();
       $ttphong = phong::all();
       if(count($lsdk)==0){
          return redirect('ql_ttsv')->with(['flag'=>'danger','message'=>'Không thể xem thông tin sinh viên']);
       }
       else{
          $ttsv = sinhvien::where('mssv',$mssv)->first();
          $name = users::where('email',$ttsv->email)->value('name');
          return view('pages.ql_ttsv',['ttsv'=>$ttsv,'name'=>$name,'ttphong'=>$ttphong,'lsdk'=>$lsdk]);
       }
    }
    public function get_ql_xoasv($mssv){
       $id_phong = phieudangky::where([
          ['mssv',$mssv],
          ['nam',date('Y')],
       ])->value('id_phong');
       $sncur = phong::where('id',$id_phong)->value('sncur');
       $sncur = $sncur-1;
       phieudangky::where([
          ['mssv',$mssv],
          ['nam',date('Y')],
       ])->update(['trangthaidk'=>"cancelled"]);
       phong::where('id',$id_phong)->update(['sncur'=>$sncur]);
       return redirect()->back();
    }
    public function student_suatt(Request $request){
      $checkFile = false;
      if($request->hasFile('userfile'))
      {  
          $file = $request->userfile;
          $file->move(
              'img/img_user',
              $file->getClientOriginalName()
          );
        $link = "{$file->getClientOriginalName()}";
        $checkFile = true;
      }
      $nssv = $request->input('birthday');
      $gtsv = $request->input('gtsv');
      $lop = $request->input('lop');
      $khoa = $request->input('khoa');
      $qqsv = $request->input('qqsv');
      $sdt = $request->input('phone');
      $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
      $count = phieudangky::where('mssv',$mssv)->count();
      if($checkFile==true){
        users::where('email',Auth::user()->email)->update(['image'=>$link]);
      }
      if($count!=0){
        sinhvien::where('email',Auth::user()->email)->update(['nssv'=>$nssv,'lop'=>$lop,'khoa'=>$khoa,'qqsv'=>$qqsv,'sdt'=>$sdt]);
        return redirect()->back()->with(['flag2'=>'danger','message'=>'Cập nhật thông tin thành công']);
      }
      else{
        sinhvien::where('email',Auth::user()->email)->update(['nssv'=>$nssv,'gtsv'=>$gtsv,'lop'=>$lop,'khoa'=>$khoa,'qqsv'=>$qqsv,'sdt'=>$sdt]);
        return redirect()->back()->with(['flag2'=>'danger','message'=>'Cập nhật thông tin thành công']);
      }
    }
    public function post_ql_thongke(Request $request){
       $year = $request->input('nam');
       $list_nam = phieudangky::select('nam')->groupBy('nam')->get();
      $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
      $max = phong::where('id_khu',$id_khu)->max('id');
      $count = phong::where('id_khu',$id_khu)->count();
      $nam = phong::where([
          ['id_khu',$id_khu],
          ['gioitinh','nam'],
      ])->sum('snmax');
      $nu = phong::where([
          ['id_khu',$id_khu],
          ['gioitinh','nu']
      ])->sum('snmax');
      $nam_dkcur = phong::where([
          ['id_khu',$id_khu],
          ['gioitinh','nam']
      ])->sum('sncur');
      $nu_dkcur = phong::where([
          ['id_khu',$id_khu],
          ['gioitinh','nu']
      ])->sum('sncur');
      $total_student = phieudangky::where([
          ['nam',$year],
          ['id_phong','>',($max-$count)],
          ['id_phong','<=',$max],
          ['trangthaidk','!=','cancelled'],
          ['trangthaidk','!=','registered']
      ])->count();
      $total_money = phieudangky::where([
          ['nam',$year],
          ['trangthaidk','!=','cancelled'],
          ['trangthaidk','!=','registered']
      ])->sum('lephi');
      return view('pages.ql_thongke',['nam'=>$nam,'nu'=>$nu,'nam_dkcur'=>$nam_dkcur,'nu_dkcur'=>$nu_dkcur,'total_student'=>$total_student,'total_money'=>$total_money,'list_nam'=>$list_nam,'year'=>$year]);
    }

    public function ad_xemcb($id){
       $email = users::where('id',$id)->value('email');
       $name = users::where('id',$id)->value('name');
       $ttcb = canboquanly::where('email',$email)->first();
       $ttkhu = khuktx::all();
       $tenkhu = khuktx::where('id',$ttcb->id_khu)->value('tenkhu');
       $image = users::where('email',$ttcb->email)->value('image');
       return view('pages.admin_ttcb',['ttcb'=>$ttcb,'tenkhu'=>$tenkhu,'name'=>$name,'ttkhu'=>$ttkhu,'image'=>$image]);
    }
    public function ad_xoacb($id){
       $email = users::where('id',$id)->value('email');
       canboquanly::where('email',$email)->delete();
       users::where('email',$email)->delete();
       return redirect()->back();
    }
    public function post_ad_ttcb(Request $request){
       $mscb = $request->input('mscb');
       $count = canboquanly::where('mscb',$mscb)->count();
       if($count!=1){
          return redirect('ad_ttcb')->with(['flag'=>'danger','message'=>'Mã số cán bộ quản lý không tồn tại']);
       }
       else{
          $ttcb = canboquanly::where('mscb',$mscb)->first();
          $name = users::where('email',$ttcb->email)->value('name');
          $ttkhu = khuktx::all();
          $tenkhu = khuktx::where('id',$ttcb->id_khu)->value('tenkhu');
          $image = users::where('email',$ttcb->email)->value('image');
          return view('pages.admin_ttcb',['ttcb'=>$ttcb,'tenkhu'=>$tenkhu,'name'=>$name,'ttkhu'=>$ttkhu,'image'=>$image]);
       }
    }

    public function ad_suatt(Request $request,$mscb){
      $checkFile = false;
      if($request->hasFile('userfile'))
      {   
          $file = $request->userfile;
          $file->move(
              'img/img_user',
              $file->getClientOriginalName()
          );
          $checkFile = true;
          $link = "{$file->getClientOriginalName()}";
       }
       $tenkhu = $request->input('tenkhu');
       $sdt = $request->input('phone');
       $nscb = $request->input('birthday');
       $gtcb = $request->input('gtcb');
       $quequan = $request->input('quequan');
       $email = canboquanly::where('mscb',$mscb)->value('email');
       $id_khu = khuktx::where('tenkhu',$tenkhu)->value('id');
       if($checkFile == true){
        users::where('email',$email)->update(['image'=>$link]);
      }
      canboquanly::where('mscb',$mscb)->update(['nscb'=>$nscb,'gtcb'=>$gtcb,'qqcb'=>$quequan,'sdt'=>$sdt,'id_khu'=>$id_khu]);
       $id = users::where('email',$email)->value('id');
       return redirect()->route('ad_xemcb',$id)->with(['flag2'=>'danger','message'=>'Cập nhật thông tin thành công']);;
    }
    public function post_ad_thongke(Request $request){
       $year = $request->input('nam');
       $list_nam = phieudangky::select('nam')->groupBy('nam')->get();
      $id_khu = $request->input('mskhu');
      $max = phong::where('id_khu',$id_khu)->max('id');
      $count = phong::where('id_khu',$id_khu)->count();
      $nam = phong::where([
          ['id_khu',$id_khu],
          ['gioitinh','nam'],
      ])->sum('snmax');
      $nu = phong::where([
          ['id_khu',$id_khu],
          ['gioitinh','nu']
      ])->sum('snmax');
      $nam_dkcur = phong::where([
          ['id_khu',$id_khu],
          ['gioitinh','nam']
      ])->sum('sncur');
      $nu_dkcur = phong::where([
          ['id_khu',$id_khu],
          ['gioitinh','nu']
      ])->sum('sncur');
      $total_student = phieudangky::where([
          ['nam',$year],
          ['trangthaidk','!=','cancelled'],
          ['trangthaidk','!=','registered']
      ])->count();
      $total_money = phieudangky::where([
          ['nam',$year],
          ['trangthaidk','!=','cancelled'],
          ['trangthaidk','!=','registered']
      ])->sum('lephi');
      $list_khu = khuktx::all();
      $khu = khuktx::where('id',$request->input('mskhu'))->value('tenkhu'); 
      return view('pages.admin_thongke',['nam'=>$nam,'nu'=>$nu,'nam_dkcur'=>$nam_dkcur,'nu_dkcur'=>$nu_dkcur,'total_student'=>$total_student,'total_money'=>$total_money,'list_nam'=>$list_nam,'year'=>$year,'list_khu'=>$list_khu,'khu'=>$khu]);
    }
    public function ad_themkhu(Request $request){
      $name = $request->input('name');
      $email = $request->input('email');
      $giaphong = $request->input('price');
      $songuoi = $request->input('number_people');
      $sotang = $request->input('sotang');
      $sophongtang = $request->input('sophongtang');
      $id_khu = khuktx::max('id')+1;
      khuktx::insert(['id'=>$id_khu,'tenkhu'=>$name,'giaphong'=>$giaphong]);
      canboquanly::where('email',$email)->update(['id_khu'=>$id_khu]);
      $id_phong = phong::max('id');
      for ($i=1; $i <= $sotang; $i++) { 
        for ($j=1; $j <= $sophongtang; $j++) { 
          phong::insert([
            'id'=>$id_phong+1,
            'sophong'=>$i*100+$j,
            'id_khu'=>$id_khu,
            'sncur'=>0,
            'snmax'=>$songuoi,
            'gioitinh'=>'nam'
          ]);
          $id_phong++;
        }
      }
      return redirect()->back()->with(['flag'=>'danger','message'=>'Tạo khu kí túc xá mới thành cồng']);
    }
    public function ad_updatetrangthai($trangthai,$id){
      khuktx::where('id',$id)->update(['trangthai'=>$trangthai]);
      return redirect()->back();
    }
    public function ad_updatettphong($trangthai,$id){
      phong::where('id',$id)->update(['trangthai'=>$trangthai]);
      return redirect()->back();
    }
    public function ad_updatekhu($id,Request $request){
      $giaphong = $request->input('giaphong');
      $sotang = $request->input('tang');
      $songuoi = $request->input('songuoi');
      $phongmax = phong::max('sophong');
      $sophongtang = $phongmax%100;
      $sotangcur = ($phongmax-$sophongtang)/100;
      $id_phong = phong::max('id');
      $giaphong = str_replace(',','',$giaphong);
      for ($i=$sotangcur+1; $i <= $sotang+$sotangcur; $i++) { 
        for ($j=1; $j <= $sophongtang; $j++) { 
          phong::insert([
            'id'=>$id_phong+1,
            'sophong'=>$i*100+$j,
            'id_khu'=>$id,
            'sncur'=>0,
            'snmax'=>$songuoi,
            'gioitinh'=>'nam'
          ]);
          $id_phong++;
        }
      }
      khuktx::where('id',$id)->update(['giaphong'=>$giaphong]);
      return redirect()->back()->with(['flag'=>'danger','message'=>'Cập nhật thông tin thành công']);
    }
    public function post_ad_suaphong($id,Request $request){
      phong::where('id',$id)->update(['snmax'=>$request->input('snmax'),'gioitinh'=>$request->input('gioitinh')]);
      return redirect()->back()->with(['flag'=>'danger','message'=>'Chỉnh sửa thông tin thành cồng']);
    }
}


?>