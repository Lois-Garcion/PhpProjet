<?php
require_once (File::build_path(array("model","CustomError.php")));
require_once (File::build_path(array("model","Utilisateur.php")));
class ControllerUtilisateur
{

    public static function formConnect(){
        $controller= "Utilisateur";
        $view = "Connexion";
        $pagetitle = "Connexion";
        require_once(File::build_path(array("view","view.php")));
    }

    public static function formValidateNonce(){
        $controller= "Utilisateur";
        $view = "ValidationNonce";
        $pagetitle = "Validez votre compte";
        require_once(File::build_path(array("view","view.php")));
    }

    public static function connect()
    {
        require_once(File::build_path(array("model", "Utilisateur.php")));
        require_once(File::build_path(array("model", "Security.php")));
        if (isset($_POST["mail"])) {
            $login = $_POST["mail"];
        } else {
            $login = $_SESSION["mailConnection"];
        }
        if (isset($_POST["password"])) {
            $password = Security::hacher($_POST["password"]);
        }
        else{
            $password = Security::hacher($_SESSION["password"]);
            unset($_SESSION["passwordConnection"]);
        }

        $user = Utilisateur::getUserByLoginAndPassword($login, $password);
        if ($user) {
            if (is_null($user->getNonce())) {
                $_SESSION["status"] = "connected";
                $_SESSION["mail"] = $user->getAdresseMail();
                $_SESSION["nom"] = $user->getNom();
                $_SESSION["prenom"] = $user->getPrenom();
                $_SESSION["telephone"] = $user->getTelephone();
                $_SESSION["admin"] = $user->getAdmin();
                header("location: ./");
            } else {
                $_SESSION["mailConnection"] = $_POST["mail"];
                $_SESSION["passwordConnection"] = $_POST["password"];
                self::formValidateNonce();
            }
        }
        else{
            $controller= "Utilisateur";
            $view = "Connexion";
            $pagetitle = "Connexion";
            require_once(File::build_path(array("view","view.php")));
        }
    }

    public static function validateNonce(){
        $user = Utilisateur::getUserByLogin($_SESSION["mail"]);
        if($user->getNonce() == $_POST["nonce"]){
            $user->setNonce(null);
            $user->save();
            self::connect();
        }
        else{
            unset($_SESSION["mail"]);
            CustomError::callError("Ce n'est pas le bon code");
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
        if(filter_var($_POST["login"],FILTER_VALIDATE_EMAIL)) {
            $mail = $_POST["login"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["validationPassword"];

            if ($password !== $confirmPassword) {
                CustomError::callError("les mots de passe ne coincident pas"); //TODO ajouter un message d'erreur au dessus du form d'inscription
            } else if (Utilisateur::getUserByLogin($mail)) {
                CustomError::callError("cette adresse mail existe deja"); //TODO ajouter un message d'erreur au dessus du form d'inscription
            } else {
                $nonce = Security::generateRandomHex();
                $v = new Utilisateur($mail, Security::hacher($password),$nonce);
                $v->save();
                $mail = "Le code pour vous connecter est le suivant : ".$nonce."\n"; //TODO ajouter un lien vers la page de connexion et comprendre pourquoi ca envoie pas le mail (ou alors je suis blacklisté)
                mail($v->getAdresseMail(),"Boutique de la calle, validez votre inscription",$mail);
                ControllerUtilisateur::formConnect();

            }
        }
        else{
            CustomError::callError("l'adresse mail n'est pas valide"); //TODO ajouter un message d'erreur au dessus du form d'inscription
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