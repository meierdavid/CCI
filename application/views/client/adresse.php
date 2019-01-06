
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
                <br><br><br>
                <h2 class="text-center"> Adresse de livraison :</h2>
                <br><br><br>
                <p><?php echo $client[0]->prenomClient . " " . $client[0]->nomClient; ?></p>
				</br>
                <p> Adresse :  <?php echo $client[0]->adresseClient . " " . $client[0]->codePClient. " ". $client[0]->villeClient; ?></p>
                </br>
                <p> Numéro de téléphone : <?php echo $client[0]->telClient; ?>
                    <br><br><br>
                    <div class="text-center">
                         <a class="btn btn-primary" href="<?php echo base_url()?>ClientCtrl/profil" role="button">Modifier votre adresse</a>
                    </div>
                   <br><br><br>
                   
                   
            </div>
        </div>
    </div>
    
    <div class="text-center" style="float: left;">
                         <a class="btn btn-success" href="<?php echo base_url()?>PanierCtrl/liste_panier" role="button">Vers le panier</a>
    </div>
    <div class="text-center" style="float: right;">
                         <a class="btn btn-success" href="<?php echo base_url()?>PanierCtrl/confirmation" role="button">Finaliser la commande</a>
    </div>
    <br><br><br>
    
</div>
