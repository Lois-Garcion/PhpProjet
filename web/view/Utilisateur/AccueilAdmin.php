<p>Ici c'est l'accueil admin, tout le monde est super cool</p>

<h2>Ajouter un admin</h2>

<form method="post" action="?controller=ControllerUtilisateur&action=upgradeAdmin">
    <label>Adresse mail</label>
    <input type="text" name="mail" placeholder="Entre le mail de la personne à passer admin">
    <input type="submit" class="button" value="Valider">
<form>

<h2>Ajouter un produit</h2>
    <div class = "formulaire">
        <div class = "container">
            <div class = "title">
                <h1>Ajouter un produit</h1>
            </div>
            <form method="post" action="?controller=ControllerProduit&action=created">
                <div class="input-group">
                    <label>Identifiant produit</label>
                    <input type = "number" name="idProduit" placeholder="Entrez l'id du produit" required>
                </div>
                <div class="input-group">
                    <label>Nom du produit</label>
                    <input type = "text" name="nomProduit" placeholder="Entrez le nom du produit" required>
                </div>
                <div class="input-group">
                    <label>Prix</label>
                    <input type = "number" name="prix" placeholder="Entrez le prix du produit" required>
                </div>
                <div class="input-group">
                    <label>Categorie</label>
                    <input type = "text" name="categorie" placeholder="Entrez la catégorie du produit" required>
                </div>
                <div class="input-group">
                    <label>Image</label>
                    <input type = "file" name="file" required>
                </div>
                <div class="input-group">
                    <button type="submit" name="submit" class="submit-btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>