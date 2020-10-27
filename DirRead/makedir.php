<?php
//$log_date = date("YmdHis").time();
//$save_path =  dirname(__FILE__). DIRECTORY_SEPARATOR.date("Ymd").DIRECTORY_SEPARATOR;
//if(!is_dir($save_path)){
//    $path = $save_path;
//    $res=mkdir($path,0777,true);
//    if ($res){
//        echo "目录 $path 创建成功";
//    }else{
//        echo "目录 $path 创建失败";
//    }
//}
//chmod($save_path, 0777);


$shell = "sh /mnt/project/automation/automation.sh  master https://caikaijun%40gdinsight.com:abc123456@gitlab.gdinsight.com/caikaijun/txhappyteahouse.git txhappyteahouse txhappyteahousemaster";
//$shell = "ls -la";
echo "<pre>";
system($shell, $status);
echo "</pre>";
//注意shell命令的执行结果和执行返回的状态值的对应关系
$shell = "<font color='red'>$shell</font>";
if( $status ){
    echo "shell命令{$shell}执行失败";
} else {
    echo "shell命令{$shell}成功执行";
}
