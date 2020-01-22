<?php
//  创建图像
$im = imagecreatetruecolor(100, 100);

// 启用混色模式
imagealphablending($im, true);

// 画一个正方形
imagefilledrectangle($im, 30, 30, 70, 70, imagecolorallocate($im, 255, 0, 0));

// 输出
header('Content-type: image/png');

imagepng($im);
imagedestroy($im);
?>