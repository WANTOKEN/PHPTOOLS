<?php

$url = '';
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