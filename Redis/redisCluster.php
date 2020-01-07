<?php
require 'predis/autoload.php';//引入predis相关包
//redis实例
$servers = array(
    'tcp://192.168.226.135:7001',
    'tcp://192.168.226.135:7002',
    'tcp://192.168.226.135:7003',
    'tcp://192.168.226.135:7004',
    'tcp://192.168.226.135:7005',
    'tcp://192.168.226.135:7006',
);

$client = new Predis\Client($servers, array('cluster' => 'redis'));

$client->set("name1", "11");
$client->set("name2", "22");
$client->set("name3", "33");

$name1 = $client->get('name1');
$name2 = $client->get('name2');
$name3 = $client->get('name3');
var_dump($name1, $name2, $name3);
