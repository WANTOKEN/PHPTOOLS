<?php

$servername = "127.0.0.1";
$username = "root";
$password = "123456";
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "连接成功";
} catch (PDOException $e) {
    echo $e->getMessage();
}

$sql1 = "select t1.reservation_id,t1.status,t2.date from  rzj_store.cmf_reservation_order t1 LEFT JOIN rzj_store.cmf_reservation t2 on 
t1.reservation_id=t2.id where t1.status='0' and t2.date<='2020-06-29';";


$stmt = $conn->prepare($sql1);
$stmt->execute();
// 设置结果集为关联数组
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单

var_dump($data);



$conn = null;



