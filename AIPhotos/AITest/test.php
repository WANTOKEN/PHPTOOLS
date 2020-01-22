<?php
require_once 'AipBodyAnalysis.php';

// 你的 APPID AK SK
const APP_ID = '18330944';//你的 App ID
const API_KEY = 'cA5GMwTj3dkvAhG9WgNBpU1q';//你的 Api Key
const SECRET_KEY = 'EGrouYO8fMi0HzTDiKs8S47smgRSVEyV';//你的 Secret Key

$client = new AipBodyAnalysis(APP_ID, API_KEY, SECRET_KEY);

$img = 'test3.jpg';
$image = file_get_contents($img);

// 调用人像分割

//$client->bodySeg($image);

// 如果有可选参数
$options = array();
$options["type"] = "foreground";

// 带参数调用人像分割
for($i=0;$i<10;$i++){
    $RET = $client->bodySeg($image, $options);
    $imgBase64 = $RET['foreground'];
    $imgDecode = base64_decode($imgBase64);

// 保存到本地,4 test
    $save_path = dirname(__FILE__) .'\\'.'img'.'\\';
    $saveName = md5(mt_rand() . time() . uniqid('seg_bottom_foreground', true)) . '.png';
    $saveFile = $save_path . $saveName;
    file_put_contents($saveFile, $imgDecode);//返回的是字节数
//    echo $saveFile;echo '    ';
    $url = "http://www.ztk.com/PHPTOOLS/AIPhotos/AITest/img/".$saveName;
    echo "<img src=$url width='50px';height='50px;'>";
}

