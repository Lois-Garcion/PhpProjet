<?php

class ControllerUtilisateur
{

    public static function formConnect(){
        $controller= "Utilisateur";
        $view = "Connexion";
        $pagetitle = "Connexion";
        require_once(File::build_path(array("view","view.php")));
    }

    public static function connect(){
        require_once("model/Utilisateur.php");
        $login = $_POST["login"];
        $password = $_POST["password"];

        $user = Utilisateur::getUserByLoginAndPassword($login,$password);
        if($user){
            $_SESSION["status"] = "connected";
            $_SESSION["mail"] = $user->getAdresseMail();
            $_SESSION["nom"] = $user->getNom();
            $_SESSION["prenom"] = $user->getPrenom();
            $_SESSION["telephone"] =$user->getTelephone();
            $_SESSION["idAdresse"] =$user->getIdAdressePrincipale();
            header("location: ./");
        }
        else{
            $controller= "Utilisateur";
            $view = "Connexion";
            $pagetitle = "Connexion";
            require_once(File::build_path(array("view","view.php")));
        }
    }

}