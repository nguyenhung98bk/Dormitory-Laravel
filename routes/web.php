<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('trangchu','PageController@trangchu')->name('trangchu');


#----------Sinh viên-------------- 

Route::get('student_dkphong','PageController@student_dkphong')->name('student_dkphong');
Route::get('student_xemdk','PageController@student_xemdk')->name('student_xemdk');
Route::get('student_bancp','PageController@student_bancp')->name('student_bancp');
Route::get('student_ttcn','PageController@student_ttcn')->name('student_ttcn');
Route::get('student_cbql','PageController@student_cbql')->name('student_cbql');
Route::get('student_doimk','PageController@student_doimk')->name('student_doimk');
Route::get('get_student_dkphong/{id}','LoadController@get_student_dkphong')->name('get_student_dkphong');
Route::get('student_chonphong/{id}','PageController@student_chonphong')->name('student_chonphong');
Route::get('student_chinhsua','LoadController@getStudent_chinhsua')->name('student_chinhsua');
Route::post('student_chinhsua','LoadController@postStudent_chinhsua')->name('student_chinhsua');
Route::post('student_suatt','LoadController@student_suatt')->name('student_suatt');

#-----------------------------------

#----------Auth---------------------

Route::get('logout','LoginController@logout')->name('logout');
Route::get('login','LoginController@getLogin')->name('login');
Route::post('login','LoginController@postLogin');
Route::post('register','LoginController@register');
Route::post('changePassword','LoadController@changePassword');
Route::get('','HomeController@getIndex');
Route::get('SignUp',[
	'as'=>'SignUp',function(){
		return view('pages.SignUp');
}]);

Route::get('Forgot',[
	'as'=>'Forgot',function(){
		return view('pages.Forgot');
}]);

Route::get('mahoa',function(){
	DB::table('users')->update(['password' => bcrypt('123456')]);
});

#--------------------------------------

#-------------Quản lý------------------

Route::get('ql_phong','PageController@ql_phong')->name('ql_phong');
Route::get('ql_duyetdk','PageController@ql_duyetdk')->name('ql_duyetdk');
Route::get('ql_ttsv','PageController@ql_ttsv')->name('ql_ttsv');
Route::get('ql_cpsv','PageController@ql_cpsv')->name('ql_cpsv');
Route::get('ql_thongke','PageController@ql_thongke')->name('ql_thongke');
Route::get('ql_ttphong/{id}','LoadController@ql_ttphong')->name('ql_ttphong');
Route::get('get_ql_duyetdk/{mssv}','LoadController@get_ql_duyetdk')->name('get_ql_duyetdk');
Route::get('get_ql_huydk/{mssv}','LoadController@get_ql_huydk')->name('get_ql_huydk');
Route::get('get_ql_ttsv/{mssv}','LoadController@get_ql_ttsv')->name('get_ql_ttsv');
Route::get('get_ql_xoasv/{mssv}','LoadController@get_ql_xoasv')->name('get_ql_xoasv');
Route::post('post_ql_ttsv','LoadController@post_ql_ttsv')->name('post_ql_ttsv');
Route::post('post_ql_thongke','LoadController@post_ql_thongke')->name('post_ql_thongke');


?>