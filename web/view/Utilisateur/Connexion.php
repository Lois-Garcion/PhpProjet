
     <div class="connect-container">
         <div class="text">
             Connexion
         </div>
         <form action="?controller=ControllerUtilisateur&action=connect" method="post">
             <div class="data">
                 <label>Adresse mail</label>
                 <input type="email" name="mail" placeholder="Entrez votre mail" required>
             </div>
             <div class="data">
                 <label>Mot de passe</label>
                 <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
             </div>
             <div class="btn">
                 <div class="inner"></div>
                 <button type="submit">Se connecter</button>
             </div>
             <div class="signup-link">
                 Pas encore membre ? <a href="?controller=ControllerUtilisateur&action=inscription">Inscrivez-vous ici</a>
             </div>
         </form>
     </div>
