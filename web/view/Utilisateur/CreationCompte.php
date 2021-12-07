<div class="connect-container">
    <div class="text">
        Inscription
    </div>
    <form action="?controller=ControllerUtilisateur&action=created" method="post">
        <div class="data">
            <label>Adresse mail</label>
            <input type="email" name="login" placeholder="Entrez votre adresse mail" required>
        </div>
        <div class="data">
            <label>Mot de passe</label>
            <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
        </div>
        <div class="data">
            <label>Confirmation mot de passe</label>
            <input type="password" name="validationPassword" placeholder="Confirmez votre mot de passe" required>
        </div>
        <div class="btn">
            <div class="inner"></div>
            <button type="submit">Créer un compte</button>
        </div>
    </form>
</div>
