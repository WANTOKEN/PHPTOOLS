<?php

require 'Model.php';

class cmysquery
{

}

$GLOBALS['mysql'] = array(
    'MYSQL_DB' => 'cmys',
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
    $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/sql.md';
    file_put_contents($filename, $InputText, FILE_APPEND);//保存文件到指定路径
}
$conf = array(
    array('table'=>'cmys_banner','name'=>'轮播图表'),
    array('table'=>'cmys_headmaster','name'=>'校长寄语表'),
    array('table'=>'cmys_about','name'=>'关于内容表'),
    array('table'=>'cmys_teacher','name'=>'辰美师资表'),
    array('table'=>'cmys_college','name'=>'学院表'),
    array('table'=>'cmys_tsystem','name'=>'教学体系内容表'),
    array('table'=>'cmys_news','name'=>'校园动态与新闻表'),
    array('table'=>'cmys_calendar','name'=>'校历表'),
    array('table'=>'cmys_video','name'=>'辰美电视台表'),
    array('table'=>'cmys_service','name'=>'升学服务内容表'),
    array('table'=>'cmys_college_overseas','name'=>'国外艺术学院表'),
    array('table'=>'cmys_story','name'=>'辰美故事表'),
    array('table'=>'cmys_studentpage','name'=>'招生信息内容表'),
    array('table'=>'cmys_linkwe','name'=>'联系我们内容表'),
);

foreach ($conf as $k=>$v){
    $table = $v['table'];
    $name=($k+1).".{$v['name']} {$table}";
    $title="##### {$name}";
    appendDbDoc($table,$title);
}
