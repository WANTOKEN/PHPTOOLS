<?php
//预约次数均分
//http://www.ztk.com/MySql/importExcelEp2.php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}
$startDate = "2020-08-31";
$endDate = "2020-09-06";


$storeData = getTimes($conn,$startDate,$endDate); //周
$storeDataMonth = getTimes($conn,"2020-08-24","2020-09-06"); //月
$storeDataYear = getTimes($conn,"2019-12-30","2020-09-06"); //年

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
$localSavePath = 'C:\Users\dell\Documents\WeChat Files\wxid_d08ggs33daje21\FileStorage\File\2020-09\员工角色0909.xlsx';
$format = array('员工编号'=>'user_login','姓名'=>'name','Store NO.'=>'store_id',
   '花名册角色'=>'role_hua','对应系统角色'=>'role','手机号码'=>'phone','登记次数'=>'dj_nums','登记人数'=>'dj_persons','核销次数'=>'hx_nums'
);
$data = $excel->import($format, $localSavePath);


$needEp = array();
foreach ($data as $v){
    $needEp[$v['store_id']]['data'][] = $v; //数据
    if(!isset($needEp[$v['store_id']]['times']))$needEp[$v['store_id']]['times']=0; //如果没有就0
    if(!empty($v['phone'])&&$v['role']=="BA"){   //分配次数 有号码并且是BA
        $needEp[$v['store_id']]['times'] = ++$needEp[$v['store_id']]['times'];
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
    $dataArr[$k]['role_hua'] = $v['role_hua'];
    $dataArr[$k]['phone'] = $v['phone'];
    $dataArr[$k]['role'] = $v['role'];
    $dataArr[$k]['dj_nums'] = $v['dj_nums'];
    $dataArr[$k]['dj_persons'] = $v['dj_persons'];
    $dataArr[$k]['hx_nums'] = $v['hx_nums'];
    $dataArr[$k]['per_index'] = $index;
    if(!empty($dataArr[$k]['phone'])&&$v['role']=="BA"){
        $dataArr[$k]['weektimes'] = $per_arr[$index];
        $dataArr[$k]['monthtimes'] = $per_arr_month[$index];
        $dataArr[$k]['yeartimes'] = $per_arr_year[$index];
        $storeIndexAvg[$v['store_id']]['index']++;
    } else{
        $dataArr[$k]['weektimes'] = 0;
        $dataArr[$k]['monthtimes'] = 0;
        $dataArr[$k]['yeartimes'] = 0;
    }
}

$excel2 = new PHPExcelTools();
//$i=0;
$fileName2 = "{$startDate}-{$endDate}员工数据";
$headArr=array('user_login'=>'员工编号','name'=>'姓名',
   'store_id'=>'Store NO.','role_hua'=>'花名册角色','role'=>'对应系统角色',
    'phone'=>'手机号码','dj_nums'=>'登记次数','dj_persons'=>'登记人数','hx_nums'=>'核销次数','weektimes'=>'周预约次数',
    'monthtimes'=>'月预约次数','yeartimes'=>'年预约次数');
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