<h1>Validation de la commande</h1>

<h2>Recapitulatif</h2>
<?php
if(!is_null($_SESSION["idAdresse"])) {
    $adresse = Adresse::getById($_SESSION["idAdresse"]);
}
else{
    $adresse = false;
}


echo "<p>Prix total : " . $_SESSION["prixTotal"]."</p>";
echo "<p>Vos informations : </p>";
?>
<form method="post" action="?controller=ControllerUtilisateur&action=finaliserPanier">
    <label>Nom</label>
    <input type="text" name="nom" value="<?php if(isset($_SESSION["nom"]))echo $_SESSION["nom"];?>" required>
    <label>Prenom</label>
    <input type="text" name="prenom" value="<?php if(isset($_SESSION["prenom"]))echo $_SESSION["prenom"];?>" required>
    <label>Telephone</label>
    <input type="number" name="telephone" value="<?php if(isset($_SESSION["telephone"]))echo $_SESSION["telephone"];?>"maxlength="10" required>
    <label>Adresse</label>
    <label>Code Postal</label>
    <input type="number" name="codePostal" value="<?php if($Adresse)echo $adresse->getCodePostal();?>" required>
    <label>Ville</label>
    <input type="text" name="ville" value="<?php if($adresse)echo $adresse->getVille();?>" required>
    <label>numero d'habitation</label>
    <input type="number" name="numeroHabitation" value="<?php if($adresse)echo $adresse->getNumeroHabitation();?>" required>
    <label>Nom de la rue</label>
    <input type="text" name="nomRue" value="<?php if($adresse)echo $adresse->getNomRue();?>" required>
    <label>Complément d'adresse</label>
    <input type="text" name="complement" value="<?php if($adresse)echo $adresse->getComplement();?>">
    <input type="submit" class=\"button\" value="Valider">
</form>

    <a href="?controller=ControllerUtilisateur&action=annulerPanier">Annuler la commande</a>
</form>";




