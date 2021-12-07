<?php
require_once (File::build_path(array("model","CustomError.php")));
require_once (File::build_path(array("model","Utilisateur.php")));
require_once (File::build_path(array("model","Produit.php")));
require_once (File::build_path(array("model","Adresse.php")));
require_once (File::build_path(array("model","Commande.php")));
require_once (File::build_path(array("model","Ligne_Commande_Produit.php")));

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
                $_SESSION["idAdresse"] = $user->getIdAdresse();

                if (isset($_SESSION["redirectionController"]) && isset($_SESSION["redirectionView"])) {
                    $controller = $_SESSION["redirectionController"];
                    $view = $_SESSION["redirectionView"];
                    $pagetitle = $_SESSION["redirectionTitle"];
                    unset($_SESSION["redirectionController"]);
                    unset($_SESSION["redirectionView"]);
                    unset($_SESSION["redirectionTitle"]);
                    require_once(File::build_path(array("view","view.php")));
                } else {
                header("location: ./");
            }
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
        $pagetitle = "inscription";
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
                CustomError::callError("les mots de passe ne coincident pas");
            } else if (Utilisateur::getUserByLogin($mail)) {
                CustomError::callError("cette adresse mail existe deja");
            } else {
                $nonce = Security::generateRandomHex();
                $v = new Utilisateur($mail, Security::hacher($password),$nonce);
                $v->save();
                $mail = "Le code pour vous connecter est le suivant : ".$nonce."\n";
                mail($v->getAdresseMail(),"Boutique de la calle, validez votre inscription",$mail);
                ControllerUtilisateur::formConnect();

            }
        }
        else{
            CustomError::callError("l'adresse mail n'est pas valide");
        }
    }

    public static function accueilAdmin(){
        if($_SESSION["admin"]=1){
            $controller = "Utilisateur";
            $view = "AccueilAdmin";
            $pagetitle = "Accueil Administrateur";
            require_once(File::build_path(array("view","view.php")));
        }
        else{
            CustomError::callError("Cette page est reservé aux administrateurs");
        }
    }

    public static function upgradeAdmin(){
        if($_SESSION["admin"]=1) {
            $user = Utilisateur::getUserByLogin($_POST["mail"]);
            if(!$user){
                CustomError::callError("Le mail de l'utilisateur n'existe pas");
            }
            else {
                $user->setAdmin(1);
                $user->save();
                self::accueilAdmin();
            }
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

    public static function updateAdresse(){

        if (!isset($_SESSION["status"])) {
            $controller= "Utilisateur";
            $view = "Connexion";
            $pagetitle = "Connexion";
            require_once(File::build_path(array("view","view.php")));
        }
        else{
            if(!isset($_SESSION["idAdresse"])){
                $adresse = new Adresse(null, $_POST["codePostal"], $_POST["ville"], $_POST["numeroHabitation"], $_POST["nomRue"], $_POST["complement"], $_SESSION["mail"]);
            }
            else {
                $adresse = new Adresse($_SESSION["idAdresse"], $_POST["codePostal"], $_POST["ville"], $_POST["numeroHabitation"], $_POST["nomRue"], $_POST["complement"], $_SESSION["mail"]);
            }
            $adresse->save();
            $_SESSION["idAdresse"] = Adresse::getLastCreated()->getIdAdresse();

            $user = Utilisateur::getUserByLogin($_SESSION["mail"]);
            $user->setIdAdresse(Adresse::getLastCreated()->getIdAdresse());
            $user->save();

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
            $produit = Produit::getById($_POST["idProduit"]);
            if(!$produit){
                CustomError::callError("Ce produit n'existe pas ou n'est plus en stock");
            }
            else {
                if(!isset($_SESSION["panier"])){
                    $_SESSION["panier"] = array();
                }
                if(!isset($_SESSION["panier"][$_POST["idProduit"]])) {
                    $_SESSION["panier"][$_POST["idProduit"]] = $_POST["quantite"];
                }
                else{
                    $_SESSION["panier"][$_POST["idProduit"]] = $_SESSION["panier"][$_POST["idProduit"]] + $_POST["quantite"];
                }
                require_once(File::build_path(array("controller", "ControllerProduit.php")));
                ControllerProduit::readAll();
            }
    }

    public static function retirerProduitPanier(){
        if(!isset($_SESSION["panier"][$_POST["idProduit"]])){
            CustomError::callError("Ce produit n'est pas dans votre panier");
        }
        else {
            unset($_SESSION["panier"][$_POST["idProduit"]]);
            self::afficherPanier();
        }
    }

    public static function updateQuantity(){
        if(!isset($_SESSION["panier"][$_POST["idProduit"]])){
            CustomError::callError("Ce produit n'est pas dans votre panier");
        }
        else{
            if($_POST["quantite"] == 0){
                unset($_SESSION["panier"][$_POST["idProduit"]]);
                self::afficherPanier();
            }
            else {
                $_SESSION["panier"][$_POST["idProduit"]] = $_POST["quantite"];
                self::afficherPanier();
            }
        }
    }

    public static function afficherPanier(){
        if(!isset($_SESSION["panier"])){
            ControllerProduit::readAll();
        }
        else{
            $controller = "Utilisateur";
            $view = "Panier";
            $pagetitle = "Panier";
            require_once(File::build_path(array("view","view.php")));
        }
    }

    public static function annulerPanier(){
        if(!isset($_SESSION["panier"])){
            ControllerProduit::readAll();
        }
        else{
            if(isset($_SESSION["prixTotal"]))unset($_SESSION["prixTotal"]);
            $_SESSION["panier"] = array();
            require_once (File::build_path(array("controller","ControllerProduit.php")));
            ControllerProduit::readAll();
        }
    }

    public static function validerPanier(){
        if(!isset($_SESSION["status"])){
            $_SESSION["redirectionController"] = "Utilisateur";
            $_SESSION["redirectionView"] = "ValidationPanier";
            $_SESSION["redirectionTitle"] = "Validation du panier";
            self::formConnect();
        }
        else{
            if(isset($_SESSION["prixTotal"]) && $_SESSION["prixTotal"] != 0){
                $controller = "Utilisateur";
                $view = "ValidationPanier";
                $pagetitle = "Panier";
                require_once(File::build_path(array("view","view.php")));
            }
            else{
                ControllerProduit::readAll();
            }
        }
    }

    public static function finaliserPanier(){
        if(!isset($_SESSION["status"])){
            $_SESSION["redirection"] = "?controller=ControllerUtilisateur&action=finaliserPanier";
            self::formConnect();
        }
        else {

            $user = Utilisateur::getUserByLogin($_SESSION["mail"]);
            $user->setNom($_POST["nom"]);
            $user->setPrenom($_POST["prenom"]);
            $user->setTelephone($_POST["telephone"]);

            $_SESSION["nom"] = $user->getNom();
            $_SESSION["prenom"] = $user->getPrenom();
            $_SESSION["telephone"] = $user->getTelephone();

            if(is_null($user->getIdAdresse())){
                $adresse = new Adresse(null,$_POST["codePostal"],$_POST["ville"],$_POST["numeroHabitation"],$_POST["nomRue"],$_POST["complement"],$_SESSION["mail"]);
                $adresse->save();
                $user->setIdAdresse(Adresse::getLastCreated()->getIdAdresse());
                $_SESSION["idAdresse"] = $user->getIdAdresse();
            }
            else{
                $adresse = Adresse::getById($_SESSION["idAdresse"]);
                $adresse->setCodePostal($_POST["codePostal"]);
                $adresse->setVille($_POST["ville"]);
                $adresse->setNumeroHabitation($_POST["numeroHabitation"]);
                $adresse->setNomRue($_POST["nomRue"]);
                $adresse->setComplement($_POST["complement"]);
                $adresse->setAdresseMailUtilisateur($_SESSION["mail"]);
                $adresse->save();
            }

            $user->save();

            $commande = new Commande(null,$_SESSION["prixTotal"],date('Y-m-d H:i:s'),$_SESSION["mail"],$user->getIdAdresse(),1);
            $commande->save();
            foreach ($_SESSION["panier"] as $key=>$p){
                $lp = new Ligne_Commande_Produit(Commande::getLastCreated()->getIdCommande(),$key,$p);
                $lp->save();
            }
            $_SESSION["panier"] = array();

            $controller = "Commande";
            $view = "FinCommande";
            $pagetitle = "Merci de votre Commande";
            require_once(File::build_path(array("view","view.php")));
        }
    }

    public static function aboutUs(){
        $controller = null;
        $view = "Nous";
        $pagetitle = "About us";
        require_once(File::build_path(array("view","view.php")));
    }
}
