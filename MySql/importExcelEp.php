<?php
//预约次数均分
//http://www.ztk.com/MySql/importExcelEp.php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}
$startDate = "2019-12-30";
$endDate = "2020-09-06";

$sql5 = "select a.user_login,a.user_nicename,b.role_id,b.user_id from rzj_store.cmf_users a left JOIN rzj_store.cmf_role_user b on a.id=b.user_id; 
";
$stmt = $conn->prepare($sql5);
$stmt->execute();
// 设置结果集为关联数组
$result5 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$storeBaData=array();//BA数据
foreach ($result5 as $v){
    $storeBaData[$v['user_login']]['role_id']=$v['role_id'];
}


$sql4 = "select store_id,count(*) as times FROM rzj_store.cmf_reservation where date >='{$startDate}' and date<='{$endDate}' and status = 1 GROUP BY  store_id;";
$stmt = $conn->prepare($sql4);
$stmt->execute();
// 设置结果集为关联数组
$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$storeData=array();//预约次数
foreach ($result4 as $v){
    $storeData[$v['store_id']]=$v['times'];
}
//var_dump($storeData);die;


$excel = new PHPExcelTools();
$localSavePath = 'H:\工作\因赛工作\睿致肌\月次数.xlsx';
$format = array('员工编号'=>'user_login','姓名'=>'name','Join Date'=>'joindate','Store No.'=>'store_id',
    'MKT'=>'mtk','职位'=>'position','中文职位'=>'zhposition','是否营业'=>'is_open','手机号码'=>'phone',
    '是否激活'=>'isactive','登记次数'=>'djtimes','登记人数'=>'djnums','核销次数'=>'hxnums',
    '门店名称'=>'store_name','门店ID'=>'store_id2','省'=>'province','市'=>'city','地址'=>'address',
    '联系方式'=>'contact'
);
$data = $excel->import($format, $localSavePath);

$needEp = array();
foreach ($data as $v){
    $needEp[$v['store_id']]['data'][] = $v; //数据
    if(!isset($needEp[$v['store_id']]['times']))$needEp[$v['store_id']]['times']=0; //如果没有就0
    if(!empty($v['phone'])&&(isset($storeBaData[$v['user_login']]['role_id'])&&$storeBaData[$v['user_login']]['role_id']==5)){   //分配次数 有号码并且是BA
        $needEp[$v['store_id']]['times'] = ++$needEp[$v['store_id']]['times'];
    }
}
$storeIndexAvg = array();
$rolesData = array('1'=>'超级管理员','2'=>'门店管理员','3'=>'监管人员','5'=>'BA','6'=>'BAS/BAM');
$dataArr = array();
foreach ($data as $k=>$v){
    //获取次数
    $storeTimes = $storeData[$v['store_id']];
    //获取平均分配的数组
    $per_times = $needEp[$v['store_id']]['times'];
    $per_arr = numberAvg($storeTimes, $per_times);
    if(!isset( $storeIndexAvg[$v['store_id']]['index']))
        $storeIndexAvg[$v['store_id']]['index']=0;
    $index = $storeIndexAvg[$v['store_id']]['index'];

    $dataArr[$k]['user_login'] = $v['user_login'];
    $dataArr[$k]['name'] = $v['name'];
    $dataArr[$k]['joindate'] = $v['joindate'];
    $dataArr[$k]['mtk'] = $v['mtk'];
    $dataArr[$k]['position'] = $v['position'];
    $dataArr[$k]['store_id'] = $v['store_id'];
    $dataArr[$k]['phone'] = $v['phone'];
    $dataArr[$k]['role'] = $rolesData[$storeBaData[$v['user_login']]['role_id']];
    $dataArr[$k]['monthtimesindex'] = $index;
    if(!empty($dataArr[$k]['phone'])&&(isset($storeBaData[$v['user_login']]['role_id'])&&$storeBaData[$v['user_login']]['role_id']==5)){
        $dataArr[$k]['monthtimes'] = $per_arr[$index];
        $storeIndexAvg[$v['store_id']]['index']++;
    } else{
        $dataArr[$k]['monthtimes'] = 0;
    }
}

$excel2 = new PHPExcelTools();
//$i=0;
$fileName2 = "{$startDate}-{$endDate}员工角色";
$headArr=array('user_login'=>'员工编号','name'=>'姓名',
    'joindate'=>'Join Date','store_id'=>'Store NO.','mtk'=>'MKT','position'=>'职位',
    'phone'=>'手机号码',
    'monthtimes'=>'预约次数','role'=>'角色');
$excel2->exportBrowser($fileName2,$headArr,$dataArr);


//平均分配算法
function numberAvg($number, $avgNumber)
{
    if($number == 0) {
        $array = array_fill(0, $avgNumber, 0);
    } else {
        $avg     = floor($number / $avgNumber);
        $ceilSum = $avg * $avgNumber;
        $array   = array();
        for($i = 0; $i < $avgNumber; $i++) {
            if($i < $number - $ceilSum) {
                array_push($array, $avg + 1);
            } else {
                array_push($array, $avg);
            }
        }
    }
    return $array;
}

//var_dump(numberAvg(0,4));