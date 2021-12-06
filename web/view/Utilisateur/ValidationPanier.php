
<?php
if(!is_null($_SESSION["idAdresse"])) {
    $adresse = Adresse::getById($_SESSION["idAdresse"]);
}
else{
    $adresse = false;
}
?>
<body id="validationPanier">
<div class="validation-container">
    <div class="validation-text">Valider la commande</div>
    <div class="validation-text-total">Montant total de la commande : <?php echo $_SESSION["prixTotal"] . "€"; ?></div>
    <div class="validation-text-informations">Vos informations</div>
    <form method="post" action="?controller=ControllerUtilisateur&action=finaliserPanier">
        <div class="validation-form-row">
            <div class="validation-input-data">
                <input type="text" name="nom" value="<?php if(isset($_SESSION["nom"]))echo $_SESSION["nom"];?>" placeholder="Nom" required>
            </div>
            <div class="validation-input-data">
                <input type="text" placeholder="Prénom" name="prenom" value="<?php if(isset($_SESSION["prenom"]))echo $_SESSION["prenom"];?>" required>
            </div>
        </div>
        <div class="validation-form-row">
            <div class="validation-input-data">
                <input type="number" placeholder="Téléphone" name="telephone" value="<?php if(isset($_SESSION["telephone"]))echo $_SESSION["telephone"];?>"maxlength="10" required>
            </div>
            <div class="validation-input-data">
                <input type="text" placeholder="Ville" name="ville" value="<?php if($adresse)echo $adresse->getVille();?>" required>
            </div>
        </div>
        <div class="validation-form-row">
            <div class="validation-input-data">
                <input type="text" placeholder="Numéro habitation" name="numeroHabitation" value="<?php if($adresse)echo $adresse->getNumeroHabitation();?>" required>
            </div>
            <div class="validation-input-data">
                <input type="text" placeholder="Nom de la rue" name="nomRue" value="<?php if($adresse)echo $adresse->getNomRue();?>" required>
            </div>
            <div class="validation-input-data">
                <input type="number" placeholder="Code postal" name="codePostal" value="<?php if($adresse)echo $adresse->getCodePostal();?>" required>
            </div>
        </div>

        <div class="validation-form-row">
            <div class="validation-input-data">
                <input type="text" placeholder="Complément d'adresse" name="complement" value="<?php if($adresse)echo $adresse->getComplement();?>">
                <br />
                <div class="validation-form-row submit-btn">
                    <div class="validation-input-data">
                        <div class="inner1"></div>
                        <input type="submit" value="Valider">
                    </div>
                    <div class="validation-input-data">
                        <div class="inner2"></div>
                        <input type="button" onclick="location.href='?controller=ControllerUtilisateur&action=annulerPanier'" value="Annuler">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
