<!DOCTYPE html>
<html>

    <head>
        <title>Herault Ecommerce | Accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Elite Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>


        <link href="<?php echo base_url() . "../template/css/bootstrap.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href= "<?php echo base_url() . "../template/css/style.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href= "<?php echo base_url() . "../template/css/font-awesome.css"; ?>" rel="stylesheet" />
        <link href="<?php echo base_url() . "../template/css/easy-responsive-tabs.css"; ?>" rel='stylesheet' type='text/css'/>
        <!-- //for bootstrap working -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>

    </head>

    <body>
        <!-- header -->
        <div class="header" id="home">
            <div class="container">
                <ul>
                    <li> <a href="<?php echo base_url() ?>ClientCtrl/profil"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Profil </a></li>
                    <li><a href="<?php echo base_url() ?>ClientCtrl/historique">Historique des commandes</a></li>
                    <li> Crédit : <?php echo $client[0]->creditClient . "€"; ?></li>
                    <li> <a href="<?php echo base_url() ?>ClientCtrl/deconnexion"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Se déconnecter </a></li>
                </ul>
            </div>
        </div>
        <!-- //header -->
        <!-- header-bot -->
        <div class="header-bot">
            <div class="header-bot_inner_wthreeinfo_header_mid">
                <div class="col-md-4 logo_agile">
                    <h1><a href="index.html"><img src="<?php echo base_url() . "../assets/image/logo.png"; ?>"></a></h1>
                </div>
                <div class="col-md-4 header-middle">
                    <?php echo form_open('ProduitCtrl/search'); ?>
                    <input type="search" name="search" placeholder="Rechercher sur le site..." value="" required="">
                    <input type="submit" value=" ">
                    <div class="clearfix"></div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- //header-bot -->
        <!-- banner -->
        <div class="ban-top">
            <div class="container">
                <div class="top_nav_left">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav menu__list">
                                    <li class="menu__item"><a class="menu__link" href="<?php echo base_url(); ?>ClientCtrl/index">Accueil<span class="sr-only">(current)</span></a></li>
                                    <li class="dropdown menu__item">
                                        <a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catégories<span class="caret"></span></a>
                                        <ul class="dropdown-menu multi-column columns-3">
                                            <div class="agile_inner_drop_nav_info">
                                                <div class="col-sm-6 multi-gd-img1 multi-gd-text ">
                                                    <img src="<?php echo base_url("../assets/image/chariot.png"); ?>" alt=""/>
                                                </div>
                                                <div class="col-sm-3 multi-gd-img">
                                                    <ul class="multi-column-dropdown">
                                                        <h2>Produits</h2>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/aliments"); ?>">Aliments</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/vetements"); ?>">Vêtements</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/chaussures"); ?>">chaussures</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/accessoires"); ?>">Accessoires</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/beaute"); ?>">Beauté</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/sport"); ?>">Sport</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/informatique"); ?>">Informatique</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/livres"); ?>">Livres</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/musique"); ?>">Musique</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/divertissement"); ?>">Divertissement</a></li>
                                                        <li><a href="<?php echo base_url("ProduitCtrl/categorie/bricolage"); ?>">Bricolage</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-3 multi-gd-img">
                                                    <ul class="multi-column-dropdown">
                                                        <?php
                                                        echo "<h2>Magasins</h2>";
                                                        foreach ($entreprises_header as $item) {
                                                            ?>
                                                            <li><a href="<?php echo base_url("ProduitCtrl/produit_entreprise/" . $item->numSiret); ?>"><?php echo $item->nomEntreprise; ?></a></li>
                                                        <?php } ?>	
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6 multi-gd-img multi-gd-text ">
                                                    <a href="womens.html"><img src="<?php echo base_url() . "../assets/image/top1.jpg"; ?>" alt=" "/></a>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </ul>
                                    </li>
                                    <li class="menu__item dropdown">
                                        <a class="menu__link" href="<?php echo base_url(); ?>ProduitCtrl/soldes" >Soldes </a>
                                    </li>
                                    <li class=" menu__item"><a class="menu__link" href="<?php echo base_url(); ?>BonReducCtrl/liste_bonreduc_client">Codes de réduction</a></li>
                                    <li class=" menu__item"><a class="menu__link" href="<?php echo base_url(); ?>PageCtrl/contact">Contacts</a></li>
                                    <li class=" menu__item"><a class="menu__link" href="<?php echo base_url(); ?>PageCtrl/aide">Aide</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="top_nav_right">
                    <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                        
                            
                            
                            <button class="w3view-cart" type="submit" name="submit" value="">
                                <a class='' href="<?php echo base_url("PanierCtrl/liste_panier"); ?>"><i class="fa fa-cart-arrow-down" aria-hidden="true">
                                    
                                </i></a>
                            </button>
                        
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- //banner-top -->
