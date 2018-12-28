<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div style="margin-left: 60px" class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des produits</h2>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">


                                </article>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Numero du vendeur</th>
                                                <th scope="col">Numero produit</th>
                                                <th scope="col">Libellé</th>
                                                <th scope="col">Prix</th>
                                                <th scope="col">Supprimer</th>
                                                <th scope="col">Modifier</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php foreach ($client as $item) { ?>
                                                <td><?php echo $item->numSiret; ?></td>
                                                <td><?php echo $item->idProduit; ?></td>
                                                <td><?php echo $item->nomProduit; ?></td>
                                                <td><?php echo $item->prixProduit; ?></td>
                                                <td><p><a href="<?php echo base_url("AdministrateurCtrl/supprimer_produit/".$item->idProduit);?>">Supprimer le Produit</a></p></td>
                                                <td><p><a href="<?php echo base_url("AdministrateurCtrl/modifier_produit/".$item->idProduit );?>">Modifier le Produit</a></p></td>
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
</div>


