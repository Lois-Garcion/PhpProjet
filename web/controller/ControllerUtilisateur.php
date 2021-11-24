<?php
require_once (File::build_path(array("model","CustomError.php")));
class ControllerUtilisateur
{

    public static function formConnect(){
        $controller= "Utilisateur";
        $view = "Connexion";
        $pagetitle = "Connexion";
        require_once(File::build_path(array("view","view.php")));
    }

    public static function connect(){
        require_once (File::build_path(array("model","Utilisateur.php")));
        require_once (File::build_path(array("model","Security.php")));

        $login = $_POST["login"];
        $password = Security::hacher($_POST["password"]);

        $user = Utilisateur::getUserByLoginAndPassword($login,$password);
        if($user){
            $_SESSION["status"] = "connected";
            $_SESSION["mail"] = $user->getAdresseMail();
            $_SESSION["nom"] = $user->getNom();
            $_SESSION["prenom"] = $user->getPrenom();
            $_SESSION["telephone"] =$user->getTelephone();
            $_SESSION["idAdresse"] =$user->getIdAdressePrincipale();
            $_SESSION["admin"] = $user->getAdmin();
            header("location: ./");
        }
        else{
            $controller= "Utilisateur";
            $view = "Connexion";
            $pagetitle = "Connexion";
            require_once(File::build_path(array("view","view.php")));
        }
    }

    public static function logout(){
        session_unset();
        session_destroy();
        setcookie(session_name(),'',time()-1);
        header("location: ./");
    }

    public static function inscription(){
        $controller = "Utilisateur";
        $view = "CreationCompte";
        require_once(File::build_path(array("view","view.php")));
    }

    public static function created(){
        require_once(File::build_path(array("model","Security.php")));
        require_once(File::build_path(array("model","Utilisateur.php")));
        $mail = $_POST["login"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["validationPassword"];

        if($password !== $confirmPassword){
            ControllerUtilisateur::inscription(); //TODO ajouter un message d'erreur au dessus du form d'inscription
        }

        else if(Utilisateur::getUserByLogin($mail)){
            ControllerUtilisateur::inscription(); //TODO ajouter un message d'erreur au dessus du form d'inscription
        }

        else {
            $v = new Utilisateur($mail, Security::hacher($password));
            $v->save();
            $_POST["login"] = $mail;
            $_POST["password"] = $password;
            ControllerUtilisateur::connect();
        }
    }

    public static function accueilAdmin(){
        if($_SESSION["admin"]=1){
            $controller = "Utilisateur";
            $view = "AccueilAdmin";
            require_once(File::build_path(array("view","view.php")));
        }
        else{
            CustomError::callError("Cette page est reservé aux administrateurs");
        }
    }

    public static function upgradeAdmin(){
        if($_SESSION["admin"]=1) {
            $user = Utilisateur::getUserByLogin($_POST["mail"]);
            $user->setAdmin(1);
            $user->save();
            self::accueilAdmin();
        }
        else{
            CustomError::callError("Cette fonction est reservé aux administrateurs");
        }
    }

    public static function pageUtilisateur(){
        if(isset($_SESSION["status"])){
            $controller = "Utilisateur";
            $view = "PageUtilisateur";
            $pagetitle = "Utilisateur de la calle";
            require_once(File::build_path(array("view","view.php")));
        }
    }
}