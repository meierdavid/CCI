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
                                            <td><?php
                                        if ($produit[0]->reducProduit != 0) {
                                            echo intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100 ) . "€";
                                        } else {
                                            echo $produit[0]->prixUnitaireProduit . "€";
                                        }
                                            ?></td>
                                            <td>
                                                <?php 
                                                $client=$this->commander->selectClient($item->idPanier);
                                                if ($item->livraisonCommande == '1') {
                                                    echo form_open('ClientCtrl/payer_entreprise/' . $item->idProduit);
                                                    $destinataire = "Destinataire : " . $client[0]->prenomClient . " " . $client[0]->nomClient . "<br><br><br>";
                                                    echo $destinataire;
                                                    ?>

                                                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Confirmer la reception" /></div>
                                                    </form>
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
                                                 <a class="btn btn-danger" href="<?php echo base_url("CommercantCtrl/annuler_commande/");?>" role="button">Annuler la commande</a>   
                                                      
                                                    
                                               

                                            </td>
                                        </tr>
                                        <?php $i = $i + 1;
                                    }
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