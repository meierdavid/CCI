

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
                <h2 class="text-center"> Poster un avis</h2>


                <?php $action= 'ClientCtrl/modifier_avis/'. $produit[0]->idProduit;
                echo form_open($action); ?>

                    <div class="form-group">
                        <label class="control-label">Avis :</label>
                        <input type="text" class="form-control" name="avisClient" value="<?php echo $avis[0]->avisClient; ?>" size="3000" required/>
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