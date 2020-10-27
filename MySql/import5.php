<?php
set_time_limit(0);
ini_set('memory_limit','3096M');
//http://www.ztk.com/MySql/import5.php
include '../PHPExcel/PHPExcelTools.php';
include 'conf.php';
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "连接成功";
} catch (PDOException $e) {
//    echo $e->getMessage();
}

$sql5 = "select a.user_login,a.user_nicename,b.role_id,b.user_id,a.store_id,a.user_status from rzj_store.cmf_users a left JOIN rzj_store.cmf_role_user b on a.id=b.user_id; 
";
$stmt = $conn->prepare($sql5);
$stmt->execute();
// 设置结果集为关联数组
$result5 = $stmt->fetchAll(PDO::FETCH_ASSOC); //预约订单
$storeBaData=array();//BA数据
foreach ($result5 as $v){
    $storeBaData[$v['user_login']]['role_id']=$v['role_id'];
    $storeBaData[$v['user_login']]['store_id']=$v['store_id'];
    $storeBaData[$v['user_login']]['user_nicename']=$v['user_nicename'];
    $storeBaData[$v['user_login']]['user_status']=$v['user_status'];
}



$excel = new PHPExcelTools();

$localSavePath = 'G:\员工数据2.xlsx';
$format = array('员工编号'=>'user_login','姓名'=>'name','Store No.'=>'store_id',
   '系统对应角色'=>'role'
);
$data = $excel->import($format, $localSavePath);

$SQLTEXT = "";
$ERRORTEXT = "";
$INSERTTEXT = "";
$TIPTEXT = ""; //提示信息
$errorData = array();
$insertId = 2000;
foreach ($data as $v){

//    $id = $v['id'];
    $user_id = $v['user_login'];

    $res = isset($storeBaData[$v['user_login']]);

    $storeId = $v['store_id'];
    $roleConf = array('BA'=>5,'门店管理员'=>2);
    $userType = array('BA'=>2,'门店管理员'=>1);
    $name = $v['name'];
    if($res){
        $queryRole = $storeBaData[$user_id]['role_id'];
        $excelRole = $roleConf[$v['role']];

        $queryStoreId =  $storeBaData[$user_id]['store_id'];
        $excelStoreId = $v['store_id'];

        $userTypeID = $userType[$v['role']];

        $username = $v['name'];
        if($queryRole!=$excelRole){
            $SQLTEXT .= "update cmf_users set user_type = '{$userTypeID}' where user_login= '{$user_id}';\n ";
            $SQLTEXT .= "update cmf_role_user set role_id = '{$excelRole}' where user_id= '{$user_id}';\n ";
        }
        if($queryStoreId!=$excelStoreId){
//            $SQLTEXT .= "queryStoreId:".$queryStoreId."|"."excelStoreId:".$excelStoreId;
            $SQLTEXT .= "update cmf_users set store_id = '{$excelStoreId}' where user_login= '{$user_id}';\n ";
        }
        if(empty($storeBaData[$v['user_login']]['user_nicename'])){
            $SQLTEXT .= "update cmf_users set user_nicename = '{$username}' where user_login= '{$user_id}';\n ";
        }

        $userStatus = $storeBaData[$user_id]['user_status'];
        if($userStatus==0){
            $SQLTEXT .= "update cmf_users set user_status = '1' where user_login= '{$user_id}';\n ";
        }
    }else{
        $excelRole = $roleConf[$v['role']];
        $userTypeVal = $userType[$v['role']];
        $INSERTTEXT .= "INSERT INTO cmf_users (id, user_login,user_pass,user_nicename,store_id,user_type)
VALUES ({$insertId},'{$user_id}','###ea09b733fe5f76bd73e271b645737123','{$name}','{$storeId}',{$userTypeVal});\n ";

        $INSERTTEXT .= "INSERT INTO cmf_role_user(role_id,user_id)
VALUES ('{$excelRole}','{$insertId}');\n ";
        $TIPTEXT .="不存在数据{$user_id}".PHP_EOL;
        $errorData[] = $v;
        $insertId++;
    }
}

echo $TIPTEXT.PHP_EOL;
$VERSION = "v1";
$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA2/update2'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $SQLTEXT);//保存文件到指定路径


$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/RzjDATA2/insert2'.date('Y-m-d').$VERSION.'.sql';
file_put_contents($filename, $INSERTTEXT);//保存文件到指定路径

if(!empty($TIPTEXT)){
    $excel2 = new PHPExcelTools();
    $fileName = "未录入员工数据表".date('Y-m-d');
    $headArr=array('user_login'=>'员工编号','name'=>'姓名','store_id'=>'Store No.',
        'role'=>'系统对应角色');
    $excel2->exportBrowser($fileName,$headArr,$errorData);
}
$conn = null;
