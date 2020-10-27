<?php
//$timestamp = time();
//echo $timestamp;
//$nonce_str =getRandChar(16);
//echo $nonce_str;

$timestamp = time();
$nonce_str = getRandChar(16);
$diySign = createSign($nonce_str,$timestamp);
echo "自定义:".$diySign.PHP_EOL;
echo "nonce:".$nonce_str.PHP_EOL;
echo "timestamp：".$timestamp.PHP_EOL;
function createSign($nonce_str,$timestamp){
    $stringA = "nonce=$nonce_str&timestamp=$timestamp";
    $stringSignTemp = $stringA.'&key=k82zzYcRBexPsH7jumIji6iTXYzEk2yN';
    $sign= strtoupper(md5($stringSignTemp));
    return $sign;
}

function getRandChar($length)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";//大小写字母以及数字
    $max = strlen($strPol) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[mt_rand(0, $max)];
    }
    return $str;
}


$signArr = array();
$signArr["nonce"] = $nonce_str;
$signArr["timestamp"] = $timestamp;
$signArr["orderId"] = "8";
var_dump($signArr);
$apiSign = sign($signArr);
echo "接口的:".$apiSign.PHP_EOL;
echo $diySign===$apiSign;
function sign($signArr)
{
    $joint = asc_sort($signArr);
    $stringSignTemp = $joint."&key=k82zzYcRBexPsH7jumIji6iTXYzEk2yN";
    $res = strtoupper(md5($stringSignTemp));
    return $res;
}

function asc_sort($p_arr = array())
{
    if (!empty($p_arr)) {
        $p = ksort($p_arr);
        if ($p) {
            $str = '';
            foreach ($p_arr as $k => $val) {
                $str .= $k . '=' . $val . '&';
            }
            $strs = rtrim($str, '&');
            return $strs;
        }
    }
    return false;
}