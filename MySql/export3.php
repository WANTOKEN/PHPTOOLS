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

##41243114 / 41179081 / 41242216 / 41214836 麻烦给我一下这几个BA上周的兑换次数明细
$sql = "select t2.user_login as BA,t2.user_nicename as baname,t3.name as name,t3.phone as phone,t1.openid,t1.times as times,t1.photo_path as 小票地址
, t1.date as date,t1.create_time as create_time
from (rzj_store.cmf_exchange_log t1 left join rzj_store.cmf_users t2 on t1.employee_no= t2.id)
left join rzj.wp_auth_list t3 on t1.openid=t3.openid WHERE
t1.times>0 AND t1.create_time>='2020-06-15 00:00:00' and t1.create_time<='2020-06-21 23:59:59'
and t2.user_login in ('41243114','41179081','41242216','41214836')
 ORDER BY t2.user_login desc;";

//$sql = "select t3.name as name,t3.phone as phone,t1.openid,t1.times as times,t1.photo_path as 小票地址
//,t2.user_login as BA,t2.user_nicename as baname, t1.date as date,t1.create_time as create_time
//from (rzj_store.cmf_users t2  left join rzj_store.cmf_exchange_log t1  on t1.employee_no= t2.id)
//left join rzj.wp_auth_list t3 on t1.openid=t3.openid WHERE
//t1.times>0 AND t1.create_time>='2020-06-15 00:00:00' and t1.create_time<='2020-06-21 23:59:59'
//and t2.user_login in ('41243114','41179081','41242216','41214836')
// ORDER BY t2.user_login desc;";
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
//$result = array();
//foreach ($resultData as $v){
//    if($v['name']) $result[] = $v;
//}

$excel = new PHPExcelTools();
$fileName = "6-15至6-21兑换次数明细";
$headArr=array('BA'=>'员工编号','baname'=>'员工姓名','name'=>'顾客姓名','phone'=>'顾客手机号','openid'=>'顾客openid',
    'times'=>'兑换服务次数','小票地址'=>'小票地址',
    'date'=>'兑换服务日期','create_time'=>'具体时间');
$excel->export($fileName,$headArr,$resultData);
$conn = null;
var_dump($resultData);


