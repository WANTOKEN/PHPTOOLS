<?php
include '../PHPExcel/PHPExcelTools.php';
/**
 * 读取本地数据，生成php数据样本
 */
class readLogs
{
    private $file;
    private $charset;
    public $result;

    public function __construct($file)
    {
        $this->file = $file;
        $this->charset = 'utf-8';
    }

    function read($path)
    {
        $fileSplHandle = new \SplFileObject($path);
        foreach ($fileSplHandle as $lineNum => $line) {
            $curLine = explode(" ", $line);
            $curLine = array_filter($curLine);
            if ($curLine) {
                $dateTime = $curLine[0] . " " . $curLine[1];
                $dateTime = str_replace('[', '', $dateTime);
                $dateTime = str_replace(']', '', $dateTime);
                $dateAndTime = explode(" ", $dateTime);
//                echo $dateAndTime[0].PHP_EOL;
                if ((strtotime($dateTime) >= strtotime($dateAndTime[0] . " 05:30:00")) && (strtotime($dateTime) < strtotime($dateAndTime[0] . " 05:35:00"))) {
//                    var_dump($line) ;
                    if (stripos($line, '.INFO: data [["[object]') == false) {
                        $needIndex1 = stripos($line, '{\"emp_no\":');
                        $needIndex2 = stripos($line, '","[object] (PDOStatement:');
                        $needData1 = substr($line, $needIndex1, $needIndex2 - $needIndex1 - 1);
                        $needData1 = str_replace("\\", "", $needData1);
//                        echo $needData1.PHP_EOL;
                        $needIndex3 = stripos($line, '[object] (PDOStatement:');
                        $needIndex4 = stripos($line, '\"})"] []');
                        $needData2 = substr($line, $needIndex3 + 24, $needIndex4 - ($needIndex3 + 21));
//                        echo $needData2.PHP_EOL;
                        $empData = json_decode($needData1, true);
                        $result = array();
                        $conf = array('1' => '新', '2' => '更新', '3' => '删除');
                        if($empData){
                            foreach ($empData as $k => $v) {
                                $result['datetime'] = $dateTime;
                                $result[$k] = $v;
                                $result["action"] = $needData2;
                                if($k=="emp_type"){
                                    $result["emp_type_str"] = $v == 1 ? "BA" : "管理员";
                                }
                                if($k=="update_type"){
                                    $result["update_type_str"] = $conf[$v];
                                }

                            }
                        }

                        $this->result[] = $result;
//                        var_dump($result);

                    }

                }
            }

        }
    }

    //扫描目录
    public function scan(){
        $path = $this->file;
        if(is_dir($path)){
            $dir = scandir($path);
            foreach ($dir as $value){
                $subPath = $path.'\\'.$value;
                if ($value=='.'||$value==".."){
                    continue;
                }elseif (is_dir($subPath)){//如果还是目录
                    $this->path=$subPath;
//                    echo  "继续扫描：".$subPath.PHP_EOL;
                    $this->scan();
                }else{//输出文件
//                    echo  "目录：".$path.PHP_EOL;
//                    echo  "文件：".$value.PHP_EOL;
                    $this->read($path.'\\'.$value);
                }

            }
        }
    }

}

$file ='D:\Files\工作\因赛工作\睿致肌\logs\test2';
$test = new readLogs($file);
$test->scan();
//var_dump($test->result);
$excel = new PHPExcelTools();
$fileName = "6月份16-28接口操作";
$headArr=array('datetime'=>'时间','emp_no'=>'员工工号','emp_name'=>'员工姓名','store_code'=>'所属店铺',
    'emp_type_str'=>'员工类型','update_type_str'=>'更新类型','action'=>'操作',
   );
$excel->export($fileName,$headArr,$test->result);



