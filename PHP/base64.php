<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/10/19
 * Time: 18:36
 */

function base64($str)
{
    $res = $str == base64_encode(base64_decode($str)) ?  base64_decode($str) : $str;
    return  $res;
}
$str = 'aHR0cDovL3J6anN0b3JlLmludGVjaC5nZGluc2lnaHQuY29tL2luZGV4LnBocD9nPXN0b3JlJm09cmVzZXJ2YXRpb24mYT12ZXJpZmljYXRpb25fbGlzdHM=';
//$str = 'http://rzjstore.intech.gdinsight.com/index.php?g=store&m=reservation&a=verification_lists';
echo base64($str).PHP_EOL;