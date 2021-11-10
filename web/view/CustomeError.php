<?php
class CustomError {
    public static function callError($message = NULL) {
        $controller = '';
        $view = 'Error';
        require_once('view/view.php');
    }
}