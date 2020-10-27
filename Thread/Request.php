<?php
class Request extends Thread{
    public $url;
    public $response;
    public function __construct($url) {
        $this->url = $url;
    }
    public function run() {
        $this->response = file_get_contents($this->url);
    }
}
$chG = new Request("www.google.com");
$chB = new Request("www.baidu.com");
$chG ->start();
$chB ->start();
$chG->join();
$chB->join();

$gl = $chG->response;
$bd = $chB->response;
var_dump($gl);
var_dump($bd);