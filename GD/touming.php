<?php
// 载入带 alpha 通道的 png 图像
$url = 'http://biu-cn.dwstatic.com/zbshenqi/20200121/08e9e497ae64496f9788590e42ccbab0.jpg?w=798&h=798';
$png = imagecreatefromjpeg($url);

// 做些必须的操作

// 关闭 alpha 渲染并设置 alpha 标志
imagealphablending($png, false);
imagesavealpha($png, true);

// 输出图像到浏览器
header('Content-Type: image/jpeg');

imagejpeg($png,'aaa.jpg');
imagedestroy($png);