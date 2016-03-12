<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

include ('./fajarsodik.php');

$fs = isset($_GET['fs']) ? trim($_GET['fs']) :'';
switch ($fs)
{
default:
include  
('./tema/index.php');
break;

case 'post':
include ('./tema/post.php');
break;

case 'page':
include ('./tema/page.php');
break;

case 'category':
include ('./tema/category.php');
break;

case '404':
include ('./tema/404.php');
break;
}
?>
