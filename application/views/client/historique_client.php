<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">

                    <div class="box">
                        <br>
                        <div class="text-center">
                        </div>
                        <br>
                        <br>
                        <h2><?php echo " Commande du " . $panier->datePanier ?></h2>
                        <?php if($panier->annulationPanier == 1){
                            echo "Annulé";
                        }
                        else if($panier->finaliserPanier == 1 && $panier->annulationPanier == 0){
                            echo "Receptionné";
                        }
                        else if($panier->paiementPanier == 1 && $panier->annulationPanier == 0 && $panier->finaliserPanier == 0){
                            echo "en attente de retrait";
                        }
                        else{
                            echo "En attente de paiement";
                        }
                        
                        ?> 
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
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
                                            <td><?php echo "<strong>" .$item->nomProduit . "</strong> " ;?> <div> <?php echo $item->descriptionProduit; ?> </div></td>
                                            <td><?php
                                                if ($item->reducProduit != 0) {
                                                    echo intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100 ) . "€";
                                                } else {
                                                    echo $item->prixUnitaireProduit . "€";
                                                }
                                                ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <h2><?php echo " Prix total : " . $panier->prixTotPanier . "€"; ?></h2>
                        </div>

                    </div>

                </div>
            </div>

            <br></br>
            <br></br>


        </div>
    </div>
</div>
