
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

              <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
              <!-- renvoie tous les messages d'erreur, une chaine vide sinon -->
              <?php echo form_open('AdministrateurCtrl/ajout_administrateur'); ?>

                    <div class="text-center">
                    <h4>Ajoutez un administrateur</h4>
                    <div class="form-group">
                        <label class="control-label">Prénom</label>
                        <input type="text" class="form-control" name="prenomAdministrateur" value="" size="30" required/>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control" name="nomAdministrateur" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mail</label>
                        <input type="mail" class="form-control" name="mailAdministrateur" value="" size="30" required/>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdpAdministrateur" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Confirmation du mot de passe</label>
                        <input type="password" class="form-control" name="mdpAdministrateur2" value="" size="30" required/>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input type="text" class="form-control" name="adresseAdministrateur" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Code Postal</label>
                        <input type="number" class="form-control" name="codePAdministrateur" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" class="form-control" name="villeAdministrateur" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telephone</label>
                        <input type="number" class="form-control" name="telAdministrateur" value="" size="30" required/>
                    </div>

                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Inscription" /></div>
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

