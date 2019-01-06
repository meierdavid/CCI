<?php if($commandes != null){
    $this->load->model('produit');?>
<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn" style="margin-left: 50px;">
            <div>
                
                <div class="row">

                    <div class="box">
                        <br>
                        <div class="text-center">
                        </div>
                        <br>
                        <br>
                        
                        
                        
                        <br>
                        <?php
                                        foreach ($commandes as $item) {
                                            if($item->annulerCommande == 0 && $item->receptionCommande == 0 ){
                                            $date = $this->commander->selectDate($item->idPanier);
                                            echo "<h2> Commande du " .$date[0]->datePanier."</h2>"; 
                                            
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
                                        
                                            <?php
                                            $produit = $this->produit->selectById($item->idProduit);
                                            
                                            if ($produit[0]->imageProduit == NULL) {
                                                $produit[0]->imageProduit = "not_found.jpg";
                                            }
                                            ?>
                                            <td><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $produit[0]->imageProduit; ?>"  class="rounded float-left"  alt="Pas d'image disponible"></td>
                                            <td><?php echo "<strong>" . $item->nomProduit . "</strong> "; ?> <div> <?php echo $produit[0]->descriptionProduit; ?> 
                                                </div>
                                                <div>
                                                   <?php $code = $this->commander->selectCode($item->idPanier);
                                                   echo "Code de retrait: <strong>".$code[0]->chainePanier ."</strong>"; ?>
                                                </div>
                                            </td>
                                            <td><?php echo " quantité : ". $item->quantiteProd ."<br><br>";
                                        if ($produit[0]->reducProduit != 0) {
                                            echo "prix unitaire : <br> ";
                                            echo intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100 ) . "€";
                                        } else {
                                            echo "prix unitaire : <br> " . $produit[0]->prixUnitaireProduit . "€";
                                        }
                                            echo "<br><br> total : " . (intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100 )) * $item->quantiteProd. "€";
                                            ?></td>
                                            <td>
                                                <?php 
                                                $client=$this->commander->selectClient($item->idPanier);
                                                if ($item->livraisonCommande == '0') {
                                                    
                                                    $destinataire = "Destinataire : " . $client[0]->prenomClient . " " . $client[0]->nomClient . "<br><br><br>";
                                                    echo $destinataire;
                                                    ?>

                                                    
                                                     <a class="btn btn-primary btn-success btn-block" href="<?php echo base_url('CommercantCtrl/valider_commande/'.$item->idPanier ."/".$item->idProduit);?>" role="button">Confirmer le retrait</a>   
                                                <?php
                                                } else {
                                                    
                                                    $destinataire = "Destinataire : " . $client[0]->prenomClient . " " . $client[0]->nomClient . "<br>";
                                                    $adresse = " A livrer à l'adresse : " . $client[0]->adresseClient . "<br> " . $client[0]->codePClient . " " .$client[0]->villeClient. "<br>";
                                                    $tel = "Tel : " .$client[0]->telClient;
                                                    echo $destinataire;
                                                    echo $adresse;
                                                    echo $tel . "<br>";
                                                    
                                                }
                                                
                                                 
                                                    ?>
                                                    <br>
                                                 <a class="btn btn-danger" href="<?php echo base_url("CommercantCtrl/annuler_commande/").$item->idPanier ."/".$item->idProduit;?>" role="button">Annuler la commande</a>   
                                                      
                                                    
                                               

                                            </td>
                                        </tr>
                                        <?php $i = $i + 1;
                                        }}
                                    ?>
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
<?php } ?>