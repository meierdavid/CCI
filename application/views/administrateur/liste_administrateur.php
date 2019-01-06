<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div style="margin-left: 60px" class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des administrateurs</h2>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">


                                </article>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Identifiant</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Prénom</th>
                                                <th scope="col">Mail</th>
                                                <th scope="col">Téléphone</th>
                                                <th scope="col">Supprimer</th>
                                                <th scope="col">Modifier</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php foreach ($administrateur as $item) { ?>
                                                <td><?php echo $item->idAdministrateur; ?></td>
                                                <td><?php echo $item->nomAdministrateur; ?></td>
                                                <td><?php echo $item->prenomAdministrateur; ?></td>
                                                <td><?php echo $item->mailAdministrateur; ?></td>
                                                <td><?php echo $item->telAdministrateur; ?></td>
                                                <td><p><a href="<?php echo base_url("AdministrateurCtrl/supprimer_administrateur/".$item->idAdministrateur);?>">Supprimer l'administrateur</a></p></td>
                                                <td><p><a href="<?php echo base_url("AdministrateurCtrl/profil/".$item->idAdministrateur);?>">Modifier l'administrateur</a></p></td>
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

