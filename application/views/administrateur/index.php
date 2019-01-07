<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html)>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- Bootstrap -->
        <link href="<?php echo base_url()."../assets/css/bootstrap.min.css"; ?>" rel=" stylesheet">
        <link href="<?php echo base_url()."../assets/css/commercant.css"; ?>" rel="stylesheet">
    </head>
    <body>
    <center>
        <h1>Bienvenue sur votre espace administrateur</h1>
    </center>
    <div class="vertical-menu" style="position: absolute; margin-top: 70px;">
        <a href="<?php echo base_url()?>AdministrateurCtrl/index">Accueil</a>
        <a href="#" class="active">Gestion Administrateur</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/ajout_administrateur">Ajouter un administrateur</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/liste_administrateur">Liste des administrateurs</a>
        <a href="#" class="active">Gestion des utilisateurs</a>
	<a href="<?php echo base_url()?>AdministrateurCtrl/ajout_commercant">Ajouter un commercant</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/liste_commercant">Liste des commercant</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/liste_client">Liste des clients</a>
		<a href="<?php echo base_url()?>AdministrateurCtrl/liste_avis">Liste des avis</a>
        <a href="#" class="active">Votre Compte</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/profil">Votre profil</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/changer_mdp">Changer mot de passe</a>
        <a href="<?php echo base_url()?>AdministrateurCtrl/deconnexion">Se déconnecter</a>

    </div>



    </body>
</html>
