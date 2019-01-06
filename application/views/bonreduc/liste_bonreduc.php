<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div style="margin-left: 60px" class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2 class="text-center"> Liste des Bons de réduction</h2>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">


                                </article>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Code du bon</th>
												<th scope="col">Description du bon</th>
                                                <th scope="col">Entreprise</th>
                                                <th scope="col">Pourcentage appliqué</th>
                                                <th scope="col">Supprimer</th>
                                                <th scope="col">Modifier</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php 
												$this->load->model("entreprise");
												foreach ($bonreduc as $item) { 
												$entreprise=$this->entreprise->selectById($item->numSiret);
												?>
                                                <td><?php echo $item->libelleBon; ?></td>
                                                <td><?php echo $item->descriptionBon; ?></td>
                                                <td><strong> <a href="<?php echo base_url("entrepriseCtrl/affichage_entreprise/".$item->numSiret); ?>"><?php echo $entreprise[0]->nomEntreprise; ?></a></strong></td>
                                                <td><?php echo $item->pourcentageBon; ?></td>
                                                <td><p><a href="<?php echo base_url("BonReducCtrl/supprimer_bonreduc/" . $item->idBon); ?>">Supprimer le Bon de réduction</a></p></td>
                                                <td><p><a href="<?php echo base_url("BonReducCtrl/detail_bonreduc/" . $item->idBon); ?>">Modifier le Bon de réduction</a></p></td>
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
