<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/6/1
 * Time: 16:27
 */
$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/name.log';
$path=$file;
$fileSplHandle = new \SplFileObject($path);
$InputText = "";
foreach ($fileSplHandle as $lineNum => $line) {
    $strLine = str_replace(array("\r\n", "\r", "\n"), "", $line);
//    $strText = "UPDATE cmf_exchange_log set times=0 WHERE photo_path='{$strLine}';";
    $strText="'".$strLine."'";
    $InputText.=$strText.',';
//   echo $strLine.PHP_EOL;
}
echo $InputText;

//保存在当前目录下的data.php中
$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/namesql.sql';
file_put_contents($filename, $InputText);//保存文件到指定路径
//SELECT * FROM cmf_exchange_log WHERE photo_path='./upload/2020-02-12/5e437ee349933.jpg';
//UPDATE cmf_exchange_log set times=0 WHERE photo_path='./upload/2020-02-12/5e437ee349933.jpg';