<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div style="margin-left: 60px" class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des Produits</h2>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">


                                </article>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Catégorie</th>
                                                <th scope="col">Prix</th>
                                                <th scope="col">Réduction</th>
                                                <th scope="col">Supprimer</th>
                                                <th scope="col">Modifier</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php foreach ($produit as $item) { ?>
                                                <td><?php echo $item->nomProduit; ?></td>
                                                <td><?php echo $item->descriptionProduit; ?></td>
                                                <td><?php echo $item->categorieProduit; ?></td>
                                                <td><?php echo $item->prixUnitaireProduit; ?></td>
                                                <td><?php echo $item->reducProduit; ?></td>
                                                <td><p><a href="<?php echo base_url("ProduitCtrl/supprimer_produit/".$item->idProduit );?>">Supprimer le produit</a></p></td>
                                                <td><p><a href="<?php echo base_url("ProduitCtrl/detail_produit/".$item->idProduit );?>">modifier le produit</a></p></td>
                                                
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br></br>
            <br></br>


        </div>
    </div>
