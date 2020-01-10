<?php
$obj = new SplQueue();
$obj->enqueue('a');
$obj->enqueue('b');
$obj->enqueue('c');
$obj->enqueue('d');
print_r($obj);
echo "Bottom:".$obj->bottom().PHP_EOL;
echo "Top:".$obj->top().PHP_EOL;
$obj->offsetSet(0,'A');
print_r($obj);
$obj->rewind();
echo "current:".$obj->current().PHP_EOL;
$deque = $obj->dequeue();
echo "dequeue:".$deque.PHP_EOL;
print_r($obj);