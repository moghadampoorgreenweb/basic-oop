<?php

spl_autoload_register('myAutoloader');
function myAutoloader($class){
    $class = str_replace('\\', '/', $class);
    include "./app/$class.php";
}

include './web.php';
include './router.php';
