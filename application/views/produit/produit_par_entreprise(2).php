<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">

                    <div class="box">
                        <h2><?php echo $entreprise[0]->nomEntreprise; ?></h2>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col">Note</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php $i = 0; ?>
                                        <?php foreach ($produit as $item) { ?>
                                            <?php
                                            if ($item->imageProduit == NULL) {
                                                $item->imageProduit = "not_found.jpg";
                                            }
                                            ?>
                                            <td><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="rounded float-left"  alt="Pas d'image disponible"></td>
                                            <td><?php echo intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100 )  . "€" . "  AU LIEU DE  " . $item->prixUnitaireProduit . "€" ?></td>
                                            <td><p><a href="<?php echo base_url("ProduitCtrl/affichage_produit/" . $item->idProduit); ?>">Détails du produit</a></p></td>
                                            <td><p><a href="<?php echo base_url("PanierCtrl/ajout_panier/".$produit[0]->idProduit); ?>">Ajouter au panier</a></p></td>
                                            <td><?php echo $note[$i] . "/10";
                                            $i = $i + 1;
                                            ?></td>
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
