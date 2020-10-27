<?php
//预约次数均分
//http://www.ztk.com/MySql/importExcelEp4.php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}


$sql5 = "select a.user_login,a.user_nicename,a.mobile,b.role_id,b.user_id from rzj_store.cmf_users a left JOIN rzj_store.cmf_role_user b on a.id=b.user_id; 
";
$stmt = $conn->prepare($sql5);
$stmt->execute();
// 设置结果集为关联数组
$result5 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$storeBaData=array();//BA数据
foreach ($result5 as $v){
    $storeBaData[$v['user_login']]['role_id']=$v['role_id'];
    $storeBaData[$v['user_login']]['mobile']=$v['mobile'];
}


$storeData = getTimes($conn,"2020-09-21","2020-09-27"); //周
$storeDataMonth = getTimes($conn,"2020-08-24","2020-09-27"); //月
$storeDataYear = getTimes($conn,"2019-12-30","2020-09-27"); //年
$logData = array(
    'storeData'=>$storeData,
    'storeDataMonth'=>$storeDataMonth,
    'storeDataYear'=>$storeDataYear
);

function getTimes($conn,$startDate,$endDate){
    $sql4 = "select store_id,count(*) as times FROM rzj_store.cmf_reservation where date >='{$startDate}' and date<='{$endDate}' and status = 1 GROUP BY  store_id;";
    $stmt = $conn->prepare($sql4);
    $stmt->execute();
// 设置结果集为关联数组
    $result4 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
    $storeData=array();//预约次数
    foreach ($result4 as $v){
        $storeData[$v['store_id']]=$v['times'];
    }
    return $storeData;
}


//var_dump($storeData);die;


$excel = new PHPExcelTools();
$localSavePath = 'G:\员工数据5.xlsx';
$format = array('员工编号'=>'user_login','姓名'=>'name','Store NO.'=>'store_id',
   'MKT'=>'mtk','中文职位'=>'role','手机号码'=>'phone','系统对应角色'=>'role2','是否激活'=>'is_active'
);

$data = $excel->import($format, $localSavePath);

//$SQLTEXT = "";
//foreach ($data as $v){
//    $user_login = $v['user_login'];
//    if(!empty($user_login)){
//        $position = $v['role'];
//        $SQLTEXT .= "update cmf_users set `position` = '{$position}' where user_login= '{$user_login}';\n ";
//    }
//
//}
////echo $SQLTEXT.PHP_EOL;
//$VERSION = "v1";
//$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA4/update'.date('Y-m-d').$VERSION.'.sql';
//file_put_contents($filename, $SQLTEXT);//保存文件到指定路径
//die;


$needEp = array();
foreach ($data as $v){
    $needEp[$v['store_id']]['data'][] = $v; //数据
    if(!isset($needEp[$v['store_id']]['times']))$needEp[$v['store_id']]['times']=0; //如果没有就0
    if(!empty($v['role'])){
        if(((isset($storeBaData[$v['user_login']]['role_id']) &&$storeBaData[$v['user_login']]['role_id']==5)
            && (!empty($storeBaData[$v['user_login']]['mobile'])))&&$v['role']!=="其他"){   //分配次数 有号码并且是BA
            $needEp[$v['store_id']]['times'] = ++$needEp[$v['store_id']]['times'];
        }
    }

}

$storeIndexAvg = array();
$dataArr = array();
foreach ($data as $k=>$v){
    //获取次数
    $storeTimes = $storeData[$v['store_id']];
    //获取平均分配的数组
    $per_times = $needEp[$v['store_id']]['times'];
    $per_arr = numberAvg($storeTimes, $per_times);


    $storeTimesMonth = $storeDataMonth[$v['store_id']];
    $per_arr_month = numberAvg($storeTimesMonth, $per_times);


    $storeTimesYear = $storeDataYear[$v['store_id']];
    $per_arr_year= numberAvg($storeTimesYear, $per_times);


    if(!isset( $storeIndexAvg[$v['store_id']]['index']))
        $storeIndexAvg[$v['store_id']]['index']=0;
    $index = $storeIndexAvg[$v['store_id']]['index'];

    $dataArr[$k]['user_login'] = $v['user_login'];
    $dataArr[$k]['name'] = $v['name'];
    $dataArr[$k]['store_id'] = $v['store_id'];
    $dataArr[$k]['phone'] = $storeBaData[$v['user_login']]['mobile'];
    $dataArr[$k]['role'] = $v['role'];
    $dataArr[$k]['mtk'] = $v['mtk'];

    $dataArr[$k]['per_index'] = $index;
    if(((isset($storeBaData[$v['user_login']]['role_id']) &&$storeBaData[$v['user_login']]['role_id']==5)
            && (!empty($storeBaData[$v['user_login']]['mobile'])))&&(!empty($v['role']))&&$v['role']!=="其他"){
        $dataArr[$k]['weektimes'] = $per_arr[$index];
        $dataArr[$k]['monthtimes'] = $per_arr_month[$index];
        $dataArr[$k]['yeartimes'] = $per_arr_year[$index];
        $storeIndexAvg[$v['store_id']]['index']++;
        unset($logData['storeData'][$v['store_id']]);
        unset($logData['storeDataMonth'][$v['store_id']]);
        unset($logData['storeDataYear'][$v['store_id']]);
    } else{
        $dataArr[$k]['weektimes'] = 0;
        $dataArr[$k]['monthtimes'] = 0;
        $dataArr[$k]['yeartimes'] = 0;
    }
}

$confK = array("storeData"=>"",
    "storeDataMonth"=>"",
    "storeDataYear"=>"");

$saveData = array();
foreach ($logData as $k=>$v){
    $kStr = $confK[$k];
    foreach ($v as $sk=>$sv){
        $text.="门店ID:".$sk." "."次数：".$sv."\n";
        if($k=="storeData") $saveData[$sk]['storeWeekData']=$sv;
        if($k=="storeDataMonth") $saveData[$sk]['storeDataMonth']=$sv;
        if($k=="storeDataYear") $saveData[$sk]['storeDataYear']=$sv;
    }
}

$inserData = array();
$weekCount = 0;
$monthCount = 0;
$yearCount = 0;
foreach ($saveData as $k=>$v){
    $inserData[$k]['store_id']=$k;
    if(isset($v['storeWeekData'])){
        $inserData[$k]['storeWeekData']=$v['storeWeekData'];
        $weekCount+=$v['storeWeekData'];
    }else{
        $inserData[$k]['storeWeekData']=0;
    }

    if(isset($v['storeDataMonth'])){
        $inserData[$k]['storeDataMonth']=$v['storeDataMonth'];
        $monthCount+=$v['storeDataMonth'];
    }else{
        $inserData[$k]['storeDataMonth']=0;
    }

    if(isset($v['storeDataYear'])){
        $inserData[$k]['storeDataYear']=$v['storeDataYear'];
        $yearCount+=$v['storeDataYear'];
    }else{
        $inserData[$k]['storeDataMonth']=0;
    }
}
$inserData[]=array('store_id'=>'总计','storeWeekData'=>$weekCount,'storeDataMonth'=>$monthCount,'storeDataYear'=>$yearCount);

$excel2 = new PHPExcelTools();
//$i=0;
$fileName2 = "未分配门店数据";
$headArr=array('store_id'=>'门店ID','storeWeekData'=>'周',
    'storeDataMonth'=>'月','storeDataYear'=>'年');
$excel2->exportBrowser($fileName2,$headArr,$inserData);
//die;



$excel2 = new PHPExcelTools();
//$i=0;
$fileName2 = "员工数据";
$headArr=array('user_login'=>'员工编号','name'=>'姓名',
   'store_id'=>'Store NO.','mtk'=>'MTK','role'=>'中文职位',
    'phone'=>'手机号码','weektimes'=>'周预约次数',
    'monthtimes'=>'月预约次数','yeartimes'=>'年预约次数');
$excel2->exportBrowser($fileName2,$headArr,$dataArr,$fileName2);

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