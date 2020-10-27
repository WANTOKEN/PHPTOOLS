<?php
//每周一导出数据
//http://www.ztk.com/MySql/export7.php?start=2020-08-06&&end=2020-08-31
//$startDate = "2020-08-07"; //$_GET['start'];// "2020-07-31";
//$endDate = "2020-08-08";$_GET['end'];// "2020-08-31";
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
$servername = "127.0.0.1";
$username = "root";
$password = "123456";
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}
//$sql = "select * from rzj_store.cmf_reservation WHERE date >='{$startDate}' AND date<='{$endDate}' order by date asc;";
$sql = "select * from rzj_store.cmf_reservation order by date desc limit 10;";
$stmt = $conn->prepare($sql);
$stmt->execute();
// 设置结果集为关联数组
$resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = array();
//var_dump($resultData);

//$sql4 = "select store_id,name from rzj_store.cmf_stores;";
//$stmt = $conn->prepare($sql4);
//$stmt->execute();
//// 设置结果集为关联数组
//$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
//$storeData=array();//
//foreach ($result4 as $v){
//    $storeData[$v['store_id']]=$v['name'];
//}


$dateTimeMap = array();
$i=0;
foreach ($resultData as &$v){
    $date = $v['date'];
    $startTime = $v['start_time'];
    $endTime = $v['end_time'];
//    $result[$i]['store_id'] = $v['store_id'];
//    $result[$i]['start_time'] = $v['start_time'];
//    $result[$i]['end_time'] = $v['end_time'];
//    $result[$i]['date'] = $date;
//    $result[$i]['name'] = $storeData[$v['store_id']];
//    $v['name'] =  $storeData[$v['store_id']];
    $v['is_order'] =  "Y";
}

//var_dump($result);
$dataArr=$resultData;
//echo json_encode($dataArr);
//foreach ($result as $v){
//    foreach ($v as $sv){
//        $dataArr[]=$sv;
//    }
//}

$excel = new PHPExcelTools();
$fileName = "{$startDate}至{$endDate}所有门店服务时间";
$headArr=array('id'=>'预约ID','store_id'=>'门店ID','date'=>'日期','start_time'=>'开始时间','end_time'=>'结束时间','is_order'=>'电商预约');
$excel->exportBrowser($fileName,$headArr,$dataArr);
$conn = null;



