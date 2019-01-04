<div class="container">
    <div class="content">
        <div class="animated fadeIn">
            <div class="text-center">


                <div class="box">
                    <h2>Veuillez confirmer votre commande</h2>
                    <br> <br>
                    <?php
                    $i = 0;
                    foreach ($produits as $item) {
                        echo"<div style=\"border-width:1px; border-style:dotted; border-color:black;\">";
                        echo "<div class=\"row\">";
                        echo "<div class=\"col-md-5\">";
                        if ($item->imageProduit == NULL) {
                            $item->imageProduit = "not_found.jpg";
                        }
                        ?>
                        <img style="height: 100px; width: 100px; float:left;" src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="img-thumbnail">
                        <?php echo "<strong>" .$item->nomProduit . "</strong> " . $item->descriptionProduit; ?>

                    </div>
                    <div class="col-md-3">
                        <?php echo $commander[$i]->quantiteProd . " pièce x " . (intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100)) . "€"; ?>
                    </div>
                    <div class="col-md-3">
                        <select name = 'livraison' id = 'category'>
                            <option value="">-- mode de livraison --</option>
                            <?php
                            if ($commander[$i]->livraisonCommande == 1) {

                                echo "<option  value=\"colissimo\">Colissimo</option>";
                                echo "<option  value=\"magasin\">En magasin</option>";
                            } else
                                echo "<option  value=\"magasin\">En magasin</option>";
                            ?>
                        </select>
                        <p>Livraison Gratuite</p>


                    </div>

                </div>
                <div class="row">
                    ________________________________________________________

                    <br>
                    <p>Prix : <?php echo $commander[$i]->quantiteProd * (intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100)) . "€"; ?></p>
                    <br>
                </div></div><br><br>
    <?php
    $i = $i + 1;
}
?>

        <div class="text-center">
            <label class="control-label">prix total du panier = </label>
            <?php echo $panier[0]->prixTotPanier . "€" ?>
        </div>
        <div class="text-center" style="float: left;">
            <a class="btn btn-success" href="<?php echo base_url('PanierCtrl/finaliser/').$panier[0]->idPanier ?>" role="button">vers l'étape précédente</a>
        </div>
        <div class="text-center" style="float: right;">
            <a class="btn btn-success" href="<?php echo base_url('PanierCtrl/payement') ?>" role="button">Confirmer et Payer</a>
        </div>

    </div>
</div>

</div>

<br></br>
<br></br>


</div>
</div>
</div>