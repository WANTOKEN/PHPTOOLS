<?php
/**
 * Created by PhpStorm.
 * User: ZTK
 * Date: 2020/5/22
 * Time: 15:29
 */
//单例模式数据库
class Db{

    private static $_instance;//
    private static $_dbConnect;
    private $_dbConfig = array(
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '',
        'database' => 'test',
        'port' => 3308,
        'charset' => 'utf8mb4'
    );

    private function __construct()
    {
    }

    public function __clone()
    {
        //当用户clone操作时产生一个错误信息
        echo "禁止克隆".PHP_EOL;
        // 函数创建用户级别的错误消息。
        trigger_error("Can't clone object",E_USER_ERROR);
    }

    //获取单列
    public static function getInstance(){
        if(!(self::$_instance instanceof self)){  //如果当前实例不存在，创建
            echo "获取new新实例".PHP_EOL;
            self::$_instance = new self();
        }
//        var_dump(self::$_instance);
        self::$_instance->connect();
        return self::$_instance;
    }

    //连接数据库
    public function connect(){
        $host = $this->_dbConfig['host'];
        $user = $this->_dbConfig['user'];
        $pwd = $this->_dbConfig['password'];
        $dbname = $this->_dbConfig['database'];
        $port = $this->_dbConfig['port'];
        $charset = $this->_dbConfig['charset'];
        $dsn = "mysql:host=$host;dbname=$dbname;port=$port";
        $pdo = new PDO ( $dsn, $user, $pwd );
        $pdo->query("set names {$charset};");
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$_dbConnect = $pdo;
        if(!self::$_dbConnect){
            throw new Exception('mysql connnect');
        }
        return self::$_dbConnect;
    }

    public function query($sql=null, $params=array() ){
        $stmt = Db::$_dbConnect->prepare($sql);
        if( is_array($params) && !empty($params) ){
            foreach($params as $k=>&$v){
                $stmt->bindParam($k, $v);
            }
        }
        if( $stmt->execute() )
            //查询多条数据
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $err = $stmt->errorInfo();
        throw new Exception('Database SQL: "' . $sql. '". ErrorInfo: '. $err[2], 1);
    }

}
$a = Db::getInstance();//获取
$b = Db::getInstance();
try{
    $data = $a->query("select * from users");
    var_dump($data);
}catch (Exception $e){
    echo "sorry,error was happend.".$e->getMessage();
}
