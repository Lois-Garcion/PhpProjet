<h1>Mon profil</h1>
<hr />

    <div class="box">
        <div class="line">
            <p>Nom: </p>
            <p style="border: 1px solid"><?php if(!is_null($_SESSION["nom"])){echo $_SESSION["nom"];} else {echo "Vous n'avez pas renseigné cet élément !";}?></p>
        </div>
        <div class="line">
            <p>Prénom: </p>
            <p style="border: 1px solid"><?php if(!is_null($_SESSION["prenom"])){echo $_SESSION["prenom"];} else {echo "Vous n'avez pas renseigné cet élément !";}?></p>
        </div>
        <div class="open-btn">
            <button class="open-button" onclick="openForm()"><strong>Modifier ces informations</strong></button>
        </div>
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
        <div class="line">
            <p>Adresse mail: (Il s'agit de votre login) </p>
            <p style="border: 1px solid"><?php if(!is_null($_SESSION["mail"])){echo $_SESSION["mail"];} else {echo "Vous n'avez pas renseigné cet élément !";}?></p>
        </div>
        <p>Vous ne pouvez pas modifier cette information</p>
    </div>

    <div class="box">
        <div class="line">
            <p>Numéro de téléphone: </p>
            <p style="border: 1px solid"><?php if(!is_null($_SESSION["telephone"])){echo $_SESSION["telephone"];} else {echo "Vous n'avez pas renseigné cet élément !";}?></p>
        </div>
        <div class="open-btn">
            <button class="open-button" onclick="openForm()"><strong>Modifier mon numéro</strong></button>
        </div>
        <div class="login-popup">
            <div class="form-popup" id="popupForm">
                <form action="?controller=ControllerUtilisateur&action=updatePhone" method="post" class="form-container">
                    <h2>Changer mes informations</h2>
                    <label for="telephone">
                        <strong>Téléphone</strong>
                    </label>
                    <input type="text" id="telephone" placeholder="Votre numéro" name="telephone" required>
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
