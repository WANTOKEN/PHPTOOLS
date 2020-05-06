<?php

function lengthOfLongestSubstring($s){
    $maxLen = 0; // 最长的长度

    $tempStr = ''; // 临时队列
    $strlen = strlen($s);
    $tempStrLen = 0; // 临时队列的长度

    for ($i = 0; $i< $strlen; $i++) { // 遍历字符串取出单个字符
        $key = strpos($tempStr, $s[$i]); // 获取临时队列中已存在的该字符的下标
        $tempStr .= $s[$i]; // 拼接进队列
        if ($key === false) { // 临时队列中不存在该字符
            $tempStrLen++; // 临时长度变长
            $maxLen=$tempStrLen>$maxLen?$tempStrLen:$maxLen;
        } else {
            $tempStr = substr($tempStr, $key+1);
            $tempStrLen = strlen($tempStr);
        }

    }
    return $maxLen;
}

$s = "abcadsada";
$num = lengthOfLongestSubstring($s);
echo $num;