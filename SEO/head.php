<?php
/**
 * 发送HTTP请求方法
 * @param  string $url    请求URL
 * @param  array  $$data 请求参数
 * @param  string $method 请求方法GET/POST
 * @return array  $output   响应数据
 */
function curlData($url,$data,$method = 'GET')
{
    //初始化
    $ch = curl_init();
    $headers = array('Content-Type: application/json');
    if($method == 'GET'){
        $querystring = http_build_query($data);
        $url = $url.'?'.$querystring;
    }
    // 请求头，可以传数组
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 执行后不直接打印出来
    if($method == 'POST'){
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');     // 请求方式
        curl_setopt($ch, CURLOPT_POST, true);        // post提交
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);   // post的变量
    }
    if($method == 'PUT'){
        curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    }
    if($method == 'DELETE'){
        curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 不从证书中检查SSL加密算法是否存在
    $output = curl_exec($ch); //执行并获取HTML文档内容
    curl_close($ch); //释放curl句柄
    return $output;
}