<?php

/**
 * 读取本地数据，生成php数据样本
 */
class readTxt
{
    private $file;
    private $charset;

    public function __construct($file)
    {
        $this->file = $file;
        $this->charset = 'utf-8';
    }

    function read()
    {
        $path = $this->file;
        $fileSplHandle = new \SplFileObject($path);
        $InputText = "<?php \n \$data = [";
        foreach ($fileSplHandle as $lineNum => $line) {
            $curLine = explode("	", $line);
            $curLine = array_filter($curLine);
            $preFix = $curLine[0];
            $strPre = "'$preFix'=>[";
            for ($i = 1; $i < count($curLine); $i++) {
                $strPre .= "'" . $curLine[$i] . "',";
            }
            $strPre = rtrim($strPre, ',');
            $strPre .= '],';//一行
            $strLine = str_replace(array("\r\n", "\r", "\n"), "", $strPre);
            $InputText .= $strLine . "\n";
        }
        $InputText = rtrim($InputText, ',');
        $InputText .= "];";

        //保存在当前目录下的data.php中
        $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/data.php';
        file_put_contents($filename, $InputText);//保存文件到指定路径
    }

    function writeChengYu($filename)
    {
        $InputText = '';
        $path = $this->file;
        $fileSplHandle = new \SplFileObject($path);
        foreach ($fileSplHandle as $lineNum => $line) {
            $strLine = str_replace(array("\r\n", "\r", "\n"), "", $line);
            $curStr = trim($strLine);
            $strLen = mb_strlen($curStr);
            if ($strLen == 4) {
                $InputText .= $curStr . ',';
            }
        }
        file_put_contents($filename, $InputText);//保存文件到指定路径
    }

    function readChengYu($filename)
    {
        //$str = '1.jpg@2.jpg#3,jpg';
        //$files = preg_split('/[@#]/',$str);
        //var_dump($files);
        $data = file_get_contents($filename);
        $data = preg_split('/[,]/', $data); //按，分割
        //var_dump($data);
        $word = "";
        //var_dump(preg_grep("/$word/i",$data));
        $pat_array = preg_grep("/$word/i", $data); //匹配放入数组
        var_dump($pat_array[0]);
    }
}

$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/chengyu.txt';
$test = new readTxt($file);

$test->readChengYu($file);



