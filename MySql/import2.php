<?php
//每周一导出数据
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}
$excel = new PHPExcelTools();
$localSavePath = 'H:\工作\因赛工作\睿致肌\睿致肌-门店导入20200826.xlsx';
$format = array('门店名称'=>'name','门店ID'=>'store_id','省'=>'province','市'=>'city','地址'=>'address','联系电话'=>'contact','SPA 是否已开始营业'=>'is_open');
$data = $excel->import($format, $localSavePath);

foreach ($data as &$v){
    $pro_key = $v['province'];
    $sql = "select id,name from rzj_store.cmf_province WHERE name like '$pro_key%' limit 1;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
// 设置结果集为关联数组
    $province_resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $v['province_str'] = $province_resultData[0]['name'];
    $v['province_id'] = $province_resultData[0]['id'];

    $city_key = $v['city'];
    $sql2 = "select id,name from rzj_store.cmf_city WHERE name like '$city_key%' limit 1;";
    $stmt = $conn->prepare($sql2);
    $stmt->execute();
// 设置结果集为关联数组
    $city_resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $v['city_str'] = $city_resultData[0]['name'];
    $v['city_id'] = $city_resultData[0]['id'];

}
$bigData = array_chunk($data, 100, true);

//$i=0;
//foreach ($bigData as $vdata){
//    $excelb = new PHPExcelTools();
//    $fileName = "导入门店".$i;
//    $headArr=array('name'=>'门店名称','store_id'=>'门店ID','province_str'=>'省','city_str'=>'市','address'=>'地址','contact'=>'联系电话','is_open'=>'SPA 是否已开始营业');
//    $excelb->exportBrowser($fileName,$headArr,$vdata);
//    $i++;
//}
$fileName = "导入门店";
$headArr=array('name'=>'门店名称','store_id'=>'门店ID','province_str'=>'省','city_str'=>'市','address'=>'地址','contact'=>'联系电话','is_open'=>'SPA 是否已开始营业');
$excel->exportBrowser($fileName,$headArr,$data);



