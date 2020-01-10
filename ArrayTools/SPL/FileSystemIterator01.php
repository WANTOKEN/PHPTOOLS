<?php
date_default_timezone_set('PRC');
$it = new FilesystemIterator('.');//.当前目录
foreach ($it as $finfo){
    printf("%s\t%s%\t%8s\t%s\n",
        date("Y-m-d H:i:s",$finfo->getMTime()),
    $finfo->isDir()?"<DIR>":"",
    number_format($finfo->getSize()),
    $finfo->getFileName());
//    echo date("Y-m-d H:i:s",$finfo->getMTime()).PHP_EOL;
}
