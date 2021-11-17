<?php
require_once (File::build_path(array("model","Model.php")));
require_once (File::build_path(array("model","CustomError.php")));
class Utilisateur
{
    private $adresseMail;
    private $mdp;
    private $nom = null;
    private $prenom = null;
    private $telephone= null;
    private $idAdressePrincipale= null;
    private $admin = null;

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
            $this->admin = 0;
        }
        elseif(!is_null($adresseMail) && !is_null($mdp)) {
            $this->adresseMail = $adresseMail;
            $this->mdp = $mdp;
        }
    }

    /**
     * @return int|null
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param int|null $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
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

    public function save(){
        $sql = "INSERT INTO p_utilisateur (adresseMail,mdp) VALUES(:mail,:mdp)";
        try {
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("mail" => $this->getAdresseMail(), "mdp" => $this->getMdp());
            $req_prep->execute($values);
            return true;
        }
        catch (PDOException $e){
            CustomError::callError($e);
        }

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

    public static function getUserByLogin($mail){
        $sql = "SELECT * FROM p_utilisateur WHERE adresseMail = :mail";
        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("mail" => $mail);
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