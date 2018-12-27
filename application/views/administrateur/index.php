<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html)>
<html lang="en">
    <head><
        <m                                                                                           eta charset="utf-8">
        
        <!-- Bootstrap -->
        <link href="<?php echo base_url()."../assets/css/bootstrap.min.css"; ?>" rel=" stylesheet">
        <link href="<?php echo base_url()."../assets/css/commercant.css"; ?>" rel="stylesheet">
    </head>
    <body>
    <center>
        <hl>Bienvenue <?php if(isset($administrateur)){ echo $administrateur[0]->prenomAdministrateur; echo' '; echo $administrateur[0]->nomAdministrateur;} ?> sur votre espace Administrateur 
        </hl>
    </center>
    <div class="vertical-menu" style="position: absolute; margin-top: 70px;">
        <a href="<?php echo base_url()?>AdministrateurCtrl/index">Accueil</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/ajout_administrateur">Ajouter un administrateur</a>
		<a href="<?php echo base_url()?>AdministrateurCtrl/ajout_commercant">Ajouter un commercant</a>
                <a href="<?php echo base_url()?>AdministrateurCtrl/liste_commercant">Liste des commercant</a>
        <a href="#" class="active">Votre Compte</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/changer_mdp">Changer mot de passe</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/deconnexion">Se déconnecter</a>
        
    </div>
        
    

    </body>
</html>

