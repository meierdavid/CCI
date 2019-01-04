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
                <h2 class="text-center"> CCI Hérault - Bienvenue cher Commercant !</h2>

                <?php echo form_open_multipart('BonReducCtrl/ajout_bonreduc'); ?>

                <form>
                    <br></br>
                    <div class="text-center">
                        <h4>Veuillez inscrire les spécifications du bon de réduction :</h4>
                    </div>

                    <br></br>
                    <br>
                    <p class="control-label"Selectionnez l'Entreprise</p>

                    <select name = 'numSiret' id = 'category'>
                        <option value="">-- Select Entreprise --</option>
                        <?php foreach($entreprises as $item){ ?>
                            <option  value="<?php echo $item->numSiret; ?>"><?php echo $item->nomEntreprise; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <div class="form-group">
                        <label class="control-label">Libellé du Bon de réduction :</label>
                        <input type="text" class="form-control" name="libelleBon" value="" size="30" required/>
                        <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Pourcentage de réduction :</label>
                        <input type="number" class="form-control" name="pourcentageBon" value="" size="300" required/>
                    </div>

                        <br></br>
                        <br></br>

                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Confirmation" /></div>
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
