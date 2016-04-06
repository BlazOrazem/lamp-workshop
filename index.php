<?php

//require 'lib/Functions.php';
//require 'lib/Config.php';
//require 'lib/Url.php';

//require 'app/AdminController.php';
//require 'app/BaseController.php';
//require 'app/ErrorController.php';
//require 'app/Model.php';

$files = glob("{lib,app}/*.php", GLOB_BRACE);
foreach ($files as $file) {
    require($file);
}

Model::setup();

$url = new Url();
$controller = $url->getController();
$method = $url->getMethod();
$param = $url->getParam();

//debug($controller);
//debug($method);
//diebug($param);

ob_start();

if (!method_exists(new $controller(), $method)) {
    $controller = 'Error';
}

switch ($controller) {
    case "BaseController":
        $pageTitle = 'Prijava na delavnice';
        BaseController::$method($param);
        break;

    case "AdminController":
//        $pageTitle = 'Administracija delavnic';
//        if ($method == 'runParticipants') {
//            $pageTitle = 'Pregled prijav na delavnice';
//        }
        $pageTitle = ($method == 'runParticipants') ? 'Pregled prijav na delavnice' : 'Administracija delavnic';
        AdminController::$method($param);
        break;

    default:
    case "Error":
        $pageTitle = 'Stran ne obstaja';
        ErrorController::run404();
        break;
}

$content = ob_get_clean();

require 'views/layout.php';
