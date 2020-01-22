<?php
$Redis = new \Redis();
$Redis->connect('127.0.0.1', 6379);
$Redis->auth('123456');
//$keys =$Redis->keys('*');
//$key = "runoobkey";
////var_dump($keys);
////$data = $Redis->get($key);
////var_dump($data);

//$inputData2 = ['keyword1'=>"keywordValue",'country'=>"countryValue"];
//$Redis->sAdd($key,json_encode($inputData, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//$Redis->sAdd($key,json_encode($inputData2, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//$Redis->sAdd($key,"keys2");
//$Redis->sAdd($key,"keys1");
//$flag = $Redis->sAdd($key,"keys2");
//$data = $Redis->sMembers($key);
//$flag=$Redis->exec();
//var_dump($flag);
//$key = "vfly:search_material_keywords_list";
//$inputData = ['keyword'=>"keywordValue",'country'=>"countryValue"];
//$inputData=json_encode($inputData, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
//$inputData2 = ['keyword'=>"keywordValue2",'country'=>"countryValue2"];
//$inputData2=json_encode($inputData2, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
//$Redis->zIncrBy($key, 1, $inputData);
//$Redis->zIncrBy($key, 1, $inputData2);
//$data=$Redis->zRange($key, 0, -1, true);
////$data = $Redis->sMembers($key);
//var_dump($data);
//foreach ($data as $k=>$v){
////    $Redis->srem($key,$v);
//}
//$data2 = $Redis->sMembers($key);
//var_dump($data2);

//$key = "vfly:search_material_keywords_list";
//$inputData = ['keyword','country'];
//$inputData=json_encode($inputData, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
//$inputData2 = ['keyword1','country'];
//$inputData2=json_encode($inputData2, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
//$Redis->hIncrBy($key, $inputData, 1);
//$Redis->hIncrBy($key, $inputData2, 1);
//$data=$Redis->hGetAll($key);
////$data = $Redis->sMembers($key);
//var_dump($data);
//$Redis->hMSet($key,['keyword'=>'keywordValue2','country'=>'countryValue']);
//$Redis->hMSet($key,['keyword'=>'keywordValue2','country'=>'countryValue']);
//$Redis->hMSet($key,['keyword'=>'keywordValue','country'=>'countryValue']);
//$data = $Redis->hGetAll($key);
//$inputData="keyword|countryValue";
//$key2 = microtime(true).uniqid();
//$Redis->hSet($key,$key2,$inputData);
//$Redis->hGet($key,$key2);
//$data = $Redis->hGetAll($key);
//$it=null;
//$Redis->hScan($key,0,'MATCH','*');
//var_dump($it);

//$it=null;
//while($arr_keys = $Redis->hScan($key,$it)){
//   var_dump($it);
//    var_dump($arr_keys);
//}
//$it=null;
//$arr_keys = $Redis->hScan($key,$it);
//var_dump($arr_keys);
//foreach ($data as $k=>$val){
//    echo $k."||".$val.PHP_EOL;
//}

/* Without enabling Redis::SCAN_RETRY (default condition) */
//$redis=$Redis;
//$it = NULL;
//do {
//    // Scan for some keys
//    $arr_keys = $redis->scan($it);
//
//    // Redis may return empty results, so protect against that
//    if ($arr_keys !== FALSE) {
//        foreach($arr_keys as $str_key) {
//            echo "Here is a key: $str_key\n";
//        }
//    }
//} while ($it > 0);
//echo "No more keys to scan!\n";
//
///* With Redis::SCAN_RETRY enabled */
//$redis->setOption(Redis::OPT_SCAN, Redis::SCAN_RETRY);

//for($i=0;$i<10;$i++){
//    $inputData="keyword|countryValue";
//    $key2 = microtime(true).uniqid();
//    $Redis->hSet($key,$key2,$inputData);
////    $Redis->hGet($key,$key2);
//    $Redis->expire($key, 10); // 3天
//}
//$Redis = new \Redis();
//$Redis->connect('127.0.0.1', 6379);
//$Redis->auth('123456');
//$redis=$Redis;
//$key = "vfly:search_keywords_hash:";
//$key = $key.date('Ymd', time());
//echo $key;
//for($i=0;$i<10000;$i++){
//    $inputData="keyword"."|PK";
//    $key2 = microtime(true).uniqid();
////    $key2 = "aa".$i%10;
//    $Redis->hSet($key,$key2,$inputData);
////    $Redis->hGet($key,$key2);
////    $Redis->expire($key, 10); // 3天
//}
//$it = NULL;
//$i=0;
//while ($arr_keys = $redis->hScan($key,$it,'',1000)) {
//    foreach ($arr_keys as $k=>$str_key) {
//        echo "================$i=========================\n";
//        echo "Here is a key: $k\n";
//        echo "Here is a key: $str_key\n";
//        $arr = explode('|',$str_key);
////        var_dump($arr);
//        $i++;
//        $redis->hDel($key,$k);
//    }
//}
//echo "No more keys to scan!\n";
//$data = $Redis->hGetAll($key);
//var_dump($data);
//$date = date('Ymd');
//var_dump($date);
//$option=0;
//$theDay = date('Y-m-d', strtotime("-{$option} days"));
//$theDay = date('Y-m-d', time());
//var_dump($theDay);


$redis = new Redis();
var_dump($redis);
$redis->connect('127.0.0.1', 6379);
$key = "vfly:search_keywords_hash:";
$key = $key.date('Ymd', time());
$pipe = $redis->multi(Redis::PIPELINE);
for ($i = 0; $i < 200000; $i++) {
    $inputData="keyword"."|PK";
    $key2 = microtime(true).uniqid();
//    $redis->hSet($key, $i, $i);
    $redis->hSet($key, $key2, $inputData);
}
$curValues = $pipe->exec();

//$it = NULL;
//$i = 0;
//while ($curVal = $redis->hScan($key, $it, '', 10000)) {
//    echo $i . ' return val counts: ' . count($curVal) . PHP_EOL;
//    foreach ($curVal as $k => $v) {
////        $res = $redis->hDel($key, $k);
////        if ($res === false) echo 'del failed' . PHP_EOL;
//    }
//    $i++;
//}
//$it = NULL;
//echo "=============!" . PHP_EOL;
//while ($curVal = $redis->hScan($key, $it, '', 10)) {
//    echo $i . ' return val counts: ' . count($curVal) . PHP_EOL;
//    foreach ($curVal as $k => $v) {
////        $res = $redis->hDel($key, $k);
////        if ($res === false) echo 'del failed' . PHP_EOL;
//    }
//    $i++;
//}
echo "No more keys to scan!" . PHP_EOL;


$data = $redis->hGetAll($key);



