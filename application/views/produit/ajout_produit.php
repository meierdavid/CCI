<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
	<div class="table-responsive -sm"
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
                <h2 class="text-center"> CCI Hérault - Bienvenue cher Commercant !</h2>

                <?php echo form_open_multipart('ProduitCtrl/ajout_produit'); ?>

                <form>
                    <br>
                    <div class="text-center">
                        <h4>Veuillez rentrer les spécifications du produit :</h4>
                    </div>

                    <br>


                     <select name = 'numSiret' id = 'category'>
                            <option value="">-- Select Entreprise --</option>
                               <?php foreach($entreprises as $item){ ?>
                            <option  value="<?php echo $item->numSiret; ?>"><?php echo $item->nomEntreprise; ?></option>
                            <?php } ?>
                         </select>
                    <div class="form-group">
                        <label class="control-label">Nom du produit :</label>
                        <input type="text" class="form-control" name="nomProduit" value="" size="30" required/>
                        <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Description :</label>
                        <input type="text" class="form-control" name="descriptionProduit" value="" size="300" required/>
                    </div>
                    <div  class="form-group">
                        <select name ="categorieProduit" required>
                            <option value="">-- Catégorie --</option>
                            <option  value="aliments">Aliments</option>
                            <option  value="vetements">Vêtements</option>
                            <option  value="chaussures">Chaussures</option>
														<option  value="accesoires">Accessoires</option>
                            <option  value="beaute">Beauté</option>
                            <option  value="sport">Sport</option>
                            <option  value="informatique">Informatique</option>
                            <option  value="livres">Livres</option>
                            <option  value="musique">Musique</option>
                            <option  value="divertissement">Divertissement</option>
                            <option  value="bricolage">Bricolage</option>
                         </select>

                    <br>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Prix unitaire du produit :</label>
                        <input type="number" class="form-control" name="prixUnitaireProduit" step="any" size="30" required/>
                        <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Photo du produit :</label>
                        <input type="file" class="form-control" name="imageProduit" size="30" accept "image/*"/>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Réduction de produit ( en % ) :</label>
                        <input type="number" class="form-control" name="reducProduit" step="any" min="0" max="100" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Couleur du produit :</label>
                        <input type="color" class="form-control" name="couleurProduit" size="30" required/>
                        <h6 style="color:red;"</h6>
                    </div>
					<div class="form-group">
                        <label class="control-label">Quantité disponible du produit :</label>
                        <input type="number" class="form-control" name="nbDispoProduit" value="0" size="30" required/>
                        <h6 style="color:red;"</h6>
                    </div>

                    <br>

                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Confirmation" /></div>
                    <div class="text-center">
                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
                </form>
                <br>
                <br>



            </div>
        </div>
    </div>
	</div>
</div>
