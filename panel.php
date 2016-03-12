<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

include ('fajarsodik.php');

if(isset($_SESSION['iduser']))
{
$fs = isset($_GET['fs']) ? trim($_GET['fs']) :'';
switch($fs)
{
default:
include ('./panel/index.php');
break;

case 'logout':
session_destroy();
header ('Location: '.$url.'/panel.php');
break;

case 'post':
include ('./panel/post.php');
break;

case 'page':
include ('./panel/page.php');
break;

case 'category':
include ('./panel/category.php');
break;

case 'blogroll':
include ('./panel/blogroll.php');
break;

case 'navigation':
include ('./panel/navigation.php');
break;

case 'profile':
include ('./panel/profile.php');
break;

case 'theme':
include ('./panel/theme.php');
break;
}
}
else
{
if(isset($_POST['login']))
{
$log = $_POST['log'];
$pw = md5($_POST['password']);
$user = mysql_num_rows(mysql_query("SELECT * FROM user WHERE email = '$log' OR username = '$log'"));
if($user = 0)
{
$not = '<li class="fs-err">Email atau Nama Pengguna tidak ada</li>';
}
else
{
$match = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE username = '$log' OR email = '$log'"));
$pw2 = md5( $match['password']);
if($pw == $pw2)
{
$_SESSION['iduser'] = $match['iduser'];
$_SESSION['username'] = $match['username'];
$_SESSION['type'] = $match['type'];
header ('Location: '.$url.'/panel.php');
}
else
{
$not = '<li class="fs-err">Kata Sandi tidak cocok dengan Email atau Nama Pengguna</li>';
}
}
}
else
{
$not ='';
}
$fs_title = 'Masuk';
include ('panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
'.$not.'
<form action="'.$url.'/panel.php" method="POST">
<h4>Email atau Nama Pengguna</h4>
<input type="text" name="log" class="fs-text">
<h4>Kata Sandi</h4>
<input type="password" name="password" class="fs-text">
<div class="fs-sub"><input type="submit" name="login" value="Masuk" class="fs-btn"></div>
</form>
</div>
</div>
';

include ('./panel/footer.php');
}
