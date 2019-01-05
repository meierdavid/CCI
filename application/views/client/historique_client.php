<?php if($commander != null && $panier->paiementPanier == 1){ ?>
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
                        <br>
                        <?php
                        echo " votre code de retrait est : <strong>" . $panier->chainePanier ."</strong>";
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
                                            <td><?php echo "<strong>" . $item->nomProduit . "</strong> "; ?> <div> <?php echo $item->descriptionProduit; ?> </div></td>
                                            <td><?php
                                        if ($item->reducProduit != 0) {
                                            echo intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100 ) . "€";
                                        } else {
                                            echo $item->prixUnitaireProduit . "€";
                                        }
                                            ?></td>
                                            <td>
                                                <?php if ($commander[$i]->livraisonCommande == '1') {
                                                    echo form_open('ClientCtrl/payer_entreprise/' . $item->idProduit);
                                                    ?>

                                                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Confirmer la reception" /></div>
                                                    </form>
                                                <?php
                                                } else {
                                                    if ($panier->annulationPanier == 1) {
                                                        echo "<strong> Annulé </strong>";
                                                    } else if ($panier->finaliserPanier == 1 && $panier->annulationPanier == 0) {
                                                        echo "<strong> Receptionné </strong>";
                                                    } else if ($panier->paiementPanier == 1 && $panier->annulationPanier == 0 && $panier->finaliserPanier == 0) {
                                                        echo "<strong> en attente de retrait </strong>";
                                                    }
                                                    
                                                }
                                                 
                                                    ?>
                                                    
                                                        <p>Vendu par :  <a href="<?php echo base_url("entrepriseCtrl/affichage_entreprise/".$entreprises['entreprise'.$i][0]->numSiret); ?>"><?php echo $entreprises['entreprise'.$i][0]->nomEntreprise; ?></a></p>
                                                        <p><?php echo "adresse : " .$entreprises['entreprise'.$i][0]->adresseEntreprise; ?></p>
                                                        <p><?php echo  $entreprises['entreprise'.$i][0]->codePEntreprise . " " . $entreprises['entreprise'.$i][0]->villeEntreprise ; ?></p>
                                                        
                                                    
                                               

                                            </td>
                                        </tr>
                                        <?php $i = $i + 1;
                                    }
                                    ?>
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
<?php } ?>