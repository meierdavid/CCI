<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  
    <!-- Bootstrap -->
    <link href="<?php echo base_url()."../assets/css/bootstrap.min.css"; ?>" rel="stylesheet">
    <link href="<?php echo base_url()."../assets/css/commercant.css"; ?>" rel="stylesheet">
  </head>
  <body>
    <center>
        <h1>Bienvenue <?php if(isset($commercant)){ echo $commercant[0]->prenomCommercant; echo ' '; echo $commercant[0]->nomCommercant ;}    ?> sur votre espace Commerçant</h1>
    </center>
	<div>
	<a href="<?php echo base_url()?>commercantCtrl/liste_entreprise" class="active" >Retour Liste des Entreprises</a>	</div>
  <div class="vertical-menu" style="position: absolute; margin-top: 70px;">
		
		<a href="#" class="active"><?php if (isset($entreprise)){ echo $entreprise[0]->nomEntreprise;}; ?></a>
        <a href="<?php echo base_url("EntrepriseCtrl/profil/".$entreprise[0]->numSiret);?>">Profil</a>
        <a href="<?php echo base_url("EntrepriseCtrl/liste_produit/".$entreprise[0]->numSiret);?>">Liste des produits</a>
        <a href="<?php echo base_url()?>commercantCtrl/lie_commercant">Lier un commerçant à un commerce</a>
        <a href="#">Vos commandes en attente</a>
        <a href="#" class="active">Votre Compte</a>
        <a href="<?php echo base_url()?>commercantCtrl/profil">Profil</a>
        <a href="#">Historique</a>
        <a href="<?php echo base_url()?>commercantCtrl/changer_mdp">Changer de mot de passe</a>
        <a href="<?php echo base_url()?>commercantCtrl/deconnexion">Se déconnecter</a> <?php // changer ce Href lorsque les cookies seront mis en place ?>
</div>
      
  </body>
  
</html>