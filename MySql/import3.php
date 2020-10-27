<?php

//http://www.ztk.com/MySql/import3.php
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
//$localSavePath = 'C:\Users\dell\Documents\WeChat Files\wxid_d08ggs33daje21\FileStorage\File\2020-08\电商活动客户预约0811-v1(1).xlsx';
//$localSavePath = 'C:\Users\dell\Documents\WeChat Files\wxid_d08ggs33daje21\FileStorage\File\2020-08\电商活动客户预约0811-v1.xlsx';
//$localSavePath = 'C:\Users\dell\Documents\WeChat Files\wxid_d08ggs33daje21\FileStorage\File\2020-08\电商活动客户预约0811.xlsx';
//$localSavePath = 'C:\Users\dell\Documents\WeChat Files\wxid_d08ggs33daje21\FileStorage\File\2020-08\电商活动客户预约模板(1).xlsx';
//$localSavePath = 'H:\工作\因赛工作\睿致肌\电商活动客户预约模板.xlsx';
$format = array('预约ID'=>'id','门店ID'=>'store_id','日期'=>'date','开始时间'=>'start_time','结束时间'=>'end_time','电商预约'=>'is_order');
//$data = $excel->import($format, $localSavePath);
$SQLTEXT = "";
$ERRORTEXT = "";
$BACKUPTEXT = "";
$TIPTEXT = ""; //提示信息
$errorData = array();
$data=array(
    822310



);
foreach ($data as $v){

//    $id = $v['id'];
    $id = $v;
    $sql="SELECT * FROM rzj_store.cmf_reservation where `id` = :id ;";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id' => $id));
    $res = $stmt->rowCount();
    $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($res){
        $status = $resultData[0]['status'];
        if($status==0){
            $SQLTEXT .= "update cmf_reservation set status = '1',type='1' where id= '{$id}';\n ";
            $BACKUPTEXT .= "update cmf_reservation set status = '{$status}',type='0' where id= '{$id}';\n ";
        }else{
            $ERRORTEXT .= "update cmf_reservation set status = '1',type='1' where id= '{$id}';\n ";
            $errorData[]=$v;
            $TIPTEXT .= "存在冲突数据{$id}".PHP_EOL;
        }
    }else{
        $ERRORTEXT .= "update cmf_reservation set status = '1',type='1' where id= '{$id}';\n ";
        $errorData[]=$resultData[0];
        $TIPTEXT .="不存在数据{$id}".PHP_EOL;
    }
}

echo $ERRORTEXT.PHP_EOL;
$VERSION = "v1";
$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA/import3_update'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLTEXT);//保存文件到指定路径

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA/import3_backup'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $BACKUPTEXT);//保存文件到指定路径

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA/import3_error'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $ERRORTEXT);//保存文件到指定路径

if(!empty($TIPTEXT)){
    $excel2 = new PHPExcelTools();
    $fileName = "未预约成功数据表".date('Y-m-d H:i:s');
    $headArr=array('id'=>'预约ID','store_id'=>'门店ID','date'=>'日期','start_time'=>'开始时间','end_time'=>'结束时间','is_order'=>'电商预约');
    $excel2->exportBrowser($fileName,$headArr,$errorData);
}
$conn = null;
