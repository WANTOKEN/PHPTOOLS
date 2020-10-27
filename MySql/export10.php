<?php
//每周一导出数据
//http://www.ztk.com/MySql/export10.php?start=2020-08-06&&end=2020-08-31
$startDate = "2020-08-24"; //$_GET['start'];// "2020-07-31";
$endDate = "2020-08-30";//$_GET['end'];// "2020-08-31";
set_time_limit(0);
ini_set('memory_limit','3096M');
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}

$sql1 = "SELECT *  from rzj_store.cmf_reservation where status='1' and date>='{$startDate}' and date<='{$endDate}';";
$stmt = $conn->prepare($sql1);
$stmt->execute();
// 设置结果集为关联数组
$reservationData = $stmt->fetchAll(PDO::FETCH_ASSOC);
$reservationDataMap=array();
foreach ($reservationData as $v){
    $reservationDataMap[$v['id']]=$v;
}


$sql4 = "select store_id,name from rzj_store.cmf_stores;";
$stmt = $conn->prepare($sql4);
$stmt->execute();
// 设置结果集为关联数组
$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$storeData=array();//
foreach ($result4 as $v){
    $storeData[$v['store_id']]=$v['name'];
}

$sql = "select * from rzj_store.cmf_reservation_order where status in (0,4) and reservation_id in (SELECT id from rzj_store.cmf_reservation where status='1' and date>='{$startDate}' and date<='{$endDate}')	;";
$stmt = $conn->prepare($sql);
$stmt->execute();
// 设置结果集为关联数组
$resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$dataArr = array();
foreach ($resultData as $k=>$v){
//    $dataArr[$k]['ep_id']=$v['ep_id'];
//    $dataArr[$k]['ep_name']=$v['ep_name'];
    $dataArr[$k]['store_id']=$reservationDataMap[$v['reservation_id']]['store_id'];
    $dataArr[$k]['store_name']=$storeData[$reservationDataMap[$v['reservation_id']]['store_id']];
    $dataArr[$k]['reservation_id']=$v['reservation_id'];
    $dataArr[$k]['date']=$reservationDataMap[$v['reservation_id']]['date'];
    $dataArr[$k]['start_time']=$reservationDataMap[$v['reservation_id']]['start_time'];
    $dataArr[$k]['end_time']=$reservationDataMap[$v['reservation_id']]['end_time'];
    $dataArr[$k]['free']=$v['free']=="1"?"是":"否";
    $dataArr[$k]['order_id']=$v['id'];
    $dataArr[$k]['costomer_name']=$v['name'];
    $dataArr[$k]['costomer_phone']=$v['phone'];
    $dataArr[$k]['create_time']=$v['create_time'];
}



$excel = new PHPExcelTools();
$fileName = "{$startDate}至{$endDate}已预约没核销的记录";
$headArr = array(
    'store_id'=>'门店ID','store_name'=>'门店名称',
    'reservation_id'=>'预约ID','date'=>'服务日期','start_time'=>'服务开始时间','end_time'=>'服务结束时间','free'=>'免费预约',
    'order_id'=>'订单编号','costomer_name'=>'客户名称','costomer_phone'=>'客户手机号','create_time'=>'预约时间'
   );
$excel->exportCSV($fileName,$headArr,$dataArr);
$conn = null;



