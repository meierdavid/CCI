
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
            <h2 class="text-center"> Votre profil</h2>
            <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
            <?php echo form_open('AdministrateurCtrl/modifier_administrateur'); ?>
                    <div class="form-group">
                        <label class="control-label">Prénom</label>
                        <input type="text" class="form-control" name="prenomAdministrateur" value="<?php echo  $administrateur[0]->prenomAdministrateur; ?>" size="30" required/>
                            <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control" name="nomAdministrateur" value=" <?php echo $administrateur[0]->nomAdministrateur; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mail</label>
                        <input type="text" class="form-control" name="mailAdministrateur" value="<?php echo $administrateur[0]->mailAdministrateur; ?>" size="30" required/>
                            <h6 style="color:red;"</h6>
                    </div>


                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input type="text" class="form-control" name="adresseAdministrateur" value="<?php echo $administrateur[0]->adresseAdministrateur; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Code postale</label>
                            <input type="text" class="form-control" name="codePAdministrateur" value="<?php  echo $administrateur[0]->codePAdministrateur; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" class="form-control" name="villeAdministrateur" value="<?php echo $administrateur[0]->villeAdministrateur; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" name="telAdministrateur" value="<?php echo $administrateur[0]->telAdministrateur; ?>" size="30" required/>
                    </div>

                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Modifier" /></div>
                    <div class="text-center">
                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>

                </form>

            <div class="text-center">
                <a class="btn btn-primary" href="<?php echo base_url()?>AdministrateurCtrl/changer_mdp" role="button">Voulez vous changer votre mot de passe ?</a>
            </div>
          </br>

            </div>
        </div>
    </div>
</div>
