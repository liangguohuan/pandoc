<?php

header('Content-type: application/json');

$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$text = $_REQUEST['text'];

$filename = '/tmp/' . time() . quickRandom();

// 创建临时文件
file_put_contents($filename, $text);

// 转换处理
$cmd = "/usr/bin/pandoc -t {$to} -f {$from} {$filename}";
$str = shell_exec($cmd);

// 转换完成后删除临时创建的文件
unlink($filename);

$arr = ['text'=>$str];
echo json_encode($arr);

function quickRandom($length = 16)
{
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}
