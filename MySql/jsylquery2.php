<?php

require 'Model.php';
$GLOBALS['mysql'] = array(
    'MYSQL_DB' => 'rzj',
    'MYSQL_HOST' => '118.190.41.120',
    'MYSQL_PORT' => 3306,
    'MYSQL_USER' => 'insight',
    'MYSQL_PASS' => 'insight0.123',
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
    $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/睿致肌2.md';
    file_put_contents($filename, $InputText, FILE_APPEND);//保存文件到指定路径
}
$conf = array(
    array('table'=>'wp_auth_list','name'=>'用户信息表'),
);

foreach ($conf as $k=>$v){
    $table = $v['table'];
    $name=($k+1).".{$v['name']} {$table}";
    $title="##### {$name}";
    appendDbDoc($table,$title);
}

