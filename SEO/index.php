<?php
require 'head.php';
$valDescription = '前端入门,进阶总结记录,个人日志博客,分享web学习经验的小窝。';
$valKeywords = '金色摇篮关键词';
$valTitle = '金色摇篮标题';
$url = "http://www.jinseyaolang.io/api/jsyl/index/index";
$reqData=array();
$retData = curlData($url,$reqData,$method = 'GET');
$retDataArr = json_decode($retData,true);
$valKeywords = $retDataArr['data'];
var_dump($retDataArr);
?>


<meta name="description" content=" <?php echo $valDescription; ?> "/>
<meta name="keywords" content=" <?php echo htmlspecialchars($valKeywords); ?> "/>
<title><?php echo $valTitle; ?></title>
<body><?php echo $valKeywords; ?>




<div id="app">
    <p>{{ message }}<a href="index2.php">a</a></p>
</div>
</body>
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue.js!'
        }
    })
</script>
<script><></script>