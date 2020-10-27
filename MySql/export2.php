<?php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "连接成功";
} catch (PDOException $e) {
    echo $e->getMessage();
}


$sql2 = "select * from rzj_store.cmf_reservation_order;";
$stmt = $conn->prepare($sql2);
$stmt->execute();
// 设置结果集为关联数组
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$order_status = array(0 => '待体验', 1 => '待评价', 2 => '已完成', 3 => '已取消','4'=>'已过期');
$retData=array();//预约次数
foreach ($result2 as $v){
    if(isset($retData[$v['openid']][$v['status']])){
        $retData[$v['openid']][$v['status']]++;
    }else{
        $retData[$v['openid']][$v['status']]=1;
    }
}
//var_dump($retData);


$sql3 = "SELECT costomer_name,costomer_phone,count(costomer_name) as 核销次数  FROM rzj_store.cmf_verification GROUP BY costomer_phone;";
$stmt = $conn->prepare($sql3);
$stmt->execute();
// 设置结果集为关联数组
$result3 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$hexiaoData=array();//核销次数
foreach ($result3 as $v){
    $hexiaoData[$v['costomer_phone']]=$v['核销次数'];
}
//var_dump($hexiaoData);

$sql4 = "SELECT openid,number from rzj_store.cmf_reservation_number;";
$stmt = $conn->prepare($sql4);
$stmt->execute();
// 设置结果集为关联数组
$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$yuyueData=array();//预约次数
foreach ($result4 as $v){
    $yuyueData[$v['openid']]=$v['number'];
}

$sql5 = "select * from rzj_store.cmf_reservation_order where free=1 ;";
$stmt = $conn->prepare($sql5);
$stmt->execute();
// 设置结果集为关联数组
$result5 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$mianfeiData=array();//预约次数
foreach ($result5 as $v){
    $mianfeiData[$v['openid']]=$v['free'];
}
$sql1 = "select name,phone,openid from rzj.wp_auth_list;";
$stmt = $conn->prepare($sql1);
$stmt->execute();
// 设置结果集为关联数组
$result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
$userData = array();
foreach ($result1 as $v){
    $name = $v['name'];
    $openid = $v['openid'];
    $phone = $v['phone'];
    if(isset($retData[$openid]['0'])){
        $statusCount0 = $retData[$openid]['0'];
    }else{
        $statusCount0 = 0;
    }
    if(isset($retData[$openid]['1'])){
        $statusCount1 = $retData[$openid]['1'];
    }else{
        $statusCount1 = 0;
    }
    if(isset($retData[$openid]['2'])){
        $statusCount2 = $retData[$openid]['2'];
    }else{
        $statusCount2 = 0;
    }
    if(isset($retData[$openid]['3'])){
        $statusCount3 = $retData[$openid]['3'];
    }else{
        $statusCount3 = 0;
    }
    if(isset($retData[$openid]['4'])){
        $statusCount4 = $retData[$openid]['4'];
    }else{
        $statusCount4 = 0;
    }
    if(isset($hexiaoData[$phone])){
        $hexiaoDataCount = $hexiaoData[$phone];
    }else{
        $hexiaoDataCount = 0;
    }
    if(isset($yuyueData[$openid])){
        $yuyueDataCount = $yuyueData[$openid];
    }else{
        $yuyueDataCount = 0;
    }
    if(isset($mianfeiData[$openid])){
        $mianfeiDataCount = $mianfeiData[$openid];
    }else{
        $mianfeiDataCount = 0;
    }
    $userData[]=array(
        'name'  => $name,
        'openid' => $openid,
        'phone'=>$phone,
        '待体验预约次数'=> $statusCount0,
        '待评价预约次数'=> $statusCount1,
        '已完成预约次数'=> $statusCount2,
        '已取消预约次数'=> $statusCount3,
        '已过期预约次数'=> $statusCount4,
        '核销次数'=>$hexiaoDataCount,
        '剩余消费预约次数'=>$yuyueDataCount,
        '剩余免费预约次数'=>$mianfeiDataCount
    );
}
$result = array();
foreach ($userData as $v){
    if($v['name']) $result[] = $v;
}
//var_dump($result);
$excel = new PHPExcelTools();
$fileName = "每个客户预约次数和核销次数";
$headArr=array('name'=>'姓名','openid'=>'openid',
    'phone'=>'电话号码',
    '待体验预约次数'=>'待体验预约次数',
    '待评价预约次数'=>'待评价预约次数',
    '已完成预约次数'=>'已完成预约次数',
    '已取消预约次数'=>'已取消预约次数',
    '已过期预约次数'=>'已过期预约次数',
    '核销次数'=>'核销次数',
    '剩余消费预约次数'=>  '剩余消费预约次数',
    '剩余免费预约次数'=>  '剩余免费预约次数'
    );
$excel->exportCSV($fileName,$headArr,$result);
$conn = null;



