<?php
class CustomError {
    public static function callError($message = NULL) {
        $controller = '';
        $view = 'Error';
        $pagetitle = "erreur de la calle";
        require_once('view/view.php');
    }
}