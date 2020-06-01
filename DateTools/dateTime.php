<?php
date_default_timezone_set('Asia/Shanghai');
$str = "2020-06-30 23:59:59";
$time = strtotime($str);
echo $time.PHP_EOL;//1593532799
$str = "2020-05-31 23:59:59";
$time = strtotime($str);
echo $time.PHP_EOL;//1590940799
$str = "2020-06-01 23:59:59";
$time = strtotime($str);
echo $time;//1591027199

//729169


