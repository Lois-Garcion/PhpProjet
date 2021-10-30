<?php

class ControllerProduit
{

    public static function readAll(){
        require_once(File::build_path(array("model","Produit.php")));
        $tab_produit = Produit::getAll();

        $controller = "Produit";
        $view = "ListProduit";
        $pagetitle = "Boutique de la calle";
        require_once(File::build_path(array("view","view.php")));
    }

    public static function sortedReadAll(){
        require_once(File::build_path(array("model","Produit.php")));
        $tab_produit = Produit::getAllSortedByAttribute($_GET("attribute"),$_GET("order"));

        $controller = "Produit";
        $view = "ListProduit";
        $pagetitle = "Boutique de la calle";
        require_once(File::build_path(array("view","view.php")));
    }

    public static function readAllByCategorie(){
        require_once(File::build_path(array("model","Produit.php")));
        $tab_produit = Produit::getAllByCategorie($_GET("categorie"));

        $controller = "Produit";
        $view = "ListProduit";
        $pagetitle = "Boutique de la calle";

        require_once(File::build_path(array("view","view.php")));
    }
    public static function readAllMinPriceMaxPrice(){
        require_once(File::build_path(array("model","Produit.php")));
        $tab_produit = Produit::getAllByMinMaxPrice($_GET("minPrice"),$_GET("maxPrice"));

        $controller = "Produit";
        $view = "ListProduit";
        $pagetitle = "Boutique de la calle";

        require_once(File::build_path(array("view","view.php")));
    }




    public static function read(){
        require_once(File::build_path(array("model","Produit.php")));
        $produit = Produit::getById($_GET("id"));

        $controller = "Produit";
        $view = "PageProduit";
        $pagetitle = "Produit de la calle";

        require_once(File::build_path(array("view","view.php")));
    }




}