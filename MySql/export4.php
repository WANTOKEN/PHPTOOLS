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


$sql2 = "select t1.name,t1.openid,t1.phone,t1.reservation_id,t1.status,t1.create_time,t2.store_id,t2.date from rzj_store.cmf_reservation_order t1 
LEFT JOIN rzj_store.cmf_reservation t2 on 
t1.reservation_id=t2.id where t1.create_time>='2020-01-01 00:00:00' and  t1.create_time<='2020-10-28 23:59:59' order by name desc;";
$stmt = $conn->prepare($sql2);
$stmt->execute();
// 设置结果集为关联数组
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单

//$order_status = array(  0 => '待体验',
//     1 => '待评价',
//     2 => '已完成',
//     3 => '已取消','4'=>'已过期');
$order_status = array(0 => '已预约', 1 => '已服务', 2 => '已评价', 3 => '已取消','4'=>'已过期');
//var_dump($result2);

$sql4 = "select store_id,name from rzj_store.cmf_stores;";
$stmt = $conn->prepare($sql4);
$stmt->execute();
// 设置结果集为关联数组
$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$storeData=array();//预约次数
foreach ($result4 as $v){
    $storeData[$v['store_id']]=$v['name'];
}

foreach ($data as &$v){
    if($v['status']==0&&strtotime($v['date'])<=strtotime('2020-06-29')){
        $v['status_str'] = $order_status[4];
    } else{
        $v['status_str'] = $order_status[$v['status']];
    }
    if($v['status']==0||$v['status']==3||$v['status']==4){
        $v['isfuwu'] = "N";
    }elseif ($v['status']==1||$v['status']==2){
        $v['isfuwu'] = "Y";
    }

    $v['store_name'] = isset($storeData[$v['store_id']])?$storeData[$v['store_id']]:'';

}
$result = array();
foreach ($data as $k=>$v){
    $result[$k]['name'] =  $v['name'];
    $result[$k]['openid'] =  $v['openid'];
    $result[$k]['phone'] =  $v['phone'];
    $result[$k]['store_id'] =  $v['store_id'];
    $result[$k]['store_name'] =  $v['store_name'];
    $result[$k]['date'] =  $v['date'];
    $result[$k]['status_str'] =  $v['status_str'];
    $result[$k]['isfuwu'] =  $v['isfuwu'];
}
//var_dump($result);
$excel = new PHPExcelTools();
$fileName = "2020-01-01至2020-10-28客户预约服务";
$headArr=array(
    'name'=>'用户',
    'openid'=>'opend ID',
    'phone'=>'电话号码',
    'store_id'=>'店铺号',
    'store_name'=>'店铺名称',
    'date' => '预约日期',
    'status_str' => '预约状态',
    'isfuwu' => '是否已服务',

    );

$excel->exportCSV($fileName,$headArr,$result);
$conn = null;



