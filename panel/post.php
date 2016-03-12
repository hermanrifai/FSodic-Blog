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
if($_POST['save'])
{
$title = $_POST['title'];
$content = $_POST['content'];
$category = $_POST['category'];
$thumb = $_POST['thumbnail'];
$status = $_POST['status'];
if($thumb == 'http://' || $thumb == '')
{
$thumbnail = ''.$url.'/files/no.png';
}
else 
{
$thumbnail = $thumb;
}
mysql_query("UPDATE post SET title = '".mysql_real_escape_string($title)."', content = '".mysql_real_escape_string($content)."', category = '$category', thumbnail = '".mysql_real_escape_string($thumbnail)."', status = '$status' WHERE idpost = '$id'");
header ('Location: '.$url.'/panel.php?fs=post');
}
$post = mysql_fetch_array(mysql_query("SELECT * FROM post WHERE idpost = '$id'"));
$fs_title = 'Kelola Post';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
<form action="'.$url.'/panel.php?fs=post&amp;act=manage&amp;id='.$id.'" method="POST">
<h4>Judul</h4>
<input type="text" name="title" class="fs-text" value="'.$post['title'].'">
<h4>Konten</h4>
<textarea name="content" class="fs-text" rows="50">'.$post['content'].'</textarea>
<div class="fs-war">HTML on</div>
<h4>Kategori</h4>
<select name="category" class="fs-select">
<option value="'.$post['category'].'">Tak Diubah</option>';
$cat_sql = mysql_query("SELECT * FROM category ORDER BY cshow DESC, cname ASC");
while ($cat = mysql_fetch_array($cat_sql))
{
echo '<option value="'.$cat['idcategory'].'">'.$cat['cname'].'</option>
';
}
echo '
</select>
<h4>Thumbnail</h4>
<input type="text" name="thumbnail" value="'.$post['thumbnail'].'" class="fs-text">
<h4>Status</h4>
<select name="status" class="fs-select">
<option value="'.$post['status'].'">Tak Diubah</option>
<option value="1">Terbitkan</option>
<option value="0">Simpan</option>
</select>
<div class="fs-sub"><input type="submit" name="save" value="Simpan" class="fs-btn"></div>
</form>
</div>
</div>';
break;

case 'add':
if(isset($_POST['add']))
{
$title = $_POST['title'];
$content = $_POST['content'];
$permalink = permalink($title);
$time = time();
$category = $_POST['category'];
$thumb = $_POST['thumbnail'];
$status = $_POST['status'];
if($thumb == 'http://' ||$thumb == '')
{
$thumbnail = ''.$url.'/files/no.png';
}
else 
{
$thumbnail = $thumb;
}
if($title == '' || $content == '')
{
$not = '<li class="fs-err">Isi atau Judul Kosong</li>';
}
else
{
mysql_query("INSERT INTO post(title, content, category, user, thumbnail, time, permalink, status) VALUES('".mysql_real_escape_string($title)."', '".mysql_real_escape_string($content)."', '$category', '1', '".mysql_real_escape_string($thumbnail)."', '$time', '$permalink', '$status')");
header ('Location: '.$url.'/panel.php?fs=post&not=successed_post');
}
}
else
{
$not = '';
$content = '';
$title = '';
}
$fs_title = 'Tambah Post';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
<form action="'.$url.'/panel.php?fs=post&amp;act=add" method="POST">
<h4>Judul</h4>
<input type="text" name="title" class="fs-text">
<div class="fs-war">Jangan Gunakan tanda kurung "()"</div>
<h4>Konten</h4>
<textarea name="content" class="fs-text" rows="40">'.trim(stripslashes($content)).'</textarea>
<div class="fs-war">HTML on</div>
<h4>Kategori</h4>
<select name="category" class="fs-select">
';
$cat_sql = mysql_query("SELECT * FROM category ORDER BY cshow DESC, cname ASC");
while ($cat = mysql_fetch_array($cat_sql))
{
echo '<option value="'.$cat['idcategory'].'">'.$cat['cname'].'</option>';
}
echo '
</select>
<h4>Thumbnail</h4>
<input type="text" name="thumbnail" value="http://" class="fs-text">
<h4>Status</h4>
<select name="status" class="fs-select">
<option value="1">Terbitkan</option>
<option value="0">Disimpan</option>
</select>
<div class="fs-sub"><input type="submit" name="add" value="Tambah" class="fs-btn"></div>
</form>
</div>
</div>
';
break;

default:
$fs_title = 'Post';
include ('./panel/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
';
$post_sql = mysql_query("SELECT * FROM post ORDER BY time DESC");
while($post = mysql_fetch_array($post_sql))
{
if($post['status'] == '1') {
$stat = 'Diterbitkan';
}
else {
$stat = 'Disimpan';
}
echo '
<li>
<h4>'.$post['title'].' ('.$stat.')</h4>
<div>Tanggal: '.gmdate('d M Y H:i', $post['time']+60*60*$gmtime).'</div>
<div class="fs-act"><a href="'.$url.'/panel.php?fs=post&amp;act=manage&amp;id='.$post['idpost'].'">Kelola</a> <a href="'.$url.'/panel.php?fs=post&amp;act=del&amp;id='.$post['idpost'].'">Hapus</a></div>
</li>
';
}
echo '
<li><a href="'.$url.'/panel.php?fs=post&amp;act=add">Tambah Baru</a></li>
</div>
</div>
';
break;

case 'del':
$id = $_GET['id'];
mysql_query("DELETE FROM post WHERE idpost = '$id'");
header('Location: '.$url.'/panel.php?fs=post');
break;
}
include ('./panel/footer.php');
