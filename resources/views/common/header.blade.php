<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>掲示板</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ここにサイト説明を入れます">
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５">
<link rel="icon" type="image/png" sizes="16x16"  href="../../../public/images/favicon-16x16.png">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/style.css">


<script src="js/openclose.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<style>
.menu1 a {background-position: -10px -10px;}
.menu2 a {background-position: -10px -130px;}
.menu3 a {background-position: -10px -250px;}
.menu4 a {background-position: -10px -370px;}
.menu5 a {background-position: -10px -490px;}
</style>
<![endif]-->
<!--[if lt IE 10]>
<style>
.slide0,.slide1,.slide2,.slide3 {background: url(images/1.jpg) no-repeat center center;}
</style>
<![endif]-->
</head>

<body class="contact">
    
        <header class="pc">
        <h1 class="logo">
            <input class="design_none" type="image" name="btn_confirm" src="images/logo.png"  alt="ホームへ" value="ホームへ" formmethod="get" formaction="{{ url('/home') }}" form="home_form" width="180">
            </h1>

            <!--PC用（801px以上端末）メニュー-->
            <nav id="menubar">
                <ul>
                <li class="menuimg menu1"><a href="{{ url('/chat') }}" class="design_menu design_none"><span class="menu_span">ChatRoom</span></a></li>
		            <li class="menuimg menu2"><a href="{{ url('/post') }}" class="design_menu design_none"><span class="menu_span">NewPost</span></a></li>
		            <li class="menuimg menu3"><a href="{{ url('/show') }}" class="design_menu design_none"><span class="menu_span">MyChat</span></a></li>
		            <li class="menuimg menu4"><a href="{{ url('/userList') }}" class="design_menu design_none"><span class="menu_span">Account</span></a></li>
                </ul>
            </nav>
            <li class='logout'><a href="{{ url('/logout') }}">logout</a></li>
        </header>
        <!--/.pc-->

        <!--小さな端末用（800px以下端末）で表示させるブロック-->
        <header class="sh">

            <h1 class="logo">
                <input class="design_none" type="image" name="btn_confirm" src="images/logo.png"  alt="ホームへ" value="ホームへ" formmethod="get" formaction="{{ url('/home') }}" form="home_form" width="180">
            </h1>

            <!--小さな端末用（800px以下端末）メニュー-->
            <div id="menubar-s">
                <nav>
                    <input type="submit" value="logout" class='logout' formaction="{{ url('logout') }}" formmethod="post">
                </nav>
            </div>
            <!--/#menubar-s-->
        </header>
        <!--/.sh-->
    
</body>
