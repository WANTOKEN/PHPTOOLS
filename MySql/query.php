<?php

require 'Model.php';
class query{

}
$GLOBALS['mysql']=array(
    'MYSQL_DB'=>'test',
    'MYSQL_HOST'=>'localhost',
    'MYSQL_PORT'=>3306,
    'MYSQL_USER'=>'root',
    'MYSQL_PASS'=>'123456',
    'MYSQL_CHARSET'=>'utf8mb4'
);
$db = new Model();
$data = $db->query('select * from users;');
var_dump($data);
