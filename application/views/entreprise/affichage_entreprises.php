



<?php // ça à mettre en page
foreach ($entreprises_header as $item) {
?>
<li><a href="<?php echo base_url("ProduitCtrl/produit_entreprise/" . $item->numSiret); ?>"><?php echo $item->nomEntreprise; ?></a></li>
<?php } ?>