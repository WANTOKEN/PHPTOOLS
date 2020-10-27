<?php
//http://www.ztk.com/MySql/exportUser.php
set_time_limit(0);
ini_set('memory_limit','3096M');
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "连接成功";
} catch (PDOException $e) {
    echo $e->getMessage();
}


$sql2 = "select name,phone,sex,country,province,city from rzj.wp_auth_list;";
$stmt = $conn->prepare($sql2);
$stmt->execute();
// 设置结果集为关联数组
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sexConf = array('1'=>'男','2'=>'女');
$real_sexConf = array('0'=>'未知','1'=>'男','2'=>'女');

foreach ($data as &$v){
    $v['sex'] = $sexConf[$v['sex']];

}

$result = $data;
//var_dump($result);
$excel = new PHPExcelTools();
$fileName = "顾客信息表";
$headArr=array('name'=>'顾客姓名','phone'=>'联系电话',
    'sex'=>'性别','country'=>'国家','province'=>'省份','city'=>'城市',

    );
$excel->exportCSV($fileName,$headArr,$result);
$conn = null;



