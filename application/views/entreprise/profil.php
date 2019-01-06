    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" style="margin-left: 200px;">
            <?php echo form_open_multipart('CommercantCtrl/modifier_entreprise');?>
                    <br>
                    <div class="form-group">
                        <input type="text" class="form-control" name="numSiret" value="<?php echo  $entreprise[0]->numSiret; ?>" size="30" hidden/>
                    </div>
					<div class="table-responsive">
						<td><img src="http://localhost/cci/index.php/../assets/image/logos/<?php echo $entreprise[0]->logoEntreprise; ?>"  class="img-thumbnail"></td>
					</div>
					<div class="form-group">
                        <label class="control-label">Modifier le logo de l'entreprise :</label>
                        <input type="file" class="form-control" name="logoEntreprise" value="<?php echo $entreprise[0]->logoEntreprise; ?>" size="30" accept "image/*"/>
                    </div>
					<td><p><a href="<?php echo base_url("CommercantCtrl/supprimer_logo/" . $entreprise[0]->numSiret); ?>">Supprimer le logo</a></p></td>
                    <div class="form-group">
                        <label class="control-label">Nom de L'entreprise</label>
                        <input type="text" class="form-control" name="nomEntreprise" value=" <?php echo $entreprise[0]->nomEntreprise; ?>" size="30" required/>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input type="text" class="form-control" name="adresseEntreprise" value="<?php echo $entreprise[0]->adresseEntreprise; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Code postale</label>
                            <input type="text" class="form-control" name="codePEntreprise" value="<?php  echo $entreprise[0]->codePEntreprise; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" class="form-control" name="villeEntreprise" value="<?php echo $entreprise[0]->villeEntreprise; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Horaires de l'entreprise</label>
                        <input type="text" class="form-control" name="horairesEntreprise" value="<?php echo $entreprise[0]->horairesEntreprise; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Livraison</label>
                        <input type="text" class="form-control" name="livraisonEntreprise" value="<?php echo $entreprise[0]->livraisonEntreprise; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Temps de réservation Maximum</label>
                        <input type="number" class="form-control" name="tempsReservMax" value="<?php echo $entreprise[0]->tempsReservMax; ?>" size="30" required/>
                    </div>
					<div class="form-group">
                        <label class="control-label">Adresse du site web de l'entreprise</label>
                        <input type="text" class="form-control" name="siteWebEntreprise" value="<?php echo $entreprise[0]->siteWebEntreprise; ?>" size="30" />
                    </div>
                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Modifier" /></div>
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
