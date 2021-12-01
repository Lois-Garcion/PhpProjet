<?php
require_once (File::build_path(array("model","CustomError.php")));
require_once (File::build_path(array("model","Utilisateur.php")));
require_once (File::build_path(array("model","Produit.php")));
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
            $login = $_SESSION["mail"];
        }
        if (isset($_POST["password"])) {
            $password = Security::hacher($_POST["password"]);
        }
        else{
            $password = Security::hacher($_SESSION["password"]);
            unset($_SESSION["password"]);
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
                $_SESSION["panier"] = array();
                $_SESSION["prixPanier"] = 0;
                header("location: ./");
            } else {
                $_SESSION["mail"] = $_POST["mail"];
                $_SESSION["password"] = $_POST["password"];
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
                $mail = "Le code pour vous connecter est le suivant : ".$nonce."\n"; //TODO ajouter un lien vers la page de connexion
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

    public static function updateNames(){
        if (!isset($_SESSION["status"])) {
          $controller= "Utilisateur";
          $view = "Connexion";
          $pagetitle = "Connexion";
          require_once(File::build_path(array("view","view.php")));
        }
        else {
          $user = Utilisateur::getUserByLogin($_SESSION["mail"]);

          $user->setPrenom($_POST["prenom"]);
          $user->setNom($_POST["nom"]);

          $user->save();

          $_SESSION["prenom"] = $_POST["prenom"];
          $_SESSION["nom"] = $_POST["nom"];

          $controller = "Utilisateur";
          $view = "PageUtilisateur";
          $pagetitle = "Utilisateur de la calle";
          require_once(File::build_path(array("view","view.php")));
        }
    }

    public static function updatePhone(){
        if (!isset($_SESSION["status"])) {
          $controller= "Utilisateur";
          $view = "Connexion";
          $pagetitle = "Connexion";
          require_once(File::build_path(array("view","view.php")));
        }
        else {
          $user = Utilisateur::getUserByLogin($_SESSION["mail"]);

          $user->setTelephone($_POST["telephone"]);

          $user->save();

          $_SESSION["telephone"] = $_POST["telephone"];

          $controller = "Utilisateur";
          $view = "PageUtilisateur";
          $pagetitle = "Utilisateur de la calle";
          require_once(File::build_path(array("view","view.php")));
        }
    }

    public static function ajoutPanier()
    {
        if (!isset($_SESSION["status"])) {
            self::formConnect(); //TODO ramener l'utilisateur ou il était après sa connexion
        }
        else {
            $produit = Produit::getById($_POST["idProduit"]);
            if(!$produit){
                CustomError::callError("Ce produit n'existe pas ou n'est plus en stock");
            }
            else {
                $panier = $_SESSION["panier"];
                $panier[count($panier)] = array("idProduit" => $_POST["idProduit"], "quantiteProduit" => $_POST["quantite"]);
                $_SESSION["panier"] = $panier;
                $_SESSION["prixPanier"] = $_SESSION["prixPanier"] + $produit->getPrix() * $_POST["quantite"];
                require_once(File::build_path(array("controller", "ControllerProduit.php")));
                ControllerProduit::readAll(); //TODO grace aux sessions, revenir sur la page sur laquelle l'utilisateur etait lors de l'ajout
            }
        }
    }

    public static function retirerProduitPanier(){
        if (!isset($_SESSION["status"])) {
            self::formConnect(); //TODO ramener l'utilisateur ou il était après sa connexion
        }
        else {
            $panier = $_SESSION["panier"];
            foreach ()
        }
    }

    public static function afficherPanier(){
        if(!isset($_SESSION["status"])){
            self::formConnect();
        }
        else{
            $controller = "Utilisateur";
            $view = "Panier";
            $pagetitle = "Panier";
            require_once(File::build_path(array("view","view.php")));
        }
    }
}
