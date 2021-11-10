<?php
require_once (File::build_path(array("model","Model.php")));
class Utilisateur
{
    private $adresseMail;
    private $mdp;
    private $nom;
    private $prenom;
    private $telephone;
    private $idAdressePrincipale;

    /**
     * @param $adresseMail
     * @param $mdp
     * @param $nom
     * @param $prenom
     * @param $telephone
     * @param $idAdressePrincipale
     */
    public function __construct($adresseMail = null, $mdp=null, $nom=null, $prenom=null, $telephone=null, $idAdressePrincipale=null)
    {
        if(!is_null($adresseMail) && !is_null($mdp) && !is_null($nom) && !is_null($prenom) && !is_null($telephone) && !is_null($idAdressePrincipale)) {
            $this->adresseMail = $adresseMail;
            $this->mdp = $mdp;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->telephone = $telephone;
            $this->idAdressePrincipale = $idAdressePrincipale;
        }
    }


    /**
     * @return mixed
     */
    public function getAdresseMail()
    {
        return $this->adresseMail;
    }

    /**
     * @param mixed $adresseMail
     */
    public function setAdresseMail($adresseMail)
    {
        $this->adresseMail = $adresseMail;
    }

    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getIdAdressePrincipale()
    {
        return $this->idAdressePrincipale;
    }

    /**
     * @param mixed $idAdressePrincipale
     */
    public function setIdAdressePrincipale($idAdressePrincipale)
    {
        $this->idAdressePrincipale = $idAdressePrincipale;
    }


    #############################################
    //FONCTION STATIC
    #############################################


    public static function getUserByLoginAndPassword($mail,$password){
        $sql = "SELECT * FROM p_utilisateur WHERE adresseMail = :mail AND mdp= :password ";
        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("mail" => $mail,"password" => $password);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
            $user =$req_prep->fetch();
            if($user===null){
                return false;
            }
            return $user;
        }
        catch (PDOException $e){
            CustomError::callError($e);
        }

    }


}