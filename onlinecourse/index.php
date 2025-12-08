<?php
session_start();

$controller = $_GET['controller'] ?? 'home';
$action     = $_GET['action'] ?? 'index';

$controllerName = ucfirst($controller) . "Controller";
$controllerFile = "controllers/$controllerName.php";

if (!file_exists($controllerFile)) {
    die("Controller $controllerName không tồn tại!");
}

require_once $controllerFile;

$instance = new $controllerName();

if (!method_exists($instance, $action)) {
    die("Action $action không tồn tại!");
}

$instance->$action();
