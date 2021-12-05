<?php
require_once (File::build_path(array("model","CustomError.php")));
require_once (File::build_path(array("model","Utilisateur.php")));
require_once (File::build_path(array("model","Produit.php")));
require_once (File::build_path(array("model","Adresse.php")));
require_once (File::build_path(array("model","Commande.php")));
require_once (File::build_path(array("model","Ligne_Commande_Produit.php")));
class ControllerCommande
{

    public static function readByIdCommande(){
        if(!isset($_SESSION["status"])){
            self::formConnect();
        }
        else {
            require_once(File::build_path(array("model", "Ligne_Commande_Produit.php")));
            require_once(File::build_path(array("model", "Produit.php")));
            $tab_ligneCP = Ligne_Commande_Produit::getAllByIdCommande($_GET["idCommande"]);

            $controller = "Commande";
            $view = "listProduitCommande";
            $pagetitle = "Commande de la calle";
            require_once(File::build_path(array("view", "view.php")));
        }
    }

    public static function readAll(){
        if(!isset($_SESSION["status"])){
            self::formConnect();
        }
        else {
            $tabCommande = Commande::getAllByMail($_SESSION["mail"]);
            $controller = "Commande";
            $view = "listCommande";
            $pagetitle = "Mes commandes";
            require_once(File::build_path(array("view","view.php")));
        }

    }

    public static function read(){
        if(!isset($_SESSION["status"])){
            self::formConnect();
        }
        else {
            $tab_ligneCP = Ligne_Commande_Produit::getAllByIdCommande($_GET["id"]);

            $controller = "Commande";
            $view = "listProduitCommande";
            $pagetitle = "Produit de la Commande";
            require_once(File::build_path(array("view","view.php")));

        }
    }

}