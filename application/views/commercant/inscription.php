<link href="<?php echo base_url()."../template/css/Connexion.css"; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->

<div class="container login-container2" align="left">
    <div class="row">
        <div class="col-md-6 login-form-4">

            <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
            <!-- renvoie tous les messages d'erreur, une chaine vide sinon -->
            <?php echo form_open('CommercantCtrl/inscription'); ?>

                <br>
                    <div class="text-center">
                    <h3>Vous êtes Commercant</h3>
                    </div>

                    <br>					
						
                    <div class="form-group">
                        <label class="control-label"><h5><strong>Prénom</h5></strong></label>
                            <input type="text" class="form-control" name="prenomCommercant" placeholder="Prénom" value="" size="30" required /> 
                            <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><h5><strong>Nom</h5></strong></label>
                            <input type="text" class="form-control" name="nomCommercant" placeholder="Nom" value="" size="30" required /> 
                    </div>
                    <div class="form-group">
                        <label class="control-label"><h5><strong>Email</h5></strong></label>
                        <input type="mail" class="form-control" name="mailCommercant" value="" size="30" placeholder="Email" required valid_email/>
                            <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><h5><strong>Mot de passe</h5></strong></label>
                        <input type="password" class="form-control" name="mdpCommercant" value="" placeholder="Mot de passe" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><h5><strong>Confirmation du mot de passe</h5></strong></label>
                        <input type="password" class="form-control" name="mdpCommercant2" value="" placeholder="Confirmer votre mot de passe" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><h5><strong>Adresse</h5></strong></label>
                        <input type="text" class="form-control" name="adresseCommercant" value="" placeholder="Adresse" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><h5><strong>Code Postal</h5></strong></label>
                        <input type="text" class="form-control" name="codePCommercant" value="" placeholder="Code Postal" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><h5><strong>Ville</h5></strong></label>
                        <input type="text" class="form-control" name="villeCommercant" value="" placeholder="Ville" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><h5><strong>Numéro de Téléphone</h5></strong></label>
                        <input type="text" class="form-control" name="telCommercant" value="" placeholder="Numéro de téléphone" size="30" required/>
                    </div>
					</br>
                    <div class="form-group"><h5>
                        <input type="checkbox" name="conditionsUtilisation" required/>  Je m'engage à respecter les <a href="<?php echo base_url("CommercantCtrl/condition_utilisation/");?>">conditions d'utilisation</a> de ce site
                    </h5></div>
					</br></br></br>

                    <div class="text-center"><input class="btnSubmit" type="submit" value="Inscription" /></div>
                    <div class="text-center">
                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
				
                </form>
            <br>
            <br>



            </div>
			<div class="col-md-6"></div>
        
    </div>
</div>
