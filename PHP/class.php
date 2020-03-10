
<?php
$str = "welcome to leniu interview.";
echo  strpos($str, 'welcome');
if (false ==  strpos($str, 'welcome')) {
    echo 'No';
} else {
    echo 'Yes';
}
// 定义一个随机的数组
$a = array(23,15,43,25,54,2,6,82,11,5,21,32,65);

// 第一层可以理解为从数组中键为0开始循环到最后一个
for ($i = 0; $i < count($a) ; $i++) {
    for ($j = $i+1; $j < count($a); $j++) {
        if ($a[$i] > $a[$j]) {
            $tem = $a[$i];
            $a[$i] = $a[$j];
            $a[$j] = $tem;
        }
    }
}


var_dump($a);


$a = [1,3,15,8,20,2];
//1,3,15,8,20,2
//1,2,15,8,20,3
//1,2,3,15,20,8
//1,2,3,8,20,15
//1,2,3,8,15,20
for ($i = 0; $i < count($a) ; $i++) {
    for ($j = $i+1; $j < count($a); $j++) {
        if ($a[$i] > $a[$j]) {
            $temp = $a[$i];
            $a[$i] = $a[$j];
            $a[$j] = $temp;
        }
    }
    echo $i."=================".PHP_EOL;
    var_dump($a);
}
var_dump($a);

