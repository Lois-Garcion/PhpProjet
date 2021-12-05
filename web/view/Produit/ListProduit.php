<div class="head">
    <h1>Nos produits</h1>
    <hr/>
</div>
<section id="sidebar">
    <div class="search">
        <form method="post" action="">
            <input type = "text" name="search" placeholder="Rechercher un produit">
        </form>
    </div>
    <div>
    <h6>Sport</h6>
    <ul class="cateSport">
        <li><a href="?controller=ControllerProduit&action=readAllByCategorie&categorie=basket">Basket</a></li>
        <li><a href="?controller=ControllerProduit&action=readAllByCategorie&categorie=badminton">Badminton</a></li>
        <li><a href="?controller=ControllerProduit&action=readAllByCategorie&categorie=football">Football</a></li>
        <li><a href="?controller=ControllerProduit&action=readAllByCategorie&categorie=tennis">Tennis</a></li>
        <li><a href="?controller=ControllerProduit&action=readAllByCategorie&categorie=running">Running</a></li>
        <li><a href="?controller=ControllerProduit&action=readAllByCategorie&categorie=ping-pong">Ping-Pong</a></li>
    </ul>
    </div>

    <h6>Prix</h6>
    <form method="post" action="?controller=ControllerProduit&action=readAllMinPriceMaxPrice">
        <div class="prixMini">
                <label for="form">Min €</label>
                <input type="number" name="minPrice" placeholder="Entrez un prix minimum">
        </div>
        <div class="prixMax">
                <label for="to">Max €</label>
                <input type="number" name="maxPrice" placeholder="Entrez un prix maximum">
        </div>
        <button type="submit" name="submit" class="submit-btn">Valider</button>
    </form>

</section>

<section class="products">
    <?php
    if($tab_produit == false){
        echo "Il n'y a pas de produit";
    }
    else{
        foreach ($tab_produit as $v) {
            echo "
                <div class = \"product-card\">
                    <div class = \"product-image\">
                        <img src =".$v->getFilepath().">
                    </div>
                    <div class = \"product-info\">
                        <h5>" . $v->getNomProduit() . "</h5>
                        <h7>" . $v->getCategorie() . "</h7>
                        <h6>" . $v->getPrix() . "€" . "<h6>
                    </div>
                    <form method=\"post\" action=\"?controller=ControllerUtilisateur&action=ajoutPanier\">
                            <input type = \"hidden\" name = \"idProduit\" value=\"" . $v->getIdProduit() . "\" required>
                            <div class=\"input-group\">
                                <label>Quantité</label>
                                <input type = \"number\" name=\"quantite\" placeholder=\"Quantité\" required>
                            </div>                     
                            <div class=\"input-group\">
                                <button type=\"submit\" name=\"submit\" class=\"submit-btn\">Ajouter</button>
                            </div>    
                     </form>
                </div>";
        }
    }
    ?>
</section>
