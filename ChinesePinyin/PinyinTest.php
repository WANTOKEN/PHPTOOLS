<?php
include 'ChinesePinyin.class.php';

$Pinyin = new ChinesePinyin();


//获取声调
function formatTone($pinyin)
{
    $replacements = array(
        'ā' => array('a', 1), 'ē' => array('e', 1), 'ī' => array('i', 1), 'ō' => array('o', 1), 'ū' => array('u', 1), 'ǖ' => array('yu', 1),
        'á' => array('a', 2), 'é' => array('e', 2), 'í' => array('i', 2), 'ó' => array('o', 2), 'ú' => array('u', 2), 'ǘ' => array('yu', 2),
        'ǎ' => array('a', 3), 'ě' => array('e', 3), 'ǐ' => array('i', 3), 'ǒ' => array('o', 3), 'ǔ' => array('u', 3), 'ǚ' => array('yu', 3),
        'à' => array('a', 4), 'è' => array('e', 4), 'ì' => array('i', 4), 'ò' => array('o', 4), 'ù' => array('u', 4), 'ǜ' => array('yu', 4),
    );
    foreach ($replacements as $unicode => $replacement) {
        if (false !== strpos($pinyin, $unicode)) {
            $umlaut = $replacement[0];
            if ('yu' == $umlaut) {
                $umlaut = 'v';
            }
            $pinyin = str_replace($unicode, $umlaut, $pinyin);
            $pinyin =preg_replace("/\s|　/","",$pinyin);
            $pinyin.=$replacement[1];

        }
    }
    return $pinyin;
}

//押韵处理
function formatYaYun($pinyin)
{
    $replacements = array(
        'yan' => 'ian',
        'ye' => 'ie'
    );
    foreach ($replacements as $unicode => $replacement) {
        if (false !== strpos($pinyin, $unicode)) { //找到
            echo $unicode . PHP_EOL;
            $pinyin = str_replace($unicode, $replacement, $pinyin);
        }
    }
    return $pinyin;
}
$words = [
    'a1' => ['今年大发', '一米七八', '帅到眼瞎'],
    'a2' => ['从不搞砸', '飞黄腾达'],
    'a3' => ['一点不傻', '放你一马'],
    'a4' => ['脾气火辣', '神通广大', '不想长大'],
    'ai1' => ['笑口常开', '玩到最嗨'],
    'ai2' => ['年年发财', '恭喜发财', '快乐肥宅'],
    'ai3' => ['一点不矮', '喜欢大海'],
    'ai4' => ['受人爱戴', '非常厉害', '没有眼袋'],
    'an1' => ['随遇而安', '是个憨憨', '天天搬砖', '很不一般', '平平安安'],
    'an2' => ['很有内涵', '色彩斑斓'],
    'an3' => ['可爱慵懒', '相见恨晚', '努力勤勉', '可攻可软'],
    'an4' => ['你真好看', '最爱吃饭', '好运不断'],
    'ang1' => ['幸福安康', '出口成章', '天下无双', '奔向小康'],
    'ang2' => ['可爱大王', '奶茶半糖', '非比寻常', '是个栋梁', '斗志昂扬'],
    'ang3' => ['性格开朗', '兵来将挡'],
    'ang4' => ['天天向上', '天天在浪'],
    'ao1' => ['还能长高', '唠唠叨叨', '响彻云霄'],
    'ao2' => ['远离疲劳', '永远逍遥', '名列前茅', '帅到炸毛', '特别能聊', '其乐陶陶'],
    'ao3' => ['每天吃饱', '不被打扰', '真不得了'],
    'ao4' => ['吉星高照', '什么都要', '出人意料', '花里胡哨', '出人意料'],
    'e1' => ['从不挂科', '喜欢呵呵', '刚正不阿'],
    'e2' => ['不惧阻隔', '所求必得', '天作之合'],
    'e3' => ['求贤若渴', '很不好惹'],
    'e4' => ['远离苦厄', '名声赫赫'],
    'ei1' => ['起早贪黑', '一笑微微'],
    'ei2' => ['暴跳如雷', '管你是谁', '稳赚不赔'],
    'ei3' => ['一直白给', '从不白给'],
    'ei4' => ['不再劳累', '射程之内'],
    'en1' => ['考试满分', '一往情深'],
    'en2' => ['满眼星辰', '不染灰尘', '不长皱纹'],
    'en3' => ['识明智审', '夜夜安枕'],
    'en4' => ['做事谨慎', '还是太嫩'],
    'eng1' => ['评上职称', '只瘦不增'],
    'eng2' => ['千载难逢', '持之以恒', '心想事成', '欧气爆棚', '可爱爆棚'],
    'eng3' => ['拒绝再等', '不会再冷'],
    'eng4' => ['做个好梦', '数钱用秤', '颜值超正'],
    'er' => ['说一不二', '数一数二'],
    'i1' => ['天下第一', '披上嫁衣'],
    'i2' => ['就是个谜', '寿比天齐'],
    'i3' => ['最爱是你', '爱护自己', '不讲道理'],
    'i4' => ['是个弟弟', '洪荒之力', '万事胜意'],
    'ian1' => ['敢为人先', '一马当先', '睡到明天', '往事如烟'],
    'ian2' => ['天天数钱', '有钱有闲', '为你代盐', '盛世美颜', '可盐可甜', '宇宙最甜'],
    'ian3' => ['远离危险', '瘦的明显', '被人锤扁'],
    'ian4' => ['七十二变', '让人思念', '奇迹出现', '需要锻炼'],
    'ie1' => ['从未停歇', '惊鸿一瞥'],
    'ie2' => ['有点特别', '天真无邪'],
    'ie3' => ['从不吃瘪', '经常撒野'],
    'ie4' => ['十分感谢', '坚持不懈', '拒绝熬夜'],
    'in1' => ['一诺千金', '人间福音'],
    'in2' => ['下雨不淋', '穿金戴银'],
    'in3' => ['让人上瘾', '可爱上瘾'],
    'in4' => ['财源广进', '努力上进'],
    'ing1' => ['喜欢嘤嘤', '耀眼明星'],
    'ing2' => ['收获爱情', '有点机灵'],
    'ing3' => ['天赋异禀', '总睡不醒'],
    'ing4' => ['从不生病', '从不信命'],
    'iu1' => ['从不罢休', '可爱小妞', '舍不得丢'],
    'iu2' => ['可爱一流', '技术一流'],
    'iu3' => ['寻花问柳', '长长久久'],
    'iu4' => ['一枝独秀', '有点恋旧', '六六六六'],
    'o1' => ['每天直播', '爱吃萝卜', '福气多多'],
    'o2' => ['好事多磨', '远离病魔', '爱吃菠萝'],
    'o3' => ['斜阳一抹', '一夜爆火'],
    'o4' => ['都是泡沫', '不再沉默'],
    'ong1' => ['各显神通', '情有独钟'],
    'ong2' => ['与众不同', '盖世英雄'],
    'ong3' => ['什么都懂', '向你靠拢'],
    'ong4' => ['怦然心动', '远离病痛'],
    'ou1' => ['品学兼优', '万事无忧'],
    'ou2' => ['吃喝不愁', '快乐出游'],
    'ou3' => ['什么都有', '精神抖擞', '最佳辩手'],
    'ou4' => ['无出其右', '特别的逗'],
    'u1' => ['掌上明珠', '说好不哭', '从不迷糊'],
    'u2' => ['永远舒服', '不再孤独', '制霸全服', '踏上征途', '从不迷糊'],
    'u3' => ['生活不苦', '春节质朴'],
    'u4' => ['喜欢装酷', '迟早暴富', '好运光顾', '加官进禄'],
    'ue1/ve1' => ['总有人约', '今晚有约'],
    'ue2/ve2' => ['加官进爵', '不想上学'],
    'ue3/ve3' => ['一起看雪', '肤白如雪'],
    'ue4/ve4' => ['脾气很倔', '一起赏月', '不断超越'],
    'ui1' => ['熠熠生辉', '从不吃亏'],
    'ui2' => ['百转千回', '百折不回'],
    'ui3' => ['从不后悔', '心中无悔'],
    'ui4' => ['机敏聪慧', '来年相会'],
    'un1' => ['漫步黄昏', '扭转乾坤'],
    'un2' => ['平步青云', '神秘难寻'],
    'un3' => ['偶尔犯蠢', '财源滚滚'],
    'un4' => ['一直很困', '懂得分寸'],
    'v1' => ['称霸全区', '正直不屈'],
    'v2' => ['年年有余', '不疾不徐'],
    'v3' => ['是个美女', '芳心暗许'],
    'v4' => ['有点焦虑', '增长积蓄']
];
//查询押韵返回关键词
function searchYaYunWords($pinyin,$words)
{
    $searchKey = '';
    foreach ($words as $key => $val) {
        if (false !== strpos($pinyin, $key)) { //找到
            echo "key：".$key . PHP_EOL;
            $keyLen = mb_strlen($key,'utf-8');
            $sKeyLen = mb_strlen($searchKey,'utf-8');
            $searchKey = $keyLen>$sKeyLen?$key:$searchKey;
        }
    }
    $keyWordKey = array_rand($words[$searchKey]);
    $keyWord = $words[$searchKey][$keyWordKey];
    echo "key：".$searchKey . PHP_EOL;
    echo "keyWord：".$keyWord . PHP_EOL;

}
$name = "严";
$result = $Pinyin->TransformWithTone($name);
echo $result.PHP_EOL;
$pinYinTone = formatTone($result);
echo $pinYinTone.PHP_EOL;
$pinYinYaYun = formatYaYun($pinYinTone);
echo "处理后押韵拼音:".$pinYinYaYun.PHP_EOL;
searchYaYunWords($pinYinYaYun,$words);
/**
yán
yan2
yan
处理后押韵拼音:ian2
key：an2
key：ian2
key：ian2
keyWord：盛世美颜

 */
