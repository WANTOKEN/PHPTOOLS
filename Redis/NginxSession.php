<?php
session_start();

//存入session
$_SESSION['class'] = array('name'=>'toef1','num'=>8);

//连接redis

echo "local".PHP_EOL;
//检查session_id
echo 'session_id:' . session_id().'<br/>';

//php获取session值
echo 'php_session：'.json_encode($_SESSION['class']);

echo 'php_session：'.json_encode($_SESSION);

//redis存入色session(redis用session_id作为key，以string的形式存储)
