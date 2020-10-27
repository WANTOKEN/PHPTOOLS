<?php
include '../PHPExcel/PHPExcelTools.php';

$excel = new PHPExcelTools();
$fileName = "6-22至6-28所有顾客被添加次数的累计情况";
$headArr=array('name'=>'姓名','phone'=>'手机号','openid'=>'openid',
    'times'=>'获得服务次数','小票地址'=>'小票地址','BA'=>'BA',
    'date'=>'获得服务日期','create_time'=>'具体时间');
$excel->export($fileName,$headArr,$result);
$conn = null;
//var_dump($result);


