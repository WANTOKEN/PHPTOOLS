<?php
$fruits = array(
    "apple" => 'apple value',
    "orange" => 'orange value',
    "grape" => 'grape value',
    "plum " => "plum value"
);
print_r($fruits);
echo "***** user fruits directly".PHP_EOL;
foreach ($fruits as $key=> $value){
    echo $key.":".$value.PHP_EOL;
}

$obj = new ArrayObject($fruits);
$it = $obj->getIterator();
echo "***** user fruits directly".PHP_EOL;
foreach ($it as $key=> $value){
    echo $key.":".$value.PHP_EOL;
}

echo "***** user while fruits directly".PHP_EOL;
$it->rewind();
while ($it->valid()){
    echo $it->key().":".$it->current().PHP_EOL;
    $it->next();
}
echo "***** user seek fruits directly".PHP_EOL;
$it->rewind();
if($it->valid()){
    $it->seek(1);
    while ($it->valid()){
        echo $it->key().":".$it->current().PHP_EOL;
        $it->next();
    }
}
echo "***** user ksort fruits directly".PHP_EOL;
$it->ksort();//键排序
foreach ($it as $key=> $value){
    echo $key.":".$value.PHP_EOL;
}
echo "***** user asort fruits directly".PHP_EOL;
$it->asort();//值排序
foreach ($it as $key=> $value){
    echo $key.":".$value.PHP_EOL;
}