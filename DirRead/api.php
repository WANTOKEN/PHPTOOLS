<?php
$cmd = "sudo /usr/bin/php  /mnt/project/php/test/makedir.php";
$ret = shell_exec($cmd);
var_dump($ret);

