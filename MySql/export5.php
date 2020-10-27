<?php
//每周一导出数据
//http://www.ztk.com/MySql/export5.php?start=2020-08-11&&end=2020-08-31

$startDate = $_GET['start'];// "2020-07-31";
$endDate = $_GET['end'];// "2020-08-31";
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}
$sql = "select * from rzj_store.cmf_reservation WHERE date >='{$startDate}' AND date<='{$endDate}';";

$stmt = $conn->prepare($sql);
$stmt->execute();
// 设置结果集为关联数组
$resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = array();
//var_dump($resultData);

$sql4 = "select store_id,name from rzj_store.cmf_stores;";
$stmt = $conn->prepare($sql4);
$stmt->execute();
// 设置结果集为关联数组
$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$storeData=array();//
foreach ($result4 as $v){
    $storeData[$v['store_id']]=$v['name'];
}

$dateTimeMap = array();
foreach ($resultData as $v){
    $date = $v['date'];
    $startTime = $v['start_time'];
    $endTime = $v['end_time'];
    $times =  round((strtotime($endTime)-strtotime($startTime))/3600,2);
    $result[$v['store_id']][$date]['store_id'] = $v['store_id'];
    $result[$v['store_id']][$date]['times'] += $times;
    $result[$v['store_id']][$date]['date'] = $date;
    $result[$v['store_id']][$date]['name'] = $storeData[$v['store_id']];
}
//echo json_encode($result);
//var_dump($result);
$dataArr = array();
foreach ($result as $v){
    foreach ($v as $sv){
        $dataArr[]=$sv;
    }
}

$excel = new PHPExcelTools();
$fileName = "{$startDate}至{$endDate}所有门店服务时间小时数";
$headArr=array('store_id'=>'门店ID','name'=>'门店名称','date'=>'日期','times'=>'服务时间小时数');
$excel->exportBrowser($fileName,$headArr,$dataArr);
$conn = null;
//var_dump($result);


