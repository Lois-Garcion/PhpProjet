<?php
require_once (File::build_path(array("model","Model.php")));
class Produit{

    private $idProduit;
    private $prix;
    private $categorie;
    private $nomProduit;


    public function __construct($idProduit=null, $prix=null, $categorie=null, $nomProduit=null) {
        if(!is_null($idProduit) && !is_null($prix) &&!is_null($categorie) &&!is_null($nomProduit)) {
            $this->idProduit = $idProduit;
            $this->prix = $prix;
            $this->categorie = $categorie;
            $this->nomProduit = $nomProduit;
        }
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
        }
    }

    public static function getAllSortedByAttribute($attribute,$order){

        if($attribute == null){
            $tab_produit = getAll();
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
        }
    }

    public static function getAllByCategorie($categorie){

        if($categorie){
            $tab_produit = getAll();
            return $tab_produit;
        }
        else {
            $sql = "SELECT * FROM p_produit WHERE categorie = :categorie ";
        }
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
        }
    }

    public static function getAllByMinMaxPrice($minPrix,$maxPrix){
        if($minPrix == null & $maxPrix == null){
            $tab_produit = getAll();
            return $tab_produit;
        }
        else {
            $sql = "SELECT * FROM p_produit WHERE prix > :minPrix AND prix < :maxPrix ";
        }
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
        }
    }







}