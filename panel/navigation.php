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
$html = $_POST['html'];
mysql_query("UPDATE navigation SET html = '".mysql_real_escape_string($html)."' WHERE idnavigation = '$id'");
$not = '<li class="fs-suc">Berhasil di simpan</li>';
}
else
{
$not = '';
}
$nav = mysql_fetch_array(mysql_query("SELECT * FROM navigation WHERE idnavigation = '$id'"));
$fs_title = 'Kelola Navigasi';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
<form action="'.$url.'/panel.php?fs=navigation&amp;act=manage&id='.$id.'" method="POST">
<h4>Menu Navigasi</h4>
<textarea name="html" class="fs-text">'.$nav['html'].'</textarea>
<div class="fs-sub"><input type="submit" value="Simpan" name="save" class="fs-btn"></div>
</form>
</div>
</div>
';
break;

case 'del':
$id = $_GET['id'];
mysql_query("DELETE FROM navigation WHERE idnavigation = '$id'");
header ('Location: '.$url.'/panel.php?fs=navigation');
break;

default:
if(isset($_POST['add']))
{
$html = $_POST['html'];
mysql_query("INSERT INTO navigation(html) VALUES('".mysql_real_escape_string($html)."')");
$not = '<li class="fs-suc">Navigasi di tambahkan</li>';
}
else
{
$not ='';
}
$fs_title = 'Navigasi';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
';
$nav_sql = mysql_query("SELECT * FROM navigation ORDER BY idnavigation ASC");
while($nav = mysql_fetch_array($nav_sql))
{
echo '
<li>'.trim(stripslashes($nav['html'])).'
<div class="fs-act"><a href="'.$url.'/panel.php?fs=navigation&amp;act=manage&amp;id='.$nav['idnavigation'].'">Kelola</a> <a href="'.$url.'/panel.php?fs=navigation&amp;act=del&amp;id='.$nav['idnavigation'].'">Hapus</a></div>
</li>
';
}
echo '
<form action="'.$url.'/panel.php?fs=navigation" method="POST">
<h4>Navigasi Baru</h4>
<textarea name="html" class="fs-text"></textarea>
<div class="fs-sub"><input type="submit" name="add" value="Tambah" class="fs-btn"></div>
</form>
</div>
</div>
';
break;
}
include ('./panel/footer.php');
