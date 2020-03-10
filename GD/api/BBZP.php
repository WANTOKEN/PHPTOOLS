<?php

$url = 'http://v4.dwstatic.com/biu/201807/05/0a4400e748ed3d5b3547b224b3240000.png?w=870&h=1000';
//try{
//
//}catch (){
//
//}
$uim = imagecreatefromjpeg($data->name);
if(!$uim){
    $uim = imagecreatefrompng($data->name);
}
list($w, $h) = getimagesize($data->name);
list($width, $height) = getimagesize($url);
$height = $height-136;
$im = imagecreatetruecolor($width, $height);
$cover = imagecreatefrompng($url);
imagecopyresized($im, $uim, 0, 0, 0, 0, $width, $height, $w, $h);
imagecopyresized($im, $uim, 180, 165, 0, 0, 550, 550, $w, $h);
imagecopyresampled($im, $cover, 0, 0, 0, 0, $width, $height, $width, $height);