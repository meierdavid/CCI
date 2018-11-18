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
  <div class="vertical-menu" style="position: absolute; margin-top: 70px;">
        <a href="#" class="active">Vos Commerces</a>
        <a href="<?php echo base_url()?>CommercantCtrl/liste_entreprise">Liste des commerces</a>
        <a href="<?php echo base_url()?>CommercantCtrl/add_entreprise">Ajouter un commerce</a>
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