<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/


$id = $_GET['id'];
$post_check = mysql_num_rows(mysql_query("SELECT * FROM page WHERE permalink = '$id' AND status = '1'"));
if($post_check == 0)
{
$fs_title = 'Halaman Tidak Ada';
include ('./tema/header.php');
echo '
<div id="fs-content">

<div class="fs-post 404">

<div class=fs-post-head">

<h1 class="fs-title">'.$fs_title.'</h1>

<div class="fs-post-content"><p>Maaf, Halaman yang anda minta tidak ada atau mungkin telah di hapus. Hubungi kami di <a href="'.$url.'/page/tentang">sini</a> atau kembali ke <a href="'.$url.'">Beranda</a>.</p></div>

</div>

</div>
';
}
else
{
$post = mysql_fetch_array(mysql_query("SELECT * FROM page WHERE permalink = '$id' AND status = '1'"));
$desc_content = trim(substr(strip_tags($post['content']),0,150));

$fs_title = $post['title'];
include ('./tema/header.php');
echo '
<div id="fs-content">

<div class="fs-post single">

<div class="fs-post-head">

<h1 class="fs-title">'.$post['title'].'</h1>

</div>

<div class="fs-post-content">'.trim(stripslashes($post['content'])).'</div>

<div class="fs-post-foot">

<div class="fs-share">Bagikan: <a href="http://www.facebook.com/sharer.php?u='.$url.'/page/'.$post['permalink'].'">Facebook</a> <a href="http://www.twitter.com/home?status='.$url.'/page/'.$post['permalink'].'">Twitter</a></div>

</div>

</div>

</div>
';
}
include ('./tema/footer.php');
