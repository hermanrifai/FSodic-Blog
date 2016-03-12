<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$id = $_GET['id'];

$post_check = mysql_num_rows(mysql_query("SELECT * FROM post WHERE permalink = '$id'"));
if($post_check == 0)
{
$fs_title = 'Post Tidak Ada';
include ('./tema/header.php');
echo '
<div id="fs-content">

<div class="fs-post 404">

<div class="fs-post-head">

<h1 class="fs-title">'.$fs_title.'</h1>

</div>

<div class="fs- 
post-content"><p>Maaf, Posting yang anda minta tidak ada atau mungkin telah di hapus. Silahkan hubungi kami di <a href="'.$url.'/page/tentang">sini</a> atau kembali ke <a  
href="'.$url.'">Beranda</a>.</p></div>

</div>

</div>
';
include('./tema/footer.php');
}
else
{
$post = mysql_fetch_array(mysql_query("SELECT * FROM post, category, user  
WHERE iduser = user AND permalink = '$id' AND status = '1' AND category.idcategory = post.category"));
$desc_content = trim(substr(strip_tags($post['content']),0,150));

$fs_title = $post['title'];
include ('./tema/header.php');
echo '
<div  
id="fs-content">

<div class="fs-post single">

<div class="fs-post-head">

<h1 class="fs-title">'.$post['title'].'</h1>

<h2 class="fs-post-category">Kategori: <a href="'. 
$url.'/category/'.$post['clink'].'/1">'.$post['cname'].'</a></h2>

<div class="fs-post-date">by '.$post['fullname'].' on '.date('d M Y H:i', $post['time']+60*60* 
$gmtime).'</div>

</div>

<div class="fs-post-content">'.trim(stripslashes($post['content'])).'</div>

<div class="fs-post-foot">

<div class="fs-post-writer">Penulis: '.$post 
['fullname'].'</div>

<div class="fs-post-read">Dibaca: '.$post['total'].'</div>

<div class="fs-share">Bagikan: <a href="http://www.facebook.com/sharer.php?u='.$url.'/'. 
$post['permalink'].'">Facebook</a> <a href="http://www.twitter.com/home?status='.$url.'/'.$post['permalink'].'">Twitter</a></div>

</div>

</div>

</div>
';

include  
('./tema/footer.php');

$add = ceil($post['total']+1);
mysql_query("UPDATE post SET total = '$add' WHERE permalink = '$id'");
}
?>
