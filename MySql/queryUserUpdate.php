<?php
set_time_limit(0);
ini_set('memory_limit','3096M');
//http://www.ztk.com/MySql/queryUserUpdate.php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}

$sql5 = "select * from rzj.wp_auth_list ;";

$stmt = $conn->prepare($sql5);
$stmt->execute();
// 设置结果集为关联数组
$result5 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$unionIdArr = array();
foreach ($result5 as $v){
    $unionIdArr[$v['openid']] = $v;
}


$sql6 = "select * from rzj_store.cmf_reservation_order ;";

$stmt = $conn->prepare($sql6);
$stmt->execute();
// 设置结果集为关联数组
$result6 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单

foreach ($result6 as &$v){
    $v['unionId'] = $unionIdArr[$v['openid']]['unionId'];
}

$sql7 = "select * from rzj_store.cmf_reservation_number where number>0;";

$stmt = $conn->prepare($sql7);
$stmt->execute();
// 设置结果集为关联数组
$result7 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
foreach ($result7 as &$v){
    $v['unionId'] = $unionIdArr[$v['openid']]['unionId'];
}

$SQLTEXT = "";
$SQLERRORTEXT = "";
$SQLERRORTEXT2 = "";

$SQLERRORTEXT_NUM = "";
$SQLERRORTEXT2_NUM = "";

$orderArr = array();
$orderCount = 0;
$personCount = 0;
foreach ($result6 as $v){

    $openid = $v['openid'];

    $unionId = $v['unionId'];

    if(empty($unionId)){
        $orderArr = $v;
        $SQLERRORTEXT .= json_encode($v)."\n";
        $SQLERRORTEXT2 .= "{$openid}\n ";
        $orderCount++;
        echo $openid.PHP_EOL;
    }
//    echo $SQLTEXT.PHP_EOL;
}
$numArr = array();
foreach ($result7 as $v){

    $openid = $v['openid'];
    $unionId = $v['unionId'];
    if(empty($unionId)){
        $numArr = $v;
        $SQLERRORTEXT_NUM .= json_encode($v)."\n";
        $SQLERRORTEXT2_NUM .= "{$openid}\n ";
        $personCount++;
        echo $openid.PHP_EOL;
    }
//    echo $SQLTEXT.PHP_EOL;
}

echo "无unionId订单数：".$orderCount.PHP_EOL;
echo "无unionId有次数人数：".$personCount.PHP_EOL;

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA5/order'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLERRORTEXT);//保存文件到指定路径

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA5/order2openid'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLERRORTEXT2);//保存文件到指定路径

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA5/number'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLERRORTEXT_NUM);//保存文件到指定路径

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA5/number2openid'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLERRORTEXT2_NUM);//保存文件到指定路径





$conn = null;
