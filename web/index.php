<?php
session_start();
$DS = DIRECTORY_SEPARATOR;
$ROOT_FOLDER = __DIR__;
require_once ($ROOT_FOLDER . $DS . 'lib' . $DS . 'File.php');

require(File::build_path(array("controller","Routeur.php")));

