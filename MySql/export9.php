<?php
//每周一导出数据
//http://www.ztk.com/MySql/export9.php?start=2020-08-06&&end=2020-08-31
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
$sql = "select * from rzj_store.cmf_verification WHERE date >='{$startDate}' AND date<='{$endDate}' order by date asc; ";

$stmt = $conn->prepare($sql);
$stmt->execute();
// 设置结果集为关联数组
$resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$dataArr = array();
foreach ($resultData as $k=>$v){
    $dataArr[$k]['ep_id']=$v['ep_id'];
    $dataArr[$k]['ep_name']=$v['ep_name'];
    $dataArr[$k]['store_id']=$v['store_id'];
    $dataArr[$k]['store_name']=$v['store_name'];
    $dataArr[$k]['reservation_id']=$v['reservation_id'];
    $dataArr[$k]['date']=$v['date'];
    $dataArr[$k]['start_time']=$v['start_time'];
    $dataArr[$k]['end_time']=$v['end_time'];
    $dataArr[$k]['free']=$v['free']=="1"?"是":"否";
    $dataArr[$k]['order_id']=$v['order_id'];
    $dataArr[$k]['costomer_name']=$v['costomer_name'];
    $dataArr[$k]['costomer_phone']=$v['costomer_phone'];
    $dataArr[$k]['create_time']=$v['create_time'];
}



$excel = new PHPExcelTools();
$fileName = "{$startDate}至{$endDate}全国核销数据";
$headArr = array('ep_id'=>'店员账号','ep_name'=>'店员名称',
    'store_id'=>'门店ID','store_name'=>'门店名称',
    'reservation_id'=>'预约ID','date'=>'服务日期','start_time'=>'服务开始时间','end_time'=>'服务结束时间','free'=>'免费预约',
    'order_id'=>'订单编号','costomer_name'=>'客户名称','costomer_phone'=>'客户手机号','create_time'=>'核销时间'
   );
$excel->exportCSV($fileName,$headArr,$dataArr);
$conn = null;


////电商预约时段数据
////http://www.ztk.com/MySql/export9.php
//include '../PHPExcel/PHPExcelTools.php';
//$servername = "118.190.41.120";
//$username = "insight";
//$password = "insight0.123";
////$servername = "127.0.0.1";
////$username = "root";
////$password = "123456";
//$startDate="2020-05-01";
//$endDate ="2020-05-02" ;//date('Y-m-d');
//try {
//    $conn = new PDO("mysql:host=$servername;", $username, $password);
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
////    echo "连接成功";
//} catch (PDOException $e) {
////    echo $e->getMessage();
//}
//$sql = "select * from rzj_store.cmf_verification WHERE date >='{$startDate}' AND date<='{$endDate}' order by ep_id asc;";
//$stmt = $conn->prepare($sql);
//$stmt->execute();
//// 设置结果集为关联数组
//$resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
////foreach ($resultData as &$v){
////    $v['is_free'] =  $v['free']==1?"是":"";
////}
//
////var_dump($result);
////$dataArr=$resultData;
////echo json_encode($dataArr);
////foreach ($result as $v){
////    foreach ($v as $sv){
////        $dataArr[]=$sv;
////    }
////}
//
//$excel = new PHPExcelTools();
//$fileName = "{$startDate}至{$endDate}全国核销数据";
//$headerArr = array('ep_id'=>'店员账号','ep_name'=>'店员名称',
//    'store_id'=>'门店ID','store_name'=>'门店名称',
//    'reservation_id'=>'预约ID','date'=>'服务日期','start_time'=>'服务开始时间','end_time'=>'服务结束时间','free'=>'免费预约',
//    'order_id'=>'订单编号','costomer_name'=>'客户名称','costomer_phone'=>'客户手机号','create_time'=>'核销时间'
//   );
//$excel->exportBrowser($fileName,$headArr,$resultData);
//$conn = null;



