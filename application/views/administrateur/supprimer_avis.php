
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
            <?php echo form_open('AdministrateurCtrl/supprimer_avis'); ?>

                    <div class="text-center">
                    <h4>Entrez les coordonnees du commercant à ajouter :</h4>
                    </div>

                    <br>

                    <div class="form-group">
                        <label class="control-label">Identifiant Client</label>
                        <input type="number" class="form-control" name="idClient" value="" size="30" required/>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Identifiant Produit</label>
                        <input type="number" class="form-control" name="idProduit" value="" size="30" required/>
                    </div>
					<div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Supprimer avis" /></div>
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
