<?php

class ControllerProduit
{

    public static function readAll(){
        require_once(File::build_path(array("model","Produit.php")));
        $tab_produit = Produit::getAll();

        $controller = "Produit";
        $view = "ListProduit";
        require_once(File::build_path(array("view","view.php")));

    }


}