<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$fs_host = 'fsb.me'; //Host SQL
$fs_user = 'root'; //User SQL
$fs_pass = ''; //Sandi SQL
$fs_db = 'fsb'; //Nama Database

mysql_connect($fs_host, $fs_user, $fs_pass) or die('FS: Tidak dapat menghubungkan database, periksa file fajarsodik.php');
mysql_select_db($fs_db) or die('FS: Tidak dapat memilih database, periksa file fajarsodik.php');

$detect = new mobile_detect();
if($detect->isMobile())
{
$css_file = "style.css";
}
else
{
$css_file = "desktop.css";
}
$url = "http://fsb.me"; //URL
$name = "FSBlog"; //Nama Blog
$description = "FSodic Blog Official"; //Deskripsi Blog
$keywords = "FSB, My FSB, Fajar, Sodik"; //Kata Kunci Blog
$limit_post = "10"; //Posting Tiap Halaman
$gmtime = '8'; //Zona Waktu
