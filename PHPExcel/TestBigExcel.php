<?php

//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//
//function convert($size)
//{
//    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
//    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
//}
//
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=xxxxxxxxx.csv');
header('Cache-Control: max-age=0');

//set_time_limit(0);   // 设置脚本最大执行时间 为0
//ini_set('memory_limit','200M');    // 临时设置最大内存占用

//关闭缓冲区
$flag = ob_end_clean();
if (!$flag) {
    die("关闭缓冲区错误");
}
//
//$startTime = microtime(true);

//$status = ob_get_status();
//file_put_contents("11.log", var_export($status, 1).PHP_EOL, 8);

// 打开PHP文件句柄，php://output 表示直接输出到浏览器
$fp = fopen('php://output', 'a');

$column_name = ["XXX", "XXX", "XXX", "XXX", "XXX", "XXX", "XXX", "XXX", "XXX", "XXX"];
// 将中文标题转换编码，否则乱码
foreach ($column_name as $i => $v) {
    $column_name[$i] = iconv('utf-8', 'GBK', $v);
}

// 将标题名称通过fputcsv写到文件句柄
fputcsv($fp, $column_name);

$export_data = [];
for ($i = 0; $i < 10; $i++) {
    foreach (range(1, 100000) as $k => $v) {
        $export_data[] = [
            "XXX" . $v, "XXX" . $v, "XXX" . $v, "XXX" . $v, "XXX" . $v, "XXX" . $v, "XXX" . $v, "XXX" . $v, "XXX" . $v, "XXX" . $v
        ];
    }
    foreach ($export_data as $item) {
        $rows = array();
        foreach ($item as $export_obj) {
            $rows[] = iconv('utf-8', 'GBK', $export_obj);
        }
        fputcsv($fp, $rows);
    }

    $export_data = []; //重新复制，释放掉旧数据
}
fclose($fp);
//
//$endTime = microtime(true);
//$memoryUse = memory_get_usage();
//
//file_put_contents("12.log", "内存占用：" . convert($memoryUse) . "; 用时：" . ($endTime - $startTime) . PHP_EOL, 8);
//
//exit(0);