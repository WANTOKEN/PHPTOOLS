<?php
//电商预约时段数据
//http://www.ztk.com/MySql/export8.php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}
//$sql = "select * from rzj_store.cmf_reservation WHERE date >='{$startDate}' AND date<='{$endDate}' order by date asc;";
$sql = "select * from rzj_store.cmf_reservation WHERE type= '1' order by date asc ;";
$stmt = $conn->prepare($sql);
$stmt->execute();
// 设置结果集为关联数组
$resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = array();
//var_dump($resultData);

foreach ($resultData as &$v){
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
$fileName = "电商预约时段数据";
$headArr=array('id'=>'预约ID','store_id'=>'门店ID','date'=>'日期','start_time'=>'开始时间','end_time'=>'结束时间','is_order'=>'电商预约');
$excel->exportBrowser($fileName,$headArr,$dataArr);
$conn = null;



