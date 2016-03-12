<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$no = $_GET['no'];
$id = $_GET['id'];
$start_post = $limit_post * ($no-1);

$cat_check = mysql_num_rows(mysql_query("SELECT * FROM category WHERE clink = '$id'"));
if($cat_check == 0)
{
$fs_title = 'Kategori Tidak Ada';
include ('./tema/header.php');
}
else
{
$post_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM category, post WHERE status = '1' AND idcategory = category AND category.clink = '$id'"));
$total_post = $post_count[0];

$cat = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE clink = '$id'"));
$fs_title = 'Kategori '.$cat['cname'].' : '.$no.'';

include ('./tema/header.php');

echo '
<div id="fs-content">
';

$post_sql = mysql_query("SELECT * FROM post, user, category WHERE status = '1' AND idcategory = category AND iduser = user AND clink = '$id' ORDER BY time DESC LIMIT $start_post, $limit_post");
while ($post = mysql_fetch_array($post_sql))
{
echo '
<div class="fs-post">

<div class="fs-post-head">

<h2 class="fs-title"><a href="'.$url.'/'.$post['permalink'].'">'.$post['title'].'</a></h2>

<div class="fs-post-date">by '.$post['fullname'].' on '.date('d M Y H:i', $post['time']+60*60*$gmtime).'</div>

</div>

<div class="fs-post-content"><img src="'.$post['thumbnail'].'" style="float:left; margin:2px; padding:2px; border:2px solid #000; width:40px; height:50px"> '.substr(strip_tags($post['content']),0,150).'...</div>

<div class="fs-post-foot" style="clear:both;">

<div class="fs-post-read">Pembaca: '.$post['total'].'</div>

</div>

</div>
';
}
$banyak_halaman = ceil($total_post / $limit_post);
if($banyak_halaman > 1)
{
echo '
<div id="fs-pagination">
';
for ($i = 1; $i <= $banyak_halaman; $i++)
{
if($no !=$i)
{
echo '
<a href="'.$url.'/category/'.$cat['clink'].'/'.$i.'">'.$i.'</a>
';
}
else
{
echo '
<span>'.$i.'</span>
';
}
}
echo '
</div>
';
}
echo '
</div>
';
}
include ('./tema/footer.php');
