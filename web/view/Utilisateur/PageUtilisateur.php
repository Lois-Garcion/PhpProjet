<h1>Mon profil</h1>
<hr />

    <div class="box">
      <ul class="listInfos">
        <li class="infoTitle"><p>Nom: </p></li>
        <li class="info"><p style="border: 1px solid"><?php if(!is_null($_SESSION["nom"])){echo $_SESSION["nom"];} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
        <li class="infoTitle"><p>Prénom: </p></li>
        <li class="info"><p style="border: 1px solid"><?php if(!is_null($_SESSION["prenom"])){echo $_SESSION["prenom"];} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
        <li class="open-btn"><button class="open-button" onclick="openForm()"><strong>Modifier ces informations</strong></button></li>
      </ul>

        <div class="login-popup">
            <div class="form-popup" id="popupForm">
                <form action="?controller=ControllerUtilisateur&action=updateNames" method="post" class="form-container">
                    <h2>Changer mes informations</h2>
                    <label for="nom">
                        <strong>Nom</strong>
                    </label>
                    <input type="text" id="nom" placeholder="Votre nom" name="nom" required>
                    <label for="prenom">
                        <strong>Prénom</strong>
                    </label>
                    <input type="text" id="prenom" placeholder="Votre prénom" name="prenom" required>
                    <button type="submit" class="btn">Enregistrer</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
                </form>
            </div>
        </div>
        <script>
            function openForm() {
                document.getElementById("popupForm").style.display="block";
            }

            function closeForm() {
                document.getElementById("popupForm").style.display="none";
            }
        </script>
    </div>


    <div class="box">
      <ul class="listInfos">
        <li class="infoTitle"><p>Adresse mail: (Il s'agit de votre login) </p></li>
        <li class="info"><p style="border: 1px solid"><?php if(!is_null($_SESSION["mail"])){echo $_SESSION["mail"];} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
        <li class="info"><p>Vous ne pouvez pas modifier cette information. </p></li>
      </ul>
    </div>

    <div class="box">
      <ul class="listInfos">
        <li class="infoTitle"><p>Numéro de téléphone: </p></li>
        <li class="info"><p style="border: 1px solid"><?php if(!is_null($_SESSION["telephone"])){echo $_SESSION["telephone"];} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
        <li class="open-btn"><button class="open-button" onclick="openForm2()"><strong>Modifier mon numéro</strong></button></li>
      </ul>

      <div class="login-popup">
          <div class="form-popup" id="popupForm2">
              <form action="?controller=ControllerUtilisateur&action=updatePhone" method="post" class="form-container">
                  <h2>Changer mes informations</h2>
                  <label for="telephone">
                      <strong>Téléphone</strong>
                  </label>
                  <input type="text" id="telephone" placeholder="Votre numéro" name="telephone" required>
                  <button type="submit" class="btn">Enregistrer</button>
                  <button type="button" class="btn cancel" onclick="closeForm2()">Annuler</button>
              </form>
          </div>
      </div>
      <script>
          function openForm2() {
              document.getElementById("popupForm2").style.display="block";
          }

          function closeForm2() {
              document.getElementById("popupForm2").style.display="none";
          }
      </script>
  </div>

    <div class="box">
        <ul class="listInfos">
            <li class="infoTitle"><p>Mon adresse:</p></li>
            <li class="infoTitle"><p>Numero logement: </p></li>
            <li class="info"><p style="border: 1px solid"><?php if(!is_null($adresse)){echo $adresse->getNumeroHabitation();} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
            <li class="infoTitle"><p>Intitulé rue: </p></li>
            <li class="info"><p style="border: 1px solid"><?php if(!is_null($adresse)){echo $adresse->getNomRue();} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
            <li class="infoTitle"><p>Complément d'adresse: </p></li>
            <li class="info"><p style="border: 1px solid"><?php if(!is_null($adresse)){echo $adresse->getComplement();} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
            <li class="infoTitle"><p>Code postal: </p></li>
            <li class="info"><p style="border: 1px solid"><?php if(!is_null($adresse)){echo $adresse->getCodePostal();} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
            <li class="infoTitle"><p>Ville: </p></li>
            <li class="info"><p style="border: 1px solid"><?php if(!is_null($adresse)){echo $adresse->getVille();} else {echo "Vous n'avez pas renseigné cet élément !";}?></p></li>
            <li class="open-btn"><button class="open-button" onclick="openForm3()"><strong>Modifier mon adresse ou ses informations</strong></button></li>
        </div>
        
        <div class="login-popup">
            <div class="form-popup" id="popupForm3">
                <form action="?controller=ControllerUtilisateur&action=updateAdresse" method="post" class="form-container">
                    <h2>Changer mes informations</h2>
                    <label for="numeroHabitation">
                        <strong>Numéro logement: </strong>
                    </label>
                    <input type="text" id="numeroHabitation" placeholder="Numéro du logement" name="numeroHabitation" required>
                    <label for="nomRue">
                        <strong>Nom de la rue</strong>
                    </label>
                    <input type="text" id="nomRue" placeholder="Nom de la rue" name="nomRue" required>
                    <label for="complement">
                        <strong>Complément d'adresse</strong>
                    </label>
                    <input type="text" id="complement" placeholder="Complément d'adresse" name="complement" required>
                    <label for="codePostal">
                        <strong>Code postal</strong>
                    </label>
                    <input type="text" id="codePostal" placeholder="Code postal" name="codePostal" required>
                    <label for="ville">
                        <strong>Ville</strong>
                    </label>
                    <input type="text" id="ville" placeholder="Ville" name="ville" required>
                    <button type="submit" class="btn">Enregistrer</button>
                    <button type="button" class="btn cancel" onclick="closeForm3()">Annuler</button>
                </form>
            </div>
        </div>
        <script>
            function openForm3() {
                document.getElementById("popupForm3").style.display="block";
            }

            function closeForm3() {
                document.getElementById("popupForm3").style.display="none";
            }
        </script>
    </div>
