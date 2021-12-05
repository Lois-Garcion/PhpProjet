<?php
require_once (File::build_path(array("model","CustomError.php")));
require_once (File::build_path(array("model","Utilisateur.php")));
require_once (File::build_path(array("model","Produit.php")));
require_once (File::build_path(array("model","Adresse.php")));
require_once (File::build_path(array("model","Commande.php")));
require_once (File::build_path(array("model","Ligne_Commande_Produit.php")));
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
        $tab_produit = Produit::getAllByCategorie($_GET['categorie']);

        $controller = "Produit";
        $view = "ListProduit";
        $pagetitle = "Boutique de la calle";

        require_once(File::build_path(array("view","view.php")));
    }
    public static function readAllMinPriceMaxPrice(){
        require_once(File::build_path(array("model","Produit.php")));

        if(!isset($_POST["maxPrice"])){
            $_POST["maxPrice"] = 100000000;
        }
        if(!isset($_POST["minPrice"])){
            $_POST["minPrice"] = 0;
        }
        $tab_produit = Produit::getAllByMinMaxPrice($_POST["minPrice"],$_POST["maxPrice"]);

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

    public static function created(){
        require_once(File::build_path(array("model", "Produit.php")));

        require("model/ModelGenome.php");
        if(isset($_POST['submit'])) {
            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            //list des extensions que l'on accepte je sais pas si il en aura plus
            $allow = array('png','jpg','jpeg');

            if (in_array($fileActualExt, $allow)) {
                if ($fileError === 0) {
                    if ($fileSize < 1000000) {  //IL FAUDRA DEFINIR LA TAILLE MAX DU FICHIER pour l'instant c'est 1 million de kylobites
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'uploads/genome/' . $fileNameNew;
                        $moved = move_uploaded_file($fileTmpName, $fileDestination);
                        if ($moved === false) {
                            CustomError::callError("Le fichier n'a pas été déplacé");
                        }
                    } else {
                        CustomError::callError("Ce fichier est trop lourd");
                    }
                } else {
                    CustomError::callError("Le fichier comporte une erreur");
                }
            }
            else{
                CustomError::callError("Ce type de fichier n'est pas autorisée");
            }
        }


        $produit = new Produit($_POST["idProduit"], $_POST["prix"], $_POST["categorie"], $_POST["nomProduit"],);
        $produit->save();
        header("location: ./?controller=ControllerProduit&action=readAll");
    }

    public static function formProduit(){
        $controller= "Produit";
        $view = "formProduit";
        $pagetitle = "Formulaire";
        require_once(File::build_path(array("view","view.php")));
    }
}