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
        <li><a href="#">Basket</a></li>
        <li><a href="#">Badminton</a></li>
        <li><a href="#">Football</a></li>
        <li><a href="#">Tennis</a></li>
        <li><a href="#">Running</a></li>
    </ul>
    </div>

    <h6>Prix</h6>
    <div class="ajust-price">
        <span class="min-max">0€</span>
        <form class="ajusteur">
            <input id="multi" name="prix" class="multi-range" type="range" />
        </form>
        <span class="min-max">200€</span>
    </div>

</section>

<section class="products">
    <?php
    if($tab_produit == false){
        echo "Il n'y a pas de produit";
    }
    foreach ($tab_produit as $v){
        echo "
            <div class = \"product-card\">
                <div class = \"product-image\">
                    <img src =\"assets/images/raquette-yonex.jpg\">
                </div>
                <div class = \"product-info\">
                    <h5>" . $v->getNomProduit() . "</h5>
                    <h7>" . $v->getCategorie() . "</h7>
                    <h6>" . $v->getPrix() ."€". "<h6>
                </div>
                <form method=\"post\" action=\"?controller=ControllerUtilisateur&action=ajoutPanier\">
                        <input type = \"hidden\" name = \"idProduit\" value=\" ". $v->getIdProduit() . " \" required>
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
    ?>
</section>
