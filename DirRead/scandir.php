<?php
class scandir{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    //扫描目录
    public function scan(){
        $path = $this->path;
        if(is_dir($path)){
            $dir = scandir($path);
            foreach ($dir as $value){
                $subPath = $path.'\\'.$value;
                if ($value=='.'||$value==".."){
                    continue;
                }elseif (is_dir($subPath)){//如果还是目录
                    $this->path=$subPath;
                    echo  "继续扫描：".$subPath.PHP_EOL;
                    $this->scan();
                }else{//输出文件
                    echo  "目录：".$path.PHP_EOL;
                    echo  "文件：".$value.PHP_EOL;
                }

            }
        }
    }
}
$file = dirname(__FILE__) . DIRECTORY_SEPARATOR ;
$test = new scandir($file);
$test->scan();