<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

function permalink($link)
{
$strip = array(' ');
$elim = array('.', ',', '-', '?', '!', '"', '@', '/', ':', '_', ';', '+', '&', '%', '*', '=', '<', '>', '[', ']', '{', '}', '#', ')', '(');
$elim2 = array("'");
$link = str_replace($elim, '', $link);
$link = str_replace($elim2, '', $link);
$link = str_replace($strip, '-', $link);
$link = strtolower($link);
return $link;
}
?>
