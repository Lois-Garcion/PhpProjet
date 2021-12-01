 <h1>Connexion</h1>
    <hr />
        <form action="?controller=ControllerUtilisateur&action=connect" method="post">
                <label>login</label>
                <input type="email" name="mail" placeholder="Entrez votre mail">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="Entrez votre mot de passe">
                <input type="submit" class="button" value="Login">
        </form>
 <p>Vous n'avez pas de compte?</p>

    <a href="?controller=ControllerUtilisateur&action=inscription" style="color:black">S'inscrire</a>
