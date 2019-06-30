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

Route::get('/', function () {
    return view('welcome');
});


Route::get('trangchu','PageController@trangchu')->name('trangchu');
	Route::get('student_dkphong','PageController@student_dkphong')->name('student_dkphong');
	Route::get('student_xemdk','PageController@student_xemdk')->name('student_xemdk');
	Route::get('student_bancp','PageController@student_bancp')->name('student_bancp');
	Route::get('student_ttcn','PageController@student_ttcn')->name('student_ttcn');
	Route::get('student_cbql','PageController@student_cbql')->name('student_cbql');
	Route::get('student_doimk','PageController@student_doimk')->name('student_doimk');

	Route::get('logout','LoginController@logout')->name('logout');
	Route::get('login','LoginController@getLogin');

	Route::post('login','LoginController@postLogin');

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
	DB::table('users')->update(['password' => bcrypt('12345678')]);
});
Route::get('get_student_dkphong/{id}','LoadController@get_student_dkphong')->name('get_student_dkphong');

Route::get('student_chonphong/{id}','PageController@student_chonphong')->name('student_chonphong');
?>