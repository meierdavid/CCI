
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
            <h2 class="text-center"> CCI Hérault - Bienvenue cher Consommateur !</h2>
            
            <?php ?> // Détail

            <?php echo form_open('ProduitCtrl/modifier'); ?>
                <br></br>
                    <div class="text-center">
                    
                    </div>
                    
                    <br></br>

                    <div class="form-group">
                        <label class="control-label">nomProduit</label>
                        <input type="text" class="form-control" name="nomProduit" value="<?php echo  $produit[0]->nomProduit; ?>" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">categorieProduit</label>
                        <input type="text" class="form-control" name="categorieProduit" value=" <?php echo $produit[0]->categorieProduit; ?>" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">descriptionProduit</label>
                        <input type="text" class="form-control" name="descriptionProduit" value="<?php echo $produit[0]->descriptionProduit; ?>" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>  

  
                    <div class="form-group">
                        <label class="control-label">prixUnitaireProduit</label>
                        <input type="text" class="form-control" name="prixUnitaireProduit" value="<?php echo $produit[0]->prixUnitaireProduit; ?>" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">reducProduit</label>
                        <input type="text" class="form-control" name="reducProduit" value="<?php  echo $produit[0]->reducProduit; ?>" size="30" required/>
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