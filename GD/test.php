<?php
$name = "testImg/2.png";
//$name = "http://biu-cn.dwstatic.com/zbshenqi/20200218/e90b3d8a9af91de6acff295efbe88c50.jpg?w=900&h=900";

$updata = [
    'name'=> $name,
];
$type = 'BBZP';
$josnStr = json_encode($updata);
$data = json_decode($josnStr);
$apiPath = dirname(__FILE__). DIRECTORY_SEPARATOR."api/{$type}.PHP";
include ($apiPath);

// 保存图片
$md5_name = md5($updata['name']);
$log_date = date("YmdHis").time();
$save_path = "upload_img/".date("Ymd")."/"; //存放目录
$saveName = $type . $md5_name . $log_date . '.jpg';
$saveFile = $save_path . $saveName;
if(!is_dir($save_path)){
    $path = $save_path;
    $res=mkdir($path,0777,true);
    if ($res){
//        echo "目录 $path 创建成功";
    }else{
//        echo "目录 $path 创建失败";
    }
}
imagejpeg($im, $saveFile);
imagedestroy($im);


$now = date("Y.m.d");
$serverHost = 'http://www.ztk.com/PHPTOOLS/GD/';
$imgUrl = $serverHost . $save_path . $saveName;
echo "<img src=$imgUrl>";