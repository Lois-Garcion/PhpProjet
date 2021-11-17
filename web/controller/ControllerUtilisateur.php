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
            CustomError::callError("Les mots de passe ne sont pas les mêmes");
        }

        else if(Utilisateur::getUserByLogin($mail)){
            CustomError::callError("Un compte est déjà associé à cette adresse mail");
        }

        else {
            $v = new Utilisateur($mail, Security::hacher($password));
            $v->save();
            $_POST["login"] = $mail;
            $_POST["password"] = $password;
            ControllerUtilisateur::connect();
        }
    }

}