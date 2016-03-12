<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>'.$fs_title.' | '.$name.'</title>

<link rel="stylesheet" type="text/css" href="'.$url.'/files/'.$css_file.'" media="all,handheld" />
';

$meta_sql = mysql_query("SELECT * FROM meta ORDER BY idmeta ASC");
while ($meta = mysql_fetch_array($meta_sql))
{
echo '
<meta name="'.$meta['name'].'" content="'.$meta['content'].'" />
';
}

if (isset($_GET['fs']))
{
if($_GET['fs'] == 'post' || $_GET['fs'] == 'page')
{
$desc = $desc_content;
$h1 = 'div';
$h2 = 'div';
}
else
{
$desc = $description;
$h1 = 'h1';
$h2 = 'h2';
}
}
else
{
$desc = $description;
$h1 = 'h1';
$h2 = 'h2';
}

echo '
<meta name="description" content="'.$desc.'" />

<meta name="keywords" content="'.$keywords.'" />

</head>

<body>

<div id="fs-header">

<'.$h1.' class="fs-heading"><a href="'.$url.'">'.$name.'</a></'.$h1.'>

<'.$h2.' class="fs-description">'.$description.'</'.$h2.'>

</div>

<div id="fs-page">

<span><a href="'.$url.'">Beranda</a></span>
';
$page_sql = mysql_query("SELECT * FROM page WHERE pos = 'top' and status = '1'");
while($page = mysql_fetch_array($page_sql))
{
echo '
<span><a href="'.$url.'/page/'.$page['permalink'].'">'.$page['title'].'</a></span>
';
}
echo '
</div>
';
?>
