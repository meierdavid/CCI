<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div style="margin-left: 60px" class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des avis d'utilisateur</h2>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">


                                </article>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Identifiant du produit</th>
                                                    <th scope="col">Identifiant client</th>
                                                    <th scope="col">Avis</th>
                                                    <th scope="col">Note</th>
                                                    <th scope="col">Supprimer</th>
                                                    <th scope="col">Voir profil Client</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php foreach ($poster_avis as $item) { ?>
                                                        <td><?php echo $item->idProduit; ?></td>
                                                        <td><?php echo $item->idClient; ?></td>
                                                        <td><?php echo $item->avisClient; ?></td>
                                                        <td><?php echo $item->noteClient; ?></td>
                                                        <td><p><a href="<?php echo base_url("AdministrateurCtrl/supprimer_avis/" . $item->idClient ."/". $item->idProduit); ?>">Supprimer l'avis</a></p></td>
                                                        <td><p><a href="<?php echo base_url("AdministrateurCtrl/profil_client/" . $item->idClient); ?>">Voir client </a></p></td>
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

            <br>
            <br>


        </div>
    </div>
</div>



