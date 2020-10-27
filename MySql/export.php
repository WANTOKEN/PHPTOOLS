<?php
//每周一导出数据
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "连接成功";
} catch (PDOException $e) {
    echo $e->getMessage();
}
$sql = "select t3.name as name,t3.phone as phone,t1.openid,t1.times as times,t1.photo_path as 小票地址
,t2.user_login as BA,t1.date as date,t1.create_time as create_time
from (rzj_store.cmf_exchange_log t1 left join rzj_store.cmf_users t2 on t1.employee_no= t2.id)
left join rzj.wp_auth_list t3 on t1.openid=t3.openid WHERE
t1.times>0 AND t1.create_time>='2020-07-06 00:00:00' and t1.create_time<='2020-07-12 23:59:59' ORDER BY t3.name desc;";


$stmt = $conn->prepare($sql);
$stmt->execute();
// 设置结果集为关联数组
$resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultData as &$v){
    if($v["小票地址"]){
        $v["小票地址"] = str_replace('./upload/','http://rzjstore.intech.gdinsight.com/upload/',$v["小票地址"] );
    }else{
        $v["小票地址"] = "由pos机产生";
    }
}
$result = array();
foreach ($resultData as $v){
    if($v['name']) $result[] = $v;
}

$excel = new PHPExcelTools();
$fileName = "07-06至07-12所有顾客被添加次数的累计情况";
$headArr=array('name'=>'姓名','phone'=>'手机号','openid'=>'openid',
    'times'=>'获得服务次数','小票地址'=>'小票地址','BA'=>'BA',
    'date'=>'获得服务日期','create_time'=>'具体时间');
$excel->export($fileName,$headArr,$result);
$conn = null;
//var_dump($result);


