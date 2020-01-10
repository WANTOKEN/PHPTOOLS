<?php

class RedisTest
{
    private $redis = null;

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1', 6379);
        $this->redis->auth('123456');
    }

    public function showKeys()
    {
        return $this->redis->keys('*');
    }

    public function createTestCache($events, $daysAgo = 0)
    {
        foreach ($events as $event) {
            $cacheKey[] = 'vfly:log:' . date("Ymd", strtotime("-{$daysAgo} days")) . ":" . $event;
        }
        $redis = $this->redis;
        foreach ($cacheKey as $i => $key) {
            $redis->zIncrBy($key, 1, 1);
            $redis->zIncrBy($key, 1, 2);
            $redis->zIncrBy($key, 1, 13);
            $redis->zIncrBy($key, 1, 4);
        }
        $redis->close();
    }

    public function getCommonCacheByEvents($events, $daysAgo = 0)
    {
        foreach ($events as $event) {
            $cacheKey[] = 'vfly:log:' . date("Ymd", strtotime("-{$daysAgo} days")) . ":" . $event;
        }
        $redis = $this->redis;
        // 每个实例都去获取一次
        $curValues = [];
        //根据key获取多个redis数据
        foreach ($cacheKey as $i => $key) {
            $redisOneData = $redis->zRange($key, 0, -1, true);//每个redis的data
            $curValues[$i] = isset($curValues[$i]) ? $curValues[$i] : [];
            $curValues[$i] = $this->arrayAdd($curValues[$i], $redisOneData);//合并
        }
        $conf = $curValues;
        return $conf;
    }
    private function arrayAdd($arr1, $arr2)
    {
        if(empty($arr1)) return $arr2;
        foreach ($arr2 as $key => $value) {
            if (!array_key_exists($key, $arr1)) {
                $arr1[$key] = $value;
            } else {
                $arr1[$key] += $value;
            }
        }
        return $arr1;
    }
}

$redisTest = new RedisTest();
//$events=['ImageEditorBgUse'];
//$redisTest->createTestCache($events);
//print_r($redisTest->showKeys());
//$events=['ImageEditorStickerUse'];
//$redisTest->createTestCache($events);
print_r($redisTest->showKeys());
$events=['ImageEditorBgUse'];
print_r($redisTest->getCommonCacheByEvents($events));