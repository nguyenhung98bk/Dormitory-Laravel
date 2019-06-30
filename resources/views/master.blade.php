<!DOCTYPE html>
<html class="no-js" lang="">
   	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="x-ua-compatible" content="ie=edge">
    	<title>Webktx.bk</title>
    	<meta name="description" content="">
     	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/unnamed.jpg">	
		<link rel="stylesheet" href="{{asset('css/master.css')}}">
        <script src="https://lichngaytot.com/Scripts/jquery-1.11.0.min.js"></script><script src="https://lichngaytot.com/Scripts/jquery-ui.min.js"></script>
        <script src="https://lichngaytot.com/Scripts/widgetlichthang.js"></script>
    </head>
    <body>
    	<div class="page-container">
    		<div class="header-container">
    		<header class="logo">
    			<div class="logo"><img src="img/logo.png"></div>
    		</header>

    		<div class="menu_bar">
                @if(Auth::check())
    				@if(Auth::user()->ltk=="sinhvien")
    					@include('Student_main_menu')
    				@elseif(Auth::user()->ltk=="quanly")
    					@include('Quanly_main_menu')
    				@else
    					@include('Admin_main_menu')
    				@endif
                @endif
    		</div>
    	</div>
    		<content class="main-container">
    			<div class="main-header">
    				<div class="title">
            			<h1>Ký túc xá Đại học Bách khoa Hà Nội</h1>
            			<div class="name">
                            @if(Auth::check())
                			    Xin chào bạn : {{Auth::user()->name}}
                            @else {{"Bạn chưa đăng nhập"}}
                            @endif
                            <a href="{{route('logout')}}">[ Đăng xuất ]</a>
    					</div>
    				</div>
    			</div>
                <div class="main-content">
    			     @yield('content')
                </div>
    		</content>
    	</div>
    </body>