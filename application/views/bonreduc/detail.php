
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" style="margin-left: 200px;">
                <?php echo form_open_multipart('BonReducCtrl/modifier'); ?>


                <br>
                <div class="form-group">
                    <label class="control-label">idBon</label>
                    <input type="text" class="form-control" name="idBon" value="<?php echo  $bonreduc[0]->idBon; ?>" size="30"/>
                </div>
                <div class="form-group">
                    <label class="control-label">pourcentageBon</label>
                    <input type="number" class="form-control" name="pourcentageBon" value="<?php echo  $bonreduc[0]->pourcentageBon; ?>" size="30"/>
                </div>
                <div class="form-group">
                    <label class="control-label">numSiret</label>
                    <input type="text" class="form-control" name="numSiret" value="<?php echo  $bonreduc[0]->numSiret; ?>" size="30" />
                </div>
				
				<div class="form-group">
                        <label class="control-label">Description du Bon de réduction :</label>
                        <input type="text" class="form-control" name="descriptionBon" value="<?php echo  $bonreduc[0]->descriptionBon; ?>" size="30" required/>
                        <h6 style="color:red;"</h6>
                    </div>
					
                <div class="form-group">
                    <label class="control-label">libelleBon</label>
                    <input type="text" class="form-control" name="libelleBon" value="<?php echo  $bonreduc[0]->libelleBon; ?>" size="30" required/>
                    <h6 style="color:red;"</h6>
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
