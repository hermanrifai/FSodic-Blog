<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$act = isset($_GET['act']) ? trim($_GET['act']) :'';
switch ($act)
{
case 'manage':
$id = $_GET['id'];
if(isset($_POST['save']))
{
$bname = trim(strip_tags($_POST['name']));
$burl = trim(strip_tags($_POST['url']));
$att = $_POST['att'];
mysql_query("UPDATE blogroll SET name = '$bname', url = '$burl', follow = '$att' WHERE idblogroll = '$id'");
$not = '<li class="fs-suc">Berhasil di sunting</li>';
}
$br = mysql_fetch_array(mysql_query("SELECT * FROM blogroll WHERE idblogroll = '$id' AND idblogroll != '1'"));
$fs_title = 'Kelola Blogroll';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
<form action="'.$url.'/panel.php?fs=blogroll&amp;act=manage&amp;id='.$id.'" method="POST">
<h4>Nama</h4>
<input type="text" name="name" value="'.$br['name'].'" class="fs-text">
<h4>URL</h4>
<input type="text" name="url" value="'.$br['url'].'">
<h4>Atribut</h4>
<select name="att" class="fs-select">
<option value="'.$br['follow'].'">Tak Diubah</option>
<option value="dofollow">Dofollow</option>
<option value="nofollow">Nofollow</option>
</select>
<div class="fs"><input type="submit" name="save" value="Simpan" class="fs-btn"></div>
</form>
</div>
</div>
';
break;

case 'add':
if(isset($_POST['save']))
{
$bname = trim(strip_tags($_POST['name']));
$burl = trim(strip_tags($_POST['url']));
$att = $_POST['att'];
mysql_query("INSERT INTO blogroll(name, url, follow) VALUES('$bname', '$burl', '$att')");
$not = '<li class="fs-suc">Berhasil ditambahkan</li>';
}
else
{
$not = '';
}
$fs_title = 'Tambah Blogroll';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
<form action="'.$url.'/panel.php?fs=blogroll&amp;act=add" method="POST">
<h4>Nama</h4>
<input type="text" name="name" class="fs-text">
<h4>URL</h4>
<input type="text" name="url" class="fs-text" value="http://">
<h4>Atribut</h4>
<select name="att" class="fs-select">
<option value="dofollow">Dofollow</option>
<option value="nofollow">Nofollow</option>
</select>
<div class="fs-sub"><input type="submit" name="save" value="Tambah" class="fs-btn"></div>
</form>
</div>
</div>
';
break;

default:
$fs_title = 'Blogroll';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h3>
<div class="fs-main">
';
$br_sql = mysql_query("SELECT * FROM blogroll WHERE status = '1' ORDER BY idblogroll ASC");
while ($br = mysql_fetch_array($br_sql))
{
echo '
<li>
<h4>'.$br['name'].' ('.$br['url'].')</h4>
<div class="fs-act"><a href="'.$url.'/panel.php?fs=blogroll&amp;act=manage&amp;id='.$br['idblogroll'].'">Kelola</a> <a href='.$url.'/panel.php?fs=blogroll&amp;act=del&amp;id='.$br['idblogroll'].'">Hapus</a></div>
</li>
';
}
echo '
</div>
</div>
';
break;

case 'del':
$id = $_GET['id'];
mysql_query("DELETE FROM blogroll WHERE idblogroll = '$id' AND idblogroll != '1'");
header ('Location: '.$url.'/panel.php?fs=blogroll');
break;
}
include ('./panel/footer.php');
