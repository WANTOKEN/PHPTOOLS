<?php

class ArrayMerge
{
    /**
     * 根据相同键名合并，统计键值
     */
    function arrayMergeCountValue($arr1, $arr2)
    {
        if (empty($arr1)) return $arr2;//如果数组1为空则返回数组2
        foreach ($arr2 as $k => $val) {
            //判断$k是否存在于$arr1中
            if (key_exists($k, $arr1)) {
                $arr1[$k] += $val;
            } else {
                $arr1[$k] = $val;
            }
        }
        return $arr1;
    }
}
$arr1 = [0 => 1, 3 => 2];
$arr2 = [2 => 5, 3 => 1];
$arrayMerge = new ArrayMerge();
$newArr = $arrayMerge->arrayMergeCountValue($arr1, $arr2);
var_dump($newArr);