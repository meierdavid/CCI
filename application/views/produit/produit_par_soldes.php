<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">

                        <div class="box">
                            <h2>Soldes</h2>

                                <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Catégorie</th>
                                                <th scope="col">Prix</th>
                                                <th scope="col">Réduction</th>
												<th scope="col">Couleur</th>
												<th scope="col">Quantité Dispo</th>
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
												<td><?php echo $item->couleurProduit; ?></td>
												<td><?php echo $item->nbDispoProduit; ?></td>
                                                <td><p><a href="<?php echo base_url("PanierCtrl/ajout_panier/".$produit[0]->idProduit); ?>">Ajouter au pannier</a></p></td>
                                                <td><p><a href="<?php echo base_url("ProduitCtrl/liste_avis/" . $item->idProduit); ?>">Voir les avis</a></p></td>

                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                </div>

                        </div>

                </div>
            </div>

            <br></br>
            <br></br>


        </div>
    </div>
</div>
