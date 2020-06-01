<?php
include 'Lunar.class.php';

$lunar = new Lunar();
$birthday = '1996-2-1';
$birthdayData = preg_split('/[-]/', $birthday); //按-分割
$month = $lunar->convertSolarToLunar($birthdayData[0], $birthdayData[1],$birthdayData[2]);//将阳历转换为阴历
print_r($month);
$birthdayTime = strtotime($birthday);
$birthdayText = date("Y年m月d日");
$sx = getYearZodiac($month);
$lunarBirthday = getLunarBirthday($month);
$leftBirthDays = getBirthDayDays($birthday);
$liveDays = getLiveDays($birthday);
$week = getWeek($birthday);
$year = getYear($birthday);
$star = getStar($birthday);
echo "周岁：{$year[0]}|虚岁：{$year[1]}|生肖：{$sx}|农历生日：{$lunarBirthday}|农历生日：{$lunarBirthday}|公历生日:{$birthdayText}|距离生日：{$leftBirthDays}|存活天数：{$liveDays}||那天是：星期{$week}|星座:{$star}" . PHP_EOL;
$date = [];
$small = [4,6,9,11];
for($i=1;$i<=12;$i++){
    if($i==2){
        for($j=1;$j<=29;$j++){
            $date[]=$i."月".$j."日";
        }
    }elseif (key_exists($i,$small)){
        for($j=1;$j<=30;$j++){
            $date[]=$i."月".$j."日";
        }
    }else{
        for($j=1;$j<=31;$j++){
            $date[]=$i."月".$j."日";
        }
    }
}
//var_dump($date);
function getYearZodiac($data)
{ //获取生肖
    return $data[6];
}

function getLunarBirthday($data)
{
    return "{$data[0]}年{$data[1]}{$data[2]}";
}

function getBirthDayDays($birthday)//计算天数
{
    //今天的时间戳
    $today = time();
    //将生日转为今年
    $year = date("Y", $today);//年
    $birthdayThisYear = $year . substr($birthday, 4);//今年生日
    $birthdayThisYearTime = strtotime($birthdayThisYear);
    $time1 = intval($birthdayThisYearTime);
    $time2 = intval($today);
    if ($time1 >= $time2) {//还没过
        $leftTime = ($time1 - $time2);
    } else {//过了
        $aYear = strtotime("+12 Months");//明年
        $aYearTime = intval($aYear);
        $leftTime = ($aYearTime - $time1);
    }
    $leftDays = ceil($leftTime / (24 * 3600));
    return $leftDays;
}

function getLiveDays($birthday)//计算存活天数
{
    //今天的时间戳
    $today = time();
    $birthdayTime = strtotime($birthday);
    $time1 = intval($birthdayTime);
    $time2 = intval($today);
    $leftTime = ($time2 - $time1);
    $leftDays = ceil($leftTime / (24 * 3600));
    return $leftDays;
}

function getWeek($birthday)
{//获取星期几
    $birthdayTime = strtotime($birthday);
    $weekarray = array("日", "一", "二", "三", "四", "五", "六");
    return $weekarray[date("w", $birthdayTime)];
}

function getYear($birthday)
{
    $birthdayTime = strtotime($birthday);
    $year = [getAgeByBirth($birthdayTime, 2), getAgeByBirth($birthdayTime, 1)];
    return $year;
}

function getStar($birthday){
    $data = preg_split('/[-]/', $birthday); //按-分割
    return getXingzuo($data[1], $data[2]);
}
/**
 * $date是时间戳
 * $type为1的时候是虚岁,2的时候是周岁
 */
function getAgeByBirth($date, $type = 1)
{
    $nowYear = date("Y", time());
    $nowMonth = date("m", time());
    $nowDay = date("d", time());
    $birthYear = date("Y", $date);
    $birthMonth = date("m", $date);
    $birthDay = date("d", $date);
    if ($type == 1) {
        $age = $nowYear - ($birthYear - 1);
    } else if ($type == 2) {
        if ($nowMonth < $birthMonth) {
            $age = $nowYear - $birthYear - 1;
        } elseif ($nowMonth == $birthMonth) {
            if ($nowDay < $birthDay) {
                $age = $nowYear - $birthYear - 1;
            } else {
                $age = $nowYear - $birthYear;
            }
        } else {
            $age = $nowYear - $birthYear;
        }
    }
    return intval($age);
}

/**
 * 获取星座
 * @param $month 阳历月份
 * @param $day 阳历日期
 * @return string
 */
function getXingzuo($month, $day)
{
    $xingzuo = '';
    // 检查参数有效性
    if ($month < 1 || $month > 12 || $day < 1 || $day > 31) {
        return $xingzuo;
    }
    if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
        $xingzuo = "水瓶";
    } else if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
        $xingzuo = "双鱼";
    } else if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
        $xingzuo = "白羊";
    } else if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
        $xingzuo = "金牛";
    } else if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) {
        $xingzuo = "双子";
    } else if (($month == 6 && $day >= 22) || ($month == 7 && $day <= 22)) {
        $xingzuo = "巨蟹";
    } else if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
        $xingzuo = "狮子";
    } else if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
        $xingzuo = "处女";
    } else if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) {
        $xingzuo = "天秤";
    } else if (($month == 10 && $day >= 24) || ($month == 11 && $day <= 22)) {
        $xingzuo = "天蝎";
    } else if (($month == 11 && $day >= 23) || ($month == 12 && $day <= 21)) {
        $xingzuo = "射手";
    } else if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
        $xingzuo = "摩羯";
    }

    return $xingzuo."座";
}