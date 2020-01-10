<?php
$obj = new SplDoublyLinkedList();
$obj->push(1);
$obj->push(2);
$obj->push(3);
$obj->unshift(10);
print_r($obj);
$obj->rewind();//用把节点指针指向Bottom
echo $obj->current().PHP_EOL;
$obj->next();
echo $obj->current().PHP_EOL;
$obj->prev();
echo $obj->current().PHP_EOL;
$obj->next();
$obj->next();
$obj->pop();
$obj->next();
print_r($obj);