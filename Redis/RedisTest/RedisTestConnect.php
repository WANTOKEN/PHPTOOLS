<?php

//连接本地的 Redis 服务
$redis = new \Redis();
$redis->connect('175.24.28.241', 6379);
$redis->auth('123456');
echo "Connection to server sucessfully";
//查看服务是否运行
echo "Server is running: " . $redis->ping();