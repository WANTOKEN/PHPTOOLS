<?php

/**
 * 读取本地数据，生成php数据样本
 */
class readTxt
{
    private $model;
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
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
            $strLine =str_replace(array("\r\n", "\r", "\n"), "", $strPre);
            $InputText .= $strLine."\n";
        }
        $InputText = rtrim($InputText, ',');
        $InputText .= "];";

        //保存在当前目录下的data.php中
        $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/data.php';
        file_put_contents($filename, $InputText);//保存文件到指定路径
    }
}

$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/data.log';
$test = new readTxt($file);
$test->read();