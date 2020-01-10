<?php
$stack = new SplStack();
$stack->push('a');
$stack->push('b');
$stack->push('c');
print_r($stack);
echo "Bottom:".$stack->bottom().PHP_EOL;
echo "Top:".$stack->top().PHP_EOL;
$stack->offsetSet(0,"c");//0就是堆栈的top节点
print_r($stack);
$stack->rewind();
echo "current:".$stack->current().PHP_EOL;
$stack->next();
echo "current:".$stack->current().PHP_EOL;
$stack->rewind();
while($stack->valid()){
    echo $stack->key()."=".$stack->current().PHP_EOL;
    $stack->next();//next不删除元素
}
$popObj = $stack->pop();
echo "Popobj:".$popObj.PHP_EOL;
print_r($stack);