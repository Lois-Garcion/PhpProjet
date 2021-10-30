<?php

class ControllerCommande
{

    public static function readByIdCommande(){
        require_once(File::build_path(array("model","Ligne_Commande_Produit.php")));
        require_once(File::build_path(array("model","Produit.php")));
        $tab_ligneCP = Ligne_Commande_Produit::getAllByIdCommande($_GET["idCommande"]);

        $controller = "commande";
        $view = "listProduitCommande";
        $pagetitle = "Commande de la calle";
        require_once(File::build_path(array("view","view.php")));



    }

}