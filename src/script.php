<?php
require __DIR__ . '/vendor/autoload.php';
$way=$argv[1];
$buff=file_get_contents("$way",true);
    $buff=explode('[] []',$buff);
    $buff=collect($buff)->map(function($item,$key){
    $str=strpos($item,"O: ");
    $item=substr($item,$str+3,-1);
    return $item;
    })->filter()->countBy()->All();
print_r($buff);