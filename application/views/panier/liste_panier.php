<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div style="margin-left: 60px" class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="box">
                            <h2>Votre panier</h2>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">


                                </article>
                                <article class=" col-md-11 col-lg-11">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">date Panier</th>
                                                <th scope="col">code Promo appliqué</th>
                                                <th scope="col">Prix total du panier</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php foreach ($panier as $item) { ?>
                                                <td><?php echo $item->datePanier; ?></td>
                                                <td><?php echo $item->codePromo; ?></td>
                                                <td><?php echo $item->prixTotPanier; ?></td>
                                                <td><p><a href="<?php echo base_url("PanierCtrl/finaliser/".$item->finaliserPanier );?>">Finaliser</a></p></td>
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
