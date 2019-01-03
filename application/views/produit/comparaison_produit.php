
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="text-center">
        <div class="form-group">
            <label class="control-label">Comparaison</label>

        </div>
    </div>
    <div class="row mb-2">
        <center>
        <table>
            <tbody>
                <tr>

                    <th>
                        <div style="margin-right: 5em">
                            <a href="<?php echo base_url("ProduitCtrl/affichage_produit/" . $produit[0]->idProduit); ?> "><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $produit[0]->imageProduit; ?>"  class="rounded float-left"  alt="Pas d'image disponible"></a>
                            <div>
                                <p> <?php echo $produit[0]->nomProduit; ?>
                                </p>
                                <p> <?php echo $produit[0]->descriptionProduit; ?>
                                </p>
                            </div>
                        </div >
                    </th>
                    <?php foreach($produitsProposés as $item) {?>
                    <th>
                        <div style="margin-right: 5em">
                            <a href="<?php echo base_url("ProduitCtrl/affichage_produit/" . $item->idProduit); ?> "><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="rounded float-left"  alt="Pas d'image disponible"></a>
                            <div>
                                <p> <?php echo $item->nomProduit; ?>
                                </p>
                                <p> <?php echo $item->descriptionProduit; ?>
                                </p>
                            </div>
                        </div>
                    </th>
                    <?php }?>



                </tr>
                 <tr>

                     <td>
                         <p><a href="<?php echo base_url("PanierCtrl/ajout_panier/".$item->idProduit); ?>">Ajouter au panier</a></p>
                     </td>
                     <?php foreach($produitsProposés as $item) {?>
                     <td>
                         <p><a href="<?php echo base_url("PanierCtrl/ajout_panier/".$item->idProduit); ?>">Ajouter au panier</a></p>
                     </td>
                     <?php }?>
                </tr>
                <tr>
                    <?php foreach($notes as $item) {?>
                     <td>
                        <p><?php echo $item . "/10"; ?></p>
                     </td>
                     <?php }?>

                </tr>
                <tr>

                     <td>
                         <p>Prix : <?php echo $produit[0]->prixUnitaireProduit; ?> € </p>
                     </td>
                     <?php foreach($produitsProposés as $item) {?>
                     <td>
                         <p>Prix : <?php echo $item->prixUnitaireProduit; ?> € </p>
                     </td>
                     <?php }?>
                </tr>
                <tr>
                     <?php $i = 0;
                     while(isset($entreprises['entreprise'.$i])) {?>
                     <td>
                         <p>Vendu par :  <?php echo $entreprises['entreprise'.$i][0]->nomEntreprise; ?></p>
                     </td>

                     <?php $i = $i +1;
                     }?>
                </tr>

            </tbody>
        </table>
</center>
    </div>
</div>
