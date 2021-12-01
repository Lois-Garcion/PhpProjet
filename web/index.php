<?php
session_start();
if(!isset($_COOKIE["panier"])) {
    setcookie("panier", serialize(array()), time() + 172800); //TODO cette fonction se reinitialise a chaque fois donc le panier se vide a chaque refresh
}
$DS = DIRECTORY_SEPARATOR;
$ROOT_FOLDER = __DIR__;
require_once ($ROOT_FOLDER . $DS . 'lib' . $DS . 'File.php');

require(File::build_path(array("controller","Routeur.php")));

