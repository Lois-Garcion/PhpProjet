<?php
require_once (File::build_path(array("model","Model.php")));
require_once (File::build_path(array("model","CustomError.php")));
class Commande
{

    private $idCommande;
    private $montant;
    private $date;
    private $adresseMailUtilisateur;
    private $idAdresse;
    private $fini;


    /**
     * @param $idCommande
     * @param $montant
     * @param $date
     * @param $adresseMailUtilisateur
     * @param $idAdresse
     * @param $fini
     */
    public function __construct($idCommande = null, $montant= null, $date= null, $adresseMailUtilisateur= null, $idAdresse= null, $fini= null)
    {
        if(!is_null($montant) &&!is_null($date) &&!is_null($idAdresse)&&!is_null($adresseMailUtilisateur)&&!is_null($fini) ) {
            $this->idCommande = $idCommande;
            $this->montant = $montant;
            $this->date = $date;
            $this->adresseMailUtilisateur = $adresseMailUtilisateur;
            $this->idAdresse = $idAdresse;
            $this->fini = $fini;
        }
    }

    /**
     * @return mixed|null
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * @param mixed|null $idCommande
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAdresseMailUtilisateur()
    {
        return $this->adresseMailUtilisateur;
    }

    /**
     * @param mixed $adresseMailUtilisateur
     */
    public function setAdresseMailUtilisateur($adresseMailUtilisateur)
    {
        $this->adresseMailUtilisateur = $adresseMailUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getIdAdresse()
    {
        return $this->idAdresse;
    }

    /**
     * @param mixed $idAdresse
     */
    public function setIdAdresse($idAdresse)
    {
        $this->idAdresse = $idAdresse;
    }

    /**
     * @return mixed
     */
    public function getFini()
    {
        return $this->fini;
    }

    /**
     * @param mixed $fini
     */
    public function setFini($fini)
    {
        $this->fini = $fini;
    }



    public function save(){
            $sql = "INSERT INTO p_commande (idCommande,montant,date,adresseMailUtilisateur,idAdresse,fini) VALUES(null,:montant,:date,:mail,:adresse,1)";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array("montant" => $this->montant, "date" => $this->date, "mail" => $this->adresseMailUtilisateur, "adresse"=>$this->idAdresse);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e);
            }
        }

    //////////////STATIC


    public static function getById($id)
    {
        $sql = "SELECT * FROM p_commande WHERE idCommande = :id";

        try {
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("id" => $id);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Commande');
            $commande = $req_prep->fetch();
            if ($commande == null) return false;
            return $commande;
        } catch (PDOException $e) {
            CustomError::callError($e);
        }
    }

    public static function getAll()
    {
        $sql = "SELECT * FROM p_commande ORDER BY DESC date";
        try {
            $req_prep = Model::getPDO()->query($sql);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Commande');
            $tab_commande = $req_prep->fetchAll();
            if (empty($tab_commande)) {
                return false;
            }
            return $tab_commande;
        } catch (PDOException $e) {
            CustomError::callError($e);
        }
    }

    public static function getAllByMail($mail){
        $sql = "SELECT * FROM p_commande WHERE adresseMailUtilisateur = :adresseMail";
        try {
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("adresseMail" => $mail);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Commande');
            $tab_commande = $req_prep->fetchAll();
            if (empty($tab_commande)) {
                return false;
            }
            return $tab_commande;
        } catch (PDOException $e) {
            CustomError::callError($e);
        }
    }


//changer pour trier les commandes
    public static function getAllSortedByAttributeByIdUser($attribute, $order, $mail)
    {

        if ($attribute == null) {
            $tab_produit = getAll();
            return $tab_produit;
        } else {
            if ($order == null) {
                $sql = "SELECT * FROM p_produit WHERE adresseMailUtilisateur = :mail ORDER BY :attribute";
            } else {
                $sql = "SELECT * FROM p_produit ORDER BY :attribute :order";
            }
        }
        try {
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Produit');
            $values = array("mail" => $mail, "attribute" => $attribute, "order" => $order);
            $req_prep->execute($values);
            $tab_produit = $req_prep->fetchAll();
            if (empty($tab_produit)) return false;
            return $tab_produit;
        } catch (PDOException $e) {
            CustomError::callError($e);
        }
    }

    public static function getActiveCommandByUser($mail){
        $sql = "SELECT idCommande FROM p_commande WHERE adresseMailUtilisateur = :mail AND fini = 0;";
        try {
            $req_prep = Model::getPDO()->query($sql);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $idCommand = $req_prep->fetchAll();
            if (empty($idCommand)) {
                return false;
            }
            return $idCommand;
        } catch (PDOException $e) {
            CustomError::callError($e);
        }
    }

    public static function getLastCreated(){
        $sql ="SELECT * FROM p_commande WHERE idCommande = (SELECT MAX(idCommande) FROM p_commande)";

        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Commande');
            $commande =$req_prep->fetch();
            if($commande == null)return false;
            return $commande;
        }
        catch (PDOException $e){
            require_once(File::build_path(array("model","CustomError.php")));
            CustomError::callError($e);
        }
    }

}

