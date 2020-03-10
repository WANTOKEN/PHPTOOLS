<?php
require 'phpoffice/phpexcel/Classes/PHPExcel.php';
require 'phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';

//use PHPExcel_IOFactory;
//use PHPExcel;

class TestPHPExcel
{
    private $excelCopy; //导出excel版本
    private $suffix;
    private $objPHPExcel = null; //PHPExcel对象

    /**
     * Excel constructor.
     */
    public function __construct()
    {

        $this->objPHPExcel = new \PHPExcel();
        $this->excelCopy = 'Excel5';
        //判断后缀名
        if ($this->excelCopy == 'Excel5') {
            $this->suffix = '.xls';
        } else if ($this->excelCopy == 'Excel2007') {
            $this->suffix = '.xlsx';
        }
    }


    /**
     * 导出Excel文件
     * @param string $fileName 导出的文件名称
     * @param array $headerArr 头部数据：['name'=>'名称']
     * @param array $data 数据：[['name'=>'张三'],['name'=>'李四']]
     * @param string $sheet 工作表的名称
     */
    public function export($fileName = "Excel", $headerArr = array(), $data = array(), $sheet = 'Sheet1')
    {
        $this->objPHPExcel->setActiveSheetIndex(0); //设置当前的sheet
        $objSheet = $this->objPHPExcel->getActiveSheet(); //获取当前活动sheet
        $objSheet->setTitle($sheet); //设置标题

        //获取列字母,设置第一行表头
        $headCharArr = $this->getHeaderChar($headerArr); //A B C
        foreach ($headCharArr as $k => $v) {
            $objStyle = $objSheet->getStyle($headCharArr[$k] . '1');
            $objAlign = $objStyle->getAlignment();
            $objAlign->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER); //上下居中
            $objAlign->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //左对齐
            $objSheet->setCellValue($headCharArr[$k] . '1', $headerArr[$k]);
        }

        //导出数据
        $j = 2;
        foreach ($data as $k => $v) {
            foreach ($headerArr as $k1 => $v1) {
                $objStyle = $objSheet->getStyle($headCharArr[$k1] . $j);
                $objAlign = $objStyle->getAlignment();
                $objAlign->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER); //上下居中
                $objAlign->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $val = ' ' . $v[$k1];
                $objSheet->setCellValue($headCharArr[$k1] . $j, $val);
            }
            $j++;
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel, $this->excelCopy);

        $fileName = $fileName . ($this->suffix);
        $copy = $this->excelCopy;

        $this->browser_export($copy, $fileName);//输出到浏览器
        $objWriter->save('php://output');//输出到浏览器


        $localSavePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '\\' . $fileName;
        $objWriter->save($localSavePath); //保存到本地

    }

    /**
     * 获取excel列数字母
     * @param array $data
     * @return array
     */
    private function getHeaderChar($data = array())
    {
        $index = 65; //A标签
        $char = '';
        $charArr = array();
        foreach ($data as $k => $v) {
            $charArr[$k] = $char . chr($index++);
            if ($index == 91) {
                $index = 65;
                $char .= 'A';
            }
        }
        return $charArr;
    }

    /**
     * 输出到浏览器
     * @param $copy
     * @param $fileName
     */
    private function browser_export($copy, $fileName)
    {
        ob_end_clean();//清除缓冲区,避免乱码
        if ($copy == 'Excel5') {
            header('Content-Type: application/vnd.ms-excel;'); //告诉浏览器输出Excel2003文件
        } else {
            //告诉浏览器输出Excel2007文件
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        }
        header('Content-Disposition: attachment;filename="' . iconv('utf-8', 'gb2312', $fileName) . '"'); //文件名
        header('Cache-Control: max-age=0'); //禁止浏览器缓存
    }


    /**
     * 导入文件通过上传的文件
     * @param array $format 格式：['名称'=>'name']  会把列名转化成name
     * @param string $inputname 上传输入框的名称name
     * @param string $sheetName 工作表名称，默认：Sheet1
     * @return array  放回指定的数据
     */
    public function importByInput($format = array(), $inputname = 'excel', $sheetName = 'Sheet1')
    {

        $data = $this->importExcel($_FILES[$inputname]['tmp_name'], $sheetName);
        return $this->dealImportData($format, $data);

    }

    /**
     * 导入指定excel
     * @param array $format 格式：['名称'=>'name']  会把列名转化成name
     * @param string $filename excel在本机的绝对路径
     * @param string $sheetName 工作表名称，默认：Sheet1
     * @return array
     */
    public function import($format = array(), $filename = '', $sheetName = 'Sheet1')

    {

        $data = $this->importExcel($filename, $sheetName);
        return $this->dealImportData($format, $data);

    }

    /**
     * 处理导入数据
     * @param $format
     * @param $data
     * @return array
     */
    private function dealImportData($format, $data)
    {
        if (!$format) {
            return $data;
        } else {
            $newdata = array();
            foreach ($data as $k => $v) {
                $row = array();
                foreach ($v as $k2 => $v2) {
                    //$format[$k2]  获取key
                    if ($format[trim($k2)]) {//去除数据的两端空格
                        $row[$format[trim($k2)]] = trim($v2);
                    }

                }
                $newdata[] = $row;
            }
            return $newdata;
        }
    }


    /**
     * 导入excel,返回原始二维数据
     * @param $filename  文件绝对路径
     * @param string $sheetName 工作表名称，默认：Sheet1
     * @return array
     */
    public function importExcel($filename, $sheetName = 'Sheet1')
    {
        header("Content-Type:text/html;charset=utf-8");
        $fileType = \PHPExcel_IOFactory::identify($filename);//自动获取文件的类型提供给phpexcel用
        $objReader = \PHPExcel_IOFactory::createReader($fileType);//获取文件读取操作对象
        $sheetName = array($sheetName);
        $objReader->setLoadSheetsOnly($sheetName);//只加载指定的sheet
        $objPHPExcel = $objReader->load($filename);//加载文件
        $key = array();
        $value = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $sheet) {//循环取sheet
            foreach ($sheet->getRowIterator() as $row) {//逐行处理
                $temp = array();
                foreach ($row->getCellIterator() as $kk => $cell) {//逐列读取
                    if ($row->getRowIndex() < 2) {
                        $key[$kk] = $cell->getValue();
                    } else {
                        $data = $cell->getValue();//获取单元格数据
                        $temp[$kk] = $data;
                    }
                }
                if (!empty($temp)) {
                    $value[] = $temp;
                }
            }
        }
        $data = array();
        foreach ($value as $k => $v) {
            $temp = array();
            foreach ($v as $k1 => $v1) {
                $temp[$key[$k1]] = $v1;
            }
            $data[] = $temp;
        }
        return $data;
    }
}


$excel = new TestPHPExcel();
$fileName = '测试excel';
//导出到本地
//浏览器访问：http://www.ztk.com/PHPTOOLS/PHPExcel/TestPHPExcel.php

//$headerArr = ['title1' => '标题1', 'title2' => '标题2'];
//$dataArr = [
//    ['title1' => '张三', 'title2' => '李四'],
//    ['title1' => '张三1', 'title2' => '李四1'],
//    ['title1' => '张三2', 'title2' => '李四2'],
//    ['title1' => '张三3', 'title2' => '李四3']
//];
//$excel->export($fileName, $headerArr, $dataArr);
//大数据
$column_name = ["title1"=>"title1", "title2"=>"title2",
    "title3"=>"title3", "title4"=>"title4", "title5"=>"title5",
    "title6"=>"title6", "title7"=>"title7", "title8"=>"title8",
    "title9"=>"title9", "title10"=>"title10"];
// 将中文标题转换编码，否则乱码

//foreach ($column_name as $i => $v) {
//    $column_name[$i] = iconv('utf-8', 'GBK', $v);
//}
$export_data = [];
//for ($i = 0; $i < 10; $i++) {
    foreach (range(1, 10000) as $k => $v) {
        $export_data[] = [
           "title1"=> "XXX" . $v, "title2"=>"XXX" . $v,"title3"=> "XXX" . $v,
            "title4"=>"XXX" . $v, "title5"=>"XXX" . $v, "title6"=>"XXX" . $v,
            "title7"=>"XXX" . $v, "title8"=>"XXX" . $v, "title9"=>"XXX" . $v,
            "title10"=>"XXX" . $v
        ];
        $excel->export($fileName, $column_name, $export_data);
    }
//}



//导入Excel数据
//本地执行：/浏览器访问：http://www.ztk.com/PHPTOOLS/PHPExcel/TestPHPExcel.php
//$localSavePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '\\' . $fileName.'.xls';
//$format = ['标题1'=>'a','标题2'=>'b'];
//$data = $excel->import($format, $localSavePath);
//var_dump($data);