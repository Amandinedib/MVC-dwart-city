<?php
require('config.php');

$params = array_merge(array('controler' => 'home', 'action' => 'list'), $_GET);

$controllerName = ucfirst($params['controler']) . 'Controller';

require('Controllers/' . $controllerName . '.php');

$controller = new $controllerName();
$controller->setParameters($_GET);
$controller->setData($_POST);
$controller->CallActionName($params['action']);