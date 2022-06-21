<?php

use Infrastructure\Route\Route;

$router = new Route();
$router->get('invoice','InvoiceController@all');
$router->post('invoice/<id>/<cid>/<name>','InvoiceController@save');
$router->post('article/<id>',['HomeController', 'dashboard']);
$router->put('invoice/<id>', function (){
    echo 'Majid Farzaneh';
});
$router->delete('invoice/<id>',[\Controller\HomeController::class, 'index']);