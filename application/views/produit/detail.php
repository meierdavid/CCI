
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
  <div class="row">
    <div class="col-md-offset-3 col-md-5">
      <div class="form-login" style="margin-left: 200px;">
            <?php echo form_open_multipart('ProduitCtrl/modifier'); ?>
                <br></br>
                    <div class="text-center">
                    
                    </div>
                    
                    <br></br>
                    <div class="form-group">
                        <input type="text" class="form-control" name="idProduit" value="<?php echo  $produit[0]->idProduit; ?>" size="30" hidden/>     
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="numSiret" value="<?php echo  $produit[0]->numSiret; ?>" size="30" hidden/>     
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nom du Produit</label>
                        <input type="text" class="form-control" name="nomProduit" value="<?php echo  $produit[0]->nomProduit; ?>" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>
                    <div class="form-group">
                        <select name ="categorieProduit" value="<?php echo  $produit[0]->categorieProduit; ?>" > 
                            <option value="">-- Catégorie --</option>
                            <option  value="aliments">Aliments</option>
                            <option  value="vetements">Vêtements</option>
                            <option  value="chaussures">Chaussures</option>
                            <option  value="beaute">Beauté</option>
                            <option  value="sport">Sport</option>
                            <option  value="informatique">Informatique</option>
                            <option  value="livres">Livres</option>
                            <option  value="musique">Musique</option>
                            <option  value="divertissement">Divertissement</option>
                            <option  value="bricolage">Bricolage</option>
                         </select>
					
				    </div>    
                    <div class="form-group">
                        <label class="control-label">Description du Produit</label>
                        <input type="text" class="form-control" name="descriptionProduit" value="<?php echo $produit[0]->descriptionProduit; ?>" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>  
                    <div class="form-group">
                        <label class="control-label">Prix Unitaire du Produit</label>
                        <input type="number" class="form-control" name="prixUnitaireProduit" value="<?php echo $produit[0]->prixUnitaireProduit; ?>" size="30" required/>
                    </div>    
					<div class="table-responsive">
					<?php var_dump($produit[0]->imageProduit); ?>
						<td><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $produit[0]->imageProduit; ?>"  class="img-thumbnail"></td>
					</div>
					<div class="form-group">
                        <label class="control-label">Modifier la photo du produit :</label>
                        <input type="file" class="form-control" name="imageProduit" value="<?php echo $produit[0]->imageProduit; ?>" size="30" accept "image/*"/>
                    </div>
					<td><p><a href="<?php echo base_url("ProduitCtrl/supprimer_image/" . $produit[0]->idProduit); ?>">Supprimer l'image</a></p></td>
					
                    <div class="form-group">
                        <label class="control-label">Réduction sur le Produit</label>
                        <input type="number" class="form-control" name="reducProduit" value="<?php  echo $produit[0]->reducProduit; ?>" size="30" required/>
                    </div> 
					<div class="form-group">
                        <label class="control-label">Couleur du Produit</label>
                        <input type="color" class="form-control" name="couleurProduit" value="<?php  echo $produit[0]->couleurProduit; ?>" size="30" required/>
						<h6 style="color:red;"</h6>
                    </div> 	
                    <div class="form-group">
                        <label class="control-label">Quantité disponible du Produit</label>
                        <input type="number" class="form-control" name="nbDispoProduit" value="<?php  echo $produit[0]->nbDispoProduit; ?>" size="30" required/>
                    </div> 							
                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Modifier" /></div>
                    <div class="text-center">
                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
                </form>
            <br></br>
            <br></br>

        </div>
      </div>
    </div>
  </div>
