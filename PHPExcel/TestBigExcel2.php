<?php

function exportCSV($fileName, $headerArr, $dataArr)
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=' . iconv('utf-8', 'utf-8', $fileName) . '.csv');
    header('Cache-Control: max-age=0');
    $flag = ob_end_clean();
    if (!$flag) {
        die("关闭缓冲区错误");
    }
    $fp = fopen('php://output', 'a');
    foreach ($headerArr as $i => $v) {
        $headerArr[$i] = iconv('utf-8', 'utf-8', $v);
    }
    fputcsv($fp, $headerArr);
    foreach ($dataArr as $item) {
        $rows = array();
        foreach ($item as $exportObj) {
            $rows[] = iconv('utf-8', 'utf-8', $exportObj);
        }
        fputcsv($fp, $rows);
    }
    fclose($fp);
}
$headerArr = ["title1" => "测试e1", "title2" => "title2",
    "title3" => "title3", "title4" => "title4", "title5" => "title5",
    "title6" => "title6", "title7" => "title7", "title8" => "title8",
    "title9" => "title9", "title10" => "title10"];
$headerArr = ['标题1','标题2','标题3','标题4','标题5','标题6','标题7','标题8','标题9','标题10','标题11','标题12'];
$dataArr = [];
$col = "数据";
foreach (range(1, 300000) as $k => $v) {
//    $dataArr[] = [
//        "title1" => "X测试XX" . $v, "title2" => "XXX" . $v, "title3" => "X测试XX" . $v,
//        "title4" => "XXX" . $v, "title5" => "XXX" . $v, "title6" => "XXX" . $v,
//        "title7" => "XXX" . $v, "title8" => "XXX" . $v, "title9" => "XXX" . $v,
//        "title10" => "XXX" . $v
//    ];
    $dataArr[] = [$col.$v,$col.$v,$col.$v,$col.$v,$col.$v,$col.$v,$col.$v,$col.$v,$col.$v,$col.$v,$col.$v,$col.$v];
}
$fileName = '测试excel';
//exportCSV($fileName, $headerArr, $dataArr);
function getCsvHandler($fileName, $headerArr){
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=' . iconv('utf-8', 'utf-8', $fileName) . '.csv');
    header('Cache-Control: max-age=0');
    $flag = ob_end_clean();
    if (!$flag) {
        die("关闭缓冲区错误");
    }
    $fp = fopen('php://output', 'a');
    foreach ($headerArr as $i => $v) {
        $headerArr[$i] = iconv('utf-8', 'utf-8', $v);
    }
    fputcsv($fp, $headerArr);
    return $fp;
}
$fp = getCsvHandler($fileName, $headerArr);
    foreach ($dataArr as $item) {
//        $rows = array();
//        foreach ($item as $exportObj) {
//            $rows[] = iconv('utf-8', 'utf-8', $exportObj);
//        }
        fputcsv($fp, $item);
    }
fclose($fp);