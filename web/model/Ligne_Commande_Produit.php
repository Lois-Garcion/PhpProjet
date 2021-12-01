<?php
require_once (File::build_path(array("model","Model.php")));
require_once (File::build_path(array("model","CustomError.php")));
require_once (FIle::build_path(array("model","Commande.php")));
class Ligne_Commande_Produit
{
    private $idCommande;
    private $idProduit;
    private $quantite;

    public function __construct($idProduit = null, $idCommande = null, $quantite = null)
    {
        if (!is_null($idCommande) && !is_null($idProduit) && !is_null($quantite)) {
            $this->idProduit = Produit::getById($idProduit);
            $this->idCommande = $idCommande;
            $this->quantite = $quantite;
        }
    }

    /**
     * @return mixed
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * @return false|void
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $idCommande
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    /**
     * @param false|void $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }


    public static function getAllByIdCommande($idCommande)
    {
        $sql = "SELECT * FROM p_ligne_commande_produit WHERE idCommande = :id";

        try {
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array("id" => $idCommande);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Ligne_Commande_Produit');
            $tab_ligneCP = $req_prep->fetchAll();

            if (empty($tab_ligneCP)) return false;
            return $tab_ligneCP;
        } catch (PDOException $e) {
            CustomError::callError($e);
        }
    }



}