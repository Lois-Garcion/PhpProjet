<?php

if(sizeof($_GET) == 0 ){
    $controller = null;
    $view = "Accueil";
    $pagetitle= "boutique de la calle accueil";
    require(File::build_path(array("view","view.php")));
}
else {

    $controller = $_GET["controller"];
    $action = $_GET["action"];

    if(file_exists(File::build_path(array("controller",$controller.".php")))) {
        require_once(File::build_path(array("controller", $controller.".php")));
    }
    else{
        require_once(File::build_path(array("model","CustomError.php")));
        CustomError::callError("La classe \"$controller\" n'existe pas");
    }

    if (method_exists($controller, $action))$controller::$action();
    else {
        require_once(File::build_path(array("model","CustomError.php")));
        CustomError::callError("La fonction " . $action . " du controller " . $controller . " n'existe pas");
    }
}