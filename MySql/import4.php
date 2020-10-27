<?php
//set_time_limit(0); //执行时间无限
//ini_set('memory_limit', '-1'); //内存无限
//每周一导出数据
//http://www.ztk.com/MySql/import4.php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}
//$excel = new PHPExcelTools();
//$localSavePath = 'C:\Users\dell\Documents\WeChat Files\wxid_d08ggs33daje21\FileStorage\File\2020-09\员工数据汇总2020-01-01_2020-09-03.xlsx';
//$format = array('员工编号'=>'user_login','姓名'=>'name','Store NO.'=>'store_id',
//    '系统角色'=>'roles','手机号码'=>'phone',
//);
//$data = $excel->import($format, $localSavePath);
//$hasPhonePerson = array();
//foreach ($data as $v){
//    if(!empty($v['phone'])) $hasPhonePerson[$v['phone']] = $v;
//}
//$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR .'data.json';
//file_put_contents($filename, json_encode($hasPhonePerson,JSON_UNESCAPED_UNICODE));//保存文件到指定路径
//$json_string = file_get_contents($filename);
//$hasPhonePerson = json_decode($json_string, true);
//var_dump($hasPhonePerson);

//foreach ($hasPhonePerson as $k=>$v){
//    $sql = "select id,name,phone,status,create_time,openid from rzj_store.cmf_reservation_order WHERE phone = '$k' and create_time>='2020-01-01 00:00:00' and  create_time<='2020-08-31 23:59:59';";
//    $stmt = $conn->prepare($sql);
//    $stmt->execute();
//// 设置结果集为关联数组
//    $reversionOrder = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    $hasPhonePerson[$k]['order']=$reversionOrder;
//        if(!empty($reversionOrder)){
//            $hasPhonePerson[$k]['openid']=$reversionOrder[0]['openid'];
//        }else{
//            $hasPhonePerson[$k]['openid']=null;
//        }
//}

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR .'data2.json';
//file_put_contents($filename, json_encode($hasPhonePerson,JSON_UNESCAPED_UNICODE));//保存文件到指定路径
$json_string = file_get_contents($filename);
$hasPhonePerson = json_decode($json_string, true);



//核销时间
//foreach ($hasPhonePerson as $k=>$v){
//    $sql = "select id,costomer_phone,create_time from rzj_store.cmf_verification WHERE costomer_phone = '$k' and create_time>='2020-01-01 00:00:00' and  create_time<='2020-08-31 23:59:59';";
//    $stmt = $conn->prepare($sql);
//    $stmt->execute();
//// 设置结果集为关联数组
//    $verificationOrder = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    $hasPhonePerson[$k]['verification']=$verificationOrder;
//}
$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR .'data3.json';
//file_put_contents($filename, json_encode($hasPhonePerson,JSON_UNESCAPED_UNICODE));//保存文件到指定路径
$json_string = file_get_contents($filename);
$hasPhonePerson = json_decode($json_string, true);
//var_dump($hasPhonePerson);

//兑换

//foreach ($hasPhonePerson as $k=>$v){
//    $openid = $v['openid'];
//    if(empty($openid)) {
//        $hasPhonePerson[$k]['exchange']=array();
//    }else{
//        $sql = "select id,trade_no,openid,date,employee_no,type,used_times,times,create_time from rzj_store.cmf_exchange_log WHERE openid = '$openid' and employee_no!='pos' and create_time>='2020-01-01 00:00:00' and  create_time<='2020-08-31 23:59:59';";
//        $stmt = $conn->prepare($sql);
//        $stmt->execute();
//// 设置结果集为关联数组
//        $exchangeOrder = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        $hasPhonePerson[$k]['exchange']=$exchangeOrder;
//    }
//
//}
$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR .'data4.json';
//file_put_contents($filename, json_encode($hasPhonePerson,JSON_UNESCAPED_UNICODE));//保存文件到指定路径
$json_string = file_get_contents($filename);
$hasPhonePerson = json_decode($json_string, true);


$bigData = array();

foreach ($hasPhonePerson as $v){
    $item = array();
    $orders  = $v['order'];
    $orderStatus = array(0 => '待体验', 1 => '待评价', 2 => '已完成', 3 => '已取消','4'=>'已过期');
    foreach ($orders as $ok=>$ov){
        $item[$ok]['user_login']=$v['user_login'];
        $item[$ok]['name']=$v['name'];
        $item[$ok]['store_id']=$v['store_id'];
        $item[$ok]['roles']=$v['roles'];
        $item[$ok]['phone']=$v['phone'];
        $item[$ok]['order_create_time']=$ov['create_time'];//预约时间
        $item[$ok]['order_status']=$orderStatus[$ov['status']];//预约状态
    }
    $verification  = $v['verification'];
    foreach ($verification as $ok=>$ov){
        $item[$ok]['user_login']=$v['user_login'];
        $item[$ok]['name']=$v['name'];
        $item[$ok]['store_id']=$v['store_id'];
        $item[$ok]['roles']=$v['roles'];
        $item[$ok]['phone']=$v['phone'];
        $item[$ok]['verification_create_time']=$ov['create_time'];//核销时间
    }

    $exchange  = $v['exchange'];
    foreach ($exchange as $ok=>$ov){
        $item[$ok]['user_login']=$v['user_login'];
        $item[$ok]['name']=$v['name'];
        $item[$ok]['store_id']=$v['store_id'];
        $item[$ok]['roles']=$v['roles'];
        $item[$ok]['phone']=$v['phone'];
        $item[$ok]['exchange_create_time']=$ov['create_time'];//兑换时间
        $item[$ok]['exchange_times']=$ov['times'];//兑换次数
    }
    if(empty($orders)&&empty($verification)&&empty($exchange)){
        $item[0]['user_login']=$v['user_login'];
        $item[0]['name']=$v['name'];
        $item[0]['store_id']=$v['store_id'];
        $item[0]['roles']=$v['roles'];
        $item[0]['phone']=$v['phone'];
        $item[0]['order_create_time']="";//预约时间
        $item[0]['order_status']="";//预约状态
        $item[0]['verification_create_time']="";//核销时间
        $item[0]['exchange_create_time']="";//兑换时间
        $item[0]['exchange_times']="";//兑换次数
    }
    $bigData[]=$item;
}
$dataArr = array();

foreach ($bigData as $k=>$v){
    foreach ($v as $sv){
        if(!isset($sv['order_create_time']))$sv['order_create_time']="";
        if(!isset($sv['order_status']))$sv['order_status']="";
        if(!isset($sv['verification_create_time']))$sv['verification_create_time']="";
        if(!isset($sv['exchange_create_time']))$sv['exchange_create_time']="";
        if(!isset($sv['exchange_times']))$sv['exchange_times']="";
        $dataArr[]=$sv;
    }
}

$excel = new PHPExcelTools();
//$i=0;
$fileName2 = "2020-01-01至2020-08-31员工数据";
$headArr=array('user_login'=>'员工编号','name'=>'员工姓名','store_id'=>'Store NO.',
    'roles'=>'系统角色','phone'=>'手机号码','order_create_time'=>'预约时间','order_status'=>'预约状态',
    'verification_create_time'=>'核销时间','exchange_create_time'=>'登记时间','exchange_times'=>'登记次数'
);
$excel->exportBrowser($fileName2,$headArr,$dataArr);



