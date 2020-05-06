<?php
// create new imagick object from image.jpg
$localPath = 'D:\wamp64\www\ztk\PHPTOOLS\Imagick\\';
$save_path = $localPath;
$erm = $localPath.'EWM.png';
$img1 = new Imagick($erm);
$savefile1 = $localPath."a.jpg";
//$img2 = new Imagick($savefile1);
//$img1->compositeImage($img2, Imagick::COMPOSITE_COPYOPACITY, 0, 0, Imagick::CHANNEL_ALPHA);

$savename ="final.jpg";
$output = $save_path.$savename;
$img1->writeImage($output);

// change format to png
//$im2->setImageFormat( "png" );

// output the image to the browser as a png
header( "Content-Type: image/png" );
echo $im2;

// or you could output the image to a file:
//$im->writeImage( "image.png" );
?>