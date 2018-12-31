
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="text-center">
    <div class="form-group">
        <label class="control-label"><?php echo $produit[0]->categorieProduit; ?></label>
        
    </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <br></br>
            
            <img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $produit[0]->imageProduit; ?>"  class="rounded float-left"  alt="Pas d'image disponible">
            <br></br>
             Couleur de l'article :
            <div style="background-color: <?php echo $produit[0]->couleurProduit;?>; width: 40px;
    height: 40px; border-radius: 20px;">
            </div>
            
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label class="control-label"><?php echo $produit[0]->nomProduit; ?></label>
                
                
            </div>

            
            <p><?php echo $produit[0]->descriptionProduit; ?> </p>
            <p> de : <?php echo $entreprise[0]->nomEntreprise; ?>
            <br>
            <p><?php echo $note . "/10";?></p>
            <p><a href="<?php echo base_url("ProduitCtrl/liste_avis/" . $produit[0]->idProduit); ?>">Voir les avis</a></p>
            ______________________________________________________________________
            
            <br><br>
            <p>Prix : <?php echo $produit[0]->prixUnitaireProduit ;?> € </p>
            <?php if($produit[0]->reducProduit > 0) { 
            echo "<p> bénéficiez d'une réducion de ". $produit[0]->reducProduit."% </p>"; } ?>
            <br>
            <?php if($entreprise[0]->livraisonEntreprise == TRUE){?>  
            <p> Cet article est éligible à la livraison </p> 
            <?php }else{
               echo "<p> Cet article n'est pas éligible à la livraison </p>";
            } ?>

            <p> Il reste : <?php echo $produit[0]->nbDispoProduit; ?>	articles disponibles </p>					
            <br>
            <p><a href="<?php echo base_url("ProduitCtrl/supprimer_produit/" . $produit[0]->idProduit); ?>">Ajouter au pannier</a></p>
            <br><br>
        </div>
            

            <br></br>
            <br></br>


        </div>
    </div>

