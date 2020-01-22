<?php
// 打开一幅图像
$url = 'http://biu-cn.dwstatic.com/zbshenqi/20200121/08e9e497ae64496f9788590e42ccbab0.jpg?w=798&h=798';
$im = imagecreatefromjpeg($url);
list($width, $height) = getimagesize($url);
// 取得一点的颜色
$textFont = "D:/wamp64/www/ztk/PHPTOOLS/GD/HeiTi.ttf";
$fontSize = 5*0.75;
for($x=0;$x<$width;$x+=10){
    for($y=0;$y<$height;$y+=10){
        $color_index = imagecolorat($im, $x, $y);
        $color_tran = imagecolorsforindex($im, $color_index);
            $red = $color_tran['red'];
            $green = $color_tran['green'];
            $blue = $color_tran['blue'];
            $alpha = $color_tran['alpha'];
            $fit = imagecolorallocatealpha($im, $red, $green, $blue,$alpha);
            imagettftext($im, $fontSize, 0, $x, $y, $fit, $textFont, "a");
////        print_r($color_tran);
    }
    echo "\n";
}
header('Content-type: image/jpeg');

imagejpeg($im);
imagedestroy($im);
//$start_x = 0;
//$start_y = 1;
//$color_index = imagecolorat($im, $start_x, $start_y);
//
//// 使其可读
//$color_tran = imagecolorsforindex($im, $color_index);
//
//// 显示该颜色的值
//print_r($color_tran);