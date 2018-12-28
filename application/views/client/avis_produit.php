
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
                <h2 class="text-center"> Poster un avis</h2>


                <?php echo form_open('ClientCtrl/ajouter_avis'); ?>

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
                <br></br>
                <br></br>



            </div>
        </div>
    </div>
</div>