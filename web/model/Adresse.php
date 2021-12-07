<?php
require_once (File::build_path(array("model","Model.php")));
require_once (File::build_path(array("model","CustomError.php")));
class Adresse
{
    private $idAdresse;
    private $codePostal;
    private $ville;
    private $numeroHabitation;
    private $nomRue;
    private $complement;
    private $adresseMailUtilisateur;

    /**
     * @param $idAdresse
     * @param $codePostal
     * @param $ville
     * @param $numeroHabitation
     * @param $nomRue
     * @param $complement
     * @param $adresseMailUtilisateur
     */
    public function __construct($idAdresse=null, $codePostal=null, $ville=null, $numeroHabitation=null, $nomRue=null, $complement=null, $adresseMailUtilisateur=null)
    {
        if (!is_null($codePostal) && !is_null($ville) && !is_null($numeroHabitation) && !is_null($nomRue) && !is_null($complement) && !is_null($adresseMailUtilisateur)) {
            $this->idAdresse = $idAdresse;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->numeroHabitation = $numeroHabitation;
            $this->nomRue = $nomRue;
            $this->complement = $complement;
            $this->adresseMailUtilisateur = $adresseMailUtilisateur;
        }
        if (!is_null($codePostal) && !is_null($ville) && !is_null($numeroHabitation) && !is_null($nomRue)&& !is_null($adresseMailUtilisateur)) {
            $this->idAdresse = $idAdresse;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->numeroHabitation = $numeroHabitation;
            $this->nomRue = $nomRue;
            $this->complement = $complement;
            $this->adresseMailUtilisateur = $adresseMailUtilisateur;
        }

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
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getNumeroHabitation()
    {
        return $this->numeroHabitation;
    }

    /**
     * @param mixed $numeroHabitation
     */
    public function setNumeroHabitation($numeroHabitation)
    {
        $this->numeroHabitation = $numeroHabitation;
    }

    /**
     * @return mixed
     */
    public function getNomRue()
    {
        return $this->nomRue;
    }

    /**
     * @param mixed $nomRue
     */
    public function setNomRue($nomRue)
    {
        $this->nomRue = $nomRue;
    }

    /**
     * @return mixed
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param mixed $complement
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
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



    public function save(){
        if(is_null($this->idAdresse)) {
            $sql = "INSERT INTO p_adresse (idAdresse,codePostal,ville,numeroHabitation,nomRue,complement,adresseMailUtilisateur) VALUES(null,:codePostal,:ville,:numeroHabitation,:nomRue,:complement,:adresseMailUtilisateur)";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array("codePostal" => $this->codePostal, "ville" => $this->ville, "numeroHabitation" => $this->numeroHabitation, "nomRue"=>$this->nomRue, "complement"=>$this->complement, "adresseMailUtilisateur"=>$this->adresseMailUtilisateur);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e);
            }
        }
        else {
            $sql = "UPDATE p_adresse SET codePostal = :codePostal, ville = :ville, numeroHabitation = :numeroHabitation, nomRue = :nomRue, complement = :complement WHERE idAdresse = :idAdresse";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    "codePostal" => $this->codePostal,
                    "ville" => $this->ville,
                    "numeroHabitation" => $this->numeroHabitation,
                    "nomRue" => $this->nomRue,
                    "complement"=> $this->complement,
                    "idAdresse"=>$this->idAdresse);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                require_once('./model/CustomError.php');
                CustomError::callError($e->getMessage());
                return false;
            }
        }
    }




    ///////////////STATIC



    public static function getById($id){
        $sql ="SELECT * FROM p_adresse WHERE idAdresse = :id";

        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("id" => $id);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Adresse');
            $adresse =$req_prep->fetch();
            if($adresse == null)return false;
            return $adresse;
        }
        catch (PDOException $e){
            require_once(File::build_path(array("model","CustomeError.php")));
            CustomError::callError($e);
        }
    }

    public static function getLastCreated(){
        $sql ="SELECT * FROM p_adresse WHERE idAdresse = (SELECT MAX(idAdresse) FROM p_adresse)";

        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Adresse');
            $adresse =$req_prep->fetch();
            if($adresse == null)return false;
            return $adresse;
        }
        catch (PDOException $e){
            require_once(File::build_path(array("model","CustomError.php")));
            CustomError::callError($e);
        }
    }




}