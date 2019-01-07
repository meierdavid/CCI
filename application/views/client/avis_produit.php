

<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
			
                <h2 class="text-center"> <br>Poster un avis<br><br></h2>
				


                <?php $action= 'ClientCtrl/ajouter_avis/'. $produit[0]->idProduit;
                echo form_open($action); ?>

                    <div class="form-group">
                        <label class="control-label">Note sur 10 :</label>
                        <input type="number" class="form-control" name="noteClient" value="0" min="0" max="10" size="30" required/>
                    </div>
					
					<div class="form-group">
                        <label class="control-label">Avis :</label>
                        <input type="text" class="form-control" name="avisClient" value="" size="3000" required/>
                    </div>
                   
                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Valider" /></div>
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