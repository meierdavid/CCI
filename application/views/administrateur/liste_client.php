<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div style="margin-left: 60px" class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Liste des clients</h2>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">


                                </article>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Identifiant</th>
                                                <th scope="col">Mail</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Prénom</th>
                                                <th scope="col">Supprimer</th>
                                                <th scope="col">Modifier</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php foreach ($client as $item) { ?>
                                                <td><?php echo $item->idClient; ?></td>
                                                <td><?php echo $item->mailClient; ?></td>
                                                <td><?php echo $item->nomClient; ?></td>
                                                <td><?php echo $item->prenomClient; ?></td>
                                                <td><p><a href="<?php echo base_url("AdministrateurCtrl/supprimer_client/".$item->idClient);?>">Supprimer le client</a></p></td>
                                                <td><p><a href="<?php echo base_url("AdministrateurCtrl/profil_client/".$item->idClient);?>">Modifier le client</a></p></td>
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



