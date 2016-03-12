<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

echo '
<div id="fs-sidebar">

<div class="fs-navigation">

<h3>Navigasi</h3>
';
$navigation_sql = mysql_query("SELECT * FROM navigation ORDER BY idnavigation");
while ($nav = mysql_fetch_array($navigation_sql))
{
echo '
<li>'.$nav['html'].'</li>
';
}
echo '
</div>

<div class="fs-category">

<h3>Kategori</h3>
';
$category_sql = mysql_query("SELECT * FROM category ORDER BY cshow DESC, cname ASC");
while ($cat = mysql_fetch_array($category_sql))
{
echo '
<li><a href="'.$url.'/category/'.$cat['clink'].'/1">'.$cat['cname'].'</a></li>
';
}
echo '
</div>

<div class="fs-blogroll">

<h3>Blogroll</h3>
';
$br_sql = mysql_query("SELECT * FROM blogroll ORDER BY name ASC");
while($br = mysql_fetch_array($br_sql))
{
echo '
<li><a href="'.$br['url'].'" rel="'.$br['follow'].'">'.$br['name'].'</a></li>
';
}
echo '
</div>

</div>

<div id="fs-footer">

<div class="fs-footing">Copyright &copy; '.gmdate('Y', time() +60*60*$gmtime).' <a href="'.$url.'">'.$name.'</a><br />FSB By <a href="http://www.fsodic.com">Fajar Sodik</a></div>

<div id="fs-page-btm">
';
$page_sql = mysql_query("SELECT * FROM page WHERE pos = 'btm' and status = '1'");
while($page = mysql_fetch_array($page_sql))
{
echo '
<span><a href="'.$url.'/page/'.$page['permalink'].'">'.$page['title'].'</a></span>
';
}

echo '
</div>

</div>

</body>

</html>';
