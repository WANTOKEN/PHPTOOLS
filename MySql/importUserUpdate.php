<?php
set_time_limit(0);
ini_set('memory_limit','3096M');
//http://www.ztk.com/MySql/import6Insert.php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}

$sql5 = "select * from rzj.wp_auth_list where unionId='' or unionId is null;";

$stmt = $conn->prepare($sql5);
$stmt->execute();
// 设置结果集为关联数组
$result5 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$SQLTEXT = "";
$SQLERRORTEXT = "";
$SQLERRORTEXT2 = "";

foreach ($result5 as $v){

    $openid = $v['openid'];
//    echo $openid;
    $unionId = getUnionId($openid);

    if(empty($unionId)){
        $SQLERRORTEXT .= "update wp_auth_list set unionId = '{$unionId}' where openid= '{$openid}';\n ";
        $SQLERRORTEXT2 .= "{$openid}\n ";

        echo $openid.PHP_EOL;
    }else{
        $SQLTEXT .= "update wp_auth_list set unionId = '{$unionId}' where openid= '{$openid}';\n ";
    }
//    echo $SQLTEXT.PHP_EOL;

}


$VERSION = "v1";
$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA5/update'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLTEXT);//保存文件到指定路径

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA5/error'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLERRORTEXT);//保存文件到指定路径

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA5/error2'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLERRORTEXT2);//保存文件到指定路径

function curl_post($durl, $post_data, $headers = array())
{
    //初始化
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $durl);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, false);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //设置post方式提交
    curl_setopt($curl, CURLOPT_POST, true);
    // 设置post请求参数
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    // 添加头信息
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    // CURLINFO_HEADER_OUT选项可以拿到请求头信息
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    // 不验证SSL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //执行命令
    $data = curl_exec($curl);
    // 打印请求头信息
//        echo curl_getinfo($curl, CURLINFO_HEADER_OUT);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
    return $data;

}



function jsonSign($data)
{
    $appId = "dd7ff40cc06240a8aae22e59e509c03e";
    $secret = "7281ff4751c0467383e721af57d44d92";
    $transactionId = "insight";
    $res = strtoupper(md5($appId .$secret .$transactionId . json_encode($data,JSON_FORCE_OBJECT)));
    return $res;
}
function getUnionId($openId){
    $appId = "dd7ff40cc06240a8aae22e59e509c03e";
    $secret = "7281ff4751c0467383e721af57d44d92";
    $urlPrefix = "https://ob.watsons.com.cn/nclick/nc-common-api";
    $transactionId = "insight";
    $type = "wechat";
    $scope = "snsapi_base";
    $url = $urlPrefix . "/user/userInfo";
    $params = array();
    $params["appId"] =$appId;
    $params["transactionId"] = $transactionId;
    $params["type"] = $type;
    $data = array();

    $data["userId"] = $openId;
    $params["data"] = $data;

    $params["sign"] = jsonSign($data);
    $params = json_encode($params);

    $res = curl_post($url, $params,  array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params))
    );

    $logRes = json_decode($res);
    if ($logRes->resultCode != 0) {
        return false;
    }else{
        return $logRes->data->unionId;
    }
}

$conn = null;
