<?php

require 'Model.php';

$GLOBALS['mysql'] = array(
    'MYSQL_DB' => 'jsyl',
    'MYSQL_HOST' => 'localhost',
    'MYSQL_PORT' => 3306,
    'MYSQL_USER' => 'root',
    'MYSQL_PASS' => '123456',
    'MYSQL_CHARSET' => 'utf8mb4'
);
//$db = new Model();
//$data = $db->query('select * from users;');
//var_dump($data);

function appendDbDoc($table,$title)
{
    $db = new Model();
    $sql = "SELECT COLUMN_NAME AS 字段,COLUMN_TYPE AS 类型,
(CASE
WHEN IS_NULLABLE = 'YES' THEN
'是'
ELSE
'否'
END
) AS 是否为空,
COLUMN_COMMENT AS 字段描述
FROM information_schema.`COLUMNS` WHERE TABLE_NAME = ('{$table}')";
    $data = $db->query($sql);

    $InputText = "{$title} \n\n";
    $InputText .= "| 字段        | 类型     | 是否为空         | 字段描述        | \n";
    $InputText .= "| ----------- | ------------ | --------- | ------------- | \n";
    foreach ($data as $k => $v) {
        $InputText .= "| {$v['字段']}        | {$v['类型']}     | {$v['是否为空']}         | {$v['字段描述']}       | \n";
    }
    $InputText .= "\n\n";
//保存在当前目录下的data.php中
    $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/jsyl.md';
    file_put_contents($filename, $InputText, FILE_APPEND);//保存文件到指定路径
}
$conf = array(
    array('table'=>'jsyl_banner','name'=>'banner表'),
    array('table'=>'jsyl_logo','name'=>'logo表'),
    array('table'=>'jsyl_advertisement','name'=>'广告位表'),
    array('table'=>'jsyl_news','name'=>'新闻表'),
    array('table'=>'jsyl_goods','name'=>'商品表'),
    array('table'=>'jsyl_limit_goods','name'=>'限时商品表'),
    array('table'=>'jsyl_goods_type','name'=>'商品专区分类表'),
    array('table'=>'jsyl_limit_goods','name'=>'校园动态与新闻表'),
    array('table'=>'jsyl_goods_kind','name'=>'商品专种类分类表'),
    array('table'=>'jsyl_orders','name'=>'采购订单表'),
    array('table'=>'jsyl_special_area','name'=>'供需专区表'),
    array('table'=>'jsyl_contact','name'=>'联系信息表'),
    array('table'=>'jsyl_files','name'=>'文件表'),
);

foreach ($conf as $k=>$v){
    $table = $v['table'];
    $name=($k+1).".{$v['name']} {$table}";
    $title="##### {$name}";
    appendDbDoc($table,$title);
}

