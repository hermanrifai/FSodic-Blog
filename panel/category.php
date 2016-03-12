<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$act = isset($_GET['act']) ? trim($_GET['act']) :'';
switch($act)
{
case 'manage':
$id = $_GET['id'];
if(isset($_POST['save']))
{
$cname = trim(strip_tags($_POST['name']));
$clink = permalink($cname);
mysql_query("UPDATE category SET cname = '$cname', clink = '$clink' WHERE idcategory = '$id'");
$not = '<li class="fs-suc">Berhasil di ubah</li>';
}
else
{
$not = '';
}
$cat = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE idcategory = '$id'"));
$fs_title = 'Kelola Kategori';
include ('./panel/header.php');
echo '<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
<form action="'.$url.'/panel.php?fs=category&amp;act=manage&amp;id='.$id.'" method="POST">
<h4>Nama</h4>
<input type="text" name="name" value="'.$cat['cname'].'" class="fs-text">
<div class="fs-sub"><input type="submit" name="save" value="Simpan" class="fs-btn"></div>
</form>
</div>
</div>
';
break;

case 'del':
$id = $_GET['id'];
mysql_query("DELETE FROM category WHERE idcategory = '$id' AND idcategory != '1'");
mysql_query("UPDATE post SET category = '1' WHERE category = '$id'");
header ('Location: '.$url.'/panel.php?fs=category');
break;

default:
if(isset($_POST['add']))
{
$cname = trim(strip_tags($_POST['name']));
$clink = permalink($cname);
mysql_query("INSERT INTO category(cname, clink, cshow) VALUES('$cname', '$clink', '1')");
$not = '<li class="fs-suc">Berhasil ditambah</li>';
}
else
{
$not ='';
}
$fs_title = 'Kategori';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
';
$cat_sql = mysql_query("SELECT * FROM category ORDER BY cshow DESC, cname ASC");
while ($cat = mysql_fetch_array($cat_sql))
{
if($cat['idcategory'] == '1')
{
$del_cat = '';
}
else
{
$del_cat = '<a href="'.$url.'/panel.php?fs=category&amp;act=del&amp;id='.$cat['idcategory'].'">Hapus</a>';
}
echo '
<li><h4>'.$cat['cname'].'</h4>
<div class="fs-act"><a href="'.$url.'/panel.php?fs=category&amp;act=manage&amp;id='.$cat['idcategory'].'">Kelola</a> '.$del_cat.'</div>
</li>';
}
echo '
<form action="'.$url.'/panel.php?fs=category" method="POST">
<h4>Nama</h4>
<input type="text" name="name" class="fs-text">
<div class="fs-sub"><input type="submit" name="add" value="Tambah" class="fs-btn"></div>
</form>
</div></div>
';
}
include ('./panel/footer.php');
