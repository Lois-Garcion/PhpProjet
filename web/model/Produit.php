<?php
require_once (File::build_path(array("model","Model.php")));
require_once (File::build_path(array("model","CustomError.php")));
class Produit{

    private $idProduit;
    private $prix;
    private $categorie;
    private $nomProduit;
    private $filepath;


    public function __construct($idProduit=null, $prix=null, $categorie=null, $nomProduit=null, $filepath=null) {
        if(!is_null($prix) &&!is_null($categorie) &&!is_null($nomProduit) && !is_null($filepath)) {
            $this->idProduit = $idProduit;
            $this->prix = $prix;
            $this->categorie = $categorie;
            $this->nomProduit = $nomProduit;
            $this->filepath = $filepath;
        }
    }

    /**
     * @return mixed
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * @param mixed $filepath
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;
    }



    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param mixed $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * @param mixed $nomProduit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;
    }


    public function save(){
        if(!self::getById($this->getIdProduit())) {
            $insert = "INSERT INTO p_produit(idProduit, prix, categorie, nomProduit,filepath) VALUES (:idProduit, :prix, :categorie, :nomProduit,:filepath)";
            try {
                $req_prep = Model::getPDO()->prepare($insert);
                $values = array("idProduit" => $this->getIdProduit(), "prix" => $this->getPrix(), "categorie" => $this->getCategorie(), "nomProduit" => $this->getNomProduit(),"filepath"=>$this->filepath);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e);
                return false;
            }
        }
        else {
            $update = "UPDATE p_produit SET prix = :prix, categorie = :categorie, nomProduit = :nomProduit, filepath = :filepath WHERE idProduit = :idProduit";
            try {
                $req_prep = Model::getPDO()->prepare($update);
                $values = array(
                    "prix" => $this->getPrix(),
                    "categorie" => $this->getCategorie(),
                    "nomProduit" => $this->getNomProduit(),
                    "idProduit" => $this->getIdProduit(),
                    "filepath" => $this->getFilepath()
                );
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e);
                return false;
            }
        }
    }

    public function deleteFile(){
        if($this->getFilepath() != null)
            if (!unlink($this->getFilepath())){
                CustomError::callError("Erreur lors de la suppression du fichier");
            }
        $this->setFilepath(null);
    }

    public function delete(){
        $sql = "DELETE FROM p_produit WHERE idProduit = :idProduit";
        $this->deleteFile();
        try {
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("idProduit" => $this->idProduit);
            $req_prep->execute($values);
        } catch(PDOException $e) {
            CustomError::callError($e->getMessage());
        }
    }












    /////////////////////////STATIC

    public static function getById($id){
        $sql ="SELECT * FROM p_produit WHERE idProduit = :id";

        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("id" => $id);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Produit');
            $produit =$req_prep->fetch();
            if($produit == null)return false;
            return $produit;
        }
        catch (PDOException $e){
            require_once(File::build_path(array("model","CustomeError.php")));
            CustomError::callError($e);
        }
    }

    public static function getAll(){
        $sql = "SELECT * FROM p_produit";
        try{
            $req_prep = Model::getPDO()->query($sql);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Produit');
            $tab_produit = $req_prep->fetchAll();
            if(empty($tab_produit)){
                return false;
            }
            return $tab_produit;
        }
        catch (PDOException $e){
            require_once(File::build_path(array("model","CustomeError.php")));
            CustomError::callError($e);
        }
    }

    public static function getAllSortedByAttribute($attribute,$order){

        if($attribute == null){
            $tab_produit = Produit::getAll();
            return $tab_produit;
        }
        else {
            if($order == null){
                $sql = "SELECT * FROM p_produit ORDER BY :attribute";
            }
            else {
                $sql = "SELECT * FROM p_produit ORDER BY :attribute :order";
            }
        }
        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Produit');
            $values = array("attribute" => $attribute, "order"=>$order);
            $req_prep->execute($values);
            $tab_produit =$req_prep->fetchAll();
            if(empty($tab_produit))return false;
            return $tab_produit;
        }
        catch (PDOException $e){
            require_once(File::build_path(array("model","CustomeError.php")));
            CustomError::callError($e);
        }
    }

    public static function getAllByCategorie($categorie){
            $sql = "SELECT * FROM p_produit WHERE categorie = :categorie ";
        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("categorie" => $categorie);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Produit');
            $tab_produit =$req_prep->fetchAll();
            if(empty($tab_produit))return false;
            return $tab_produit;
        }
        catch (PDOException $e){
            require_once(File::build_path(array("model","CustomeError.php")));
            CustomError::callError($e);
        }
    }

    public static function getAllByMinMaxPrice($minPrix,$maxPrix){
            $sql = "SELECT * FROM p_produit WHERE prix >= :minPrix AND prix <= :maxPrix ";
        try{
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("minPrix" => $minPrix,"maxPrix"=> $maxPrix);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Produit');
            $tab_produit =$req_prep->fetchAll();
            if(empty($tab_produit))return false;
            return $tab_produit;
        }
        catch (PDOException $e){
            require_once(File::build_path(array("model","CustomeError.php")));
            CustomError::callError($e);
        }
    }


        public static function search($search){
            $sql = "SELECT * FROM p_produit WHERE prix LIKE :search OR categorie LIKE :search OR nomProduit LIKE :search";
            try{
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array("search"=>"%".$search."%");
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Produit');
                $tab_produit = $req_prep->fetchAll();
                if(empty($tab_produit)){
                    return false;
                }
                return $tab_produit;
            }
            catch (PDOException $e){
                CustomError::callError($e);
            }

        }
}