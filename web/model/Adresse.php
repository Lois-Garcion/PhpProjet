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
    public function __construct($idAdresse, $codePostal, $ville, $numeroHabitation, $nomRue, $complement, $adresseMailUtilisateur)
    {
        if (!is_null($idAdresse) && !is_null($codePostal) && !is_null($ville) && !is_null($numeroHabitation) && !is_null($nomRue) && !is_null($complement) && !is_null($adresseMailUtilisateur)) {
            $this->idAdresse = $idAdresse;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->numeroHabitation = $numeroHabitation;
            $this->nomRue = $nomRue;
            $this->complement = $complement;
            $this->adresseMailUtilisateur = $adresseMailUtilisateur;
        }
    }

    public function save(){
        if(is_null($this->adresseMailUtilisateur)) {
            $sql = "INSERT INTO p_adresse (codePostal,ville,numeroHabitation,nomRue,complement,adresseMailUtilisateur) VALUES(:codePostal,:ville,:numeroHabitation,:nomRue,:complement,:adresseMailUtilisateur)";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array("codePostal" => $this->codePostal, "ville" => $this->ville(), "numeroHabitation" => $this->numeroHabitation, "nomRue"=>$this->nomRue, "complement"=>$this->complement, "adresseMailUtilisateur"=>$this->adresseMailUtilisateur);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e);
            }
        }
        else {
            $sql = "UPDATE p_adresse SET codePostal = :codePostal, ville = :ville, numeroHabitation = :numeroHabitation, nomRue = :nomRue, complement = :complement WHERE adresseMailUtilisateur = :adresseMailUtilisateur";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    "codePostal" => $this->codePostal,
                    "ville" => $this->ville,
                    "numeroHabitation" => $this->numeroHabitation,
                    "nomRue" => $this->nomRue,
                    "complement"=> $this->complement,
                    "adresseMailUtilisateur"=>$this->adresseMailUtilisateur);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                require_once('./model/CustomError.php');
                CustomError::callError($e->getMessage());
                return false;
            }
        }

    }




}