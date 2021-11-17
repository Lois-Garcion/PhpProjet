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
        $sql = "SELECT * FROM p_commande ORDER BY date";
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
}

