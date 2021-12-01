<?php
require_once (File::build_path(array("model","Model.php")));
require_once (File::build_path(array("model","CustomError.php")));
class Utilisateur
{
    private $adresseMail;
    private $mdp;
    private $nom;
    private $prenom;
    private $telephone;
    private $admin;
    private $nonce;

    /**
     * @param $adresseMail
     * @param $mdp
     * @param $nom
     * @param $prenom
     * @param $telephone
     * @param $idAdressePrincipale
     */
    public function __construct($adresseMail = null, $mdp=null,$nonce=null, $nom=null, $prenom=null, $telephone=null)
    {
        if(!is_null($adresseMail) && !is_null($mdp) && !is_null($nom) && !is_null($prenom) && !is_null($telephone)&& !is_null($nonce)) {
            $this->adresseMail = $adresseMail;
            $this->mdp = $mdp;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->telephone = $telephone;
            $this->admin = 0;
            $this->nonce= $nonce;
        }
        elseif(!is_null($adresseMail) && !is_null($mdp) && !is_null($nonce)) {
            $this->adresseMail = $adresseMail;
            $this->mdp = $mdp;
            $this->nonce = $nonce;
            $this->admin=0;
        }
    }

    /**
     * @return mixed|null
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    /**
     * @param mixed|null $nonce
     */
    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
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



    public function save(){
        if(!self::getUserByLogin($this->adresseMail)){
            $sql = "INSERT INTO p_utilisateur (adresseMail,mdp,nonce) VALUES(:mail,:mdp,:nonce)";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array("mail" => $this->getAdresseMail(), "mdp" => $this->getMdp(),"nonce" => $this->getNonce());
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e);
            }
        }
        else {
            $sql = "UPDATE p_utilisateur SET mdp = :mdp, nom = :nom, prenom = :prenom, telephone = :telephone, admin = :admin, nonce = :nonce WHERE adresseMail = :adresseMail";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    "mdp" => $this->mdp,
                    "nom" => $this->nom,
                    "prenom" => $this->prenom,
                    "telephone" => $this->telephone,
                    "admin" => $this->admin,
                    "adresseMail"=> $this->adresseMail,
                    "nonce"=>$this->nonce);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                require_once('./model/CustomError.php');
                CustomError::callError($e->getMessage());
                return false;
            }
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