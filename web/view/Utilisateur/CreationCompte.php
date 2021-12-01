<h1>Connexion</h1>
<hr />
<form action="?controller=ControllerUtilisateur&action=created" method="post">
    <label>login</label>
    <input type="email" name="login" placeholder="Entrez votre adresse mail">
    <label>Mot de passe</label>
    <input type="password" name="password" placeholder="Entrez votre mot de passe">
    <input type="password" name="validationPassword" placeholder="Confirmez votre mot de passe">
    <input type="submit" class="button" value="create">
</form>
<?php //TODO METTRE TOUTES LES INFOS D'UN UTILISATEUR (en gros son nom, son prenom, son telephone, ...)?>
