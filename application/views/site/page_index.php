<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()."assets/css/bootstrap.min.css"; ?>" rel="stylesheet">
    <link href="<?php echo base_url()."assets/css/defilement.css"; ?>" rel="stylesheet">
  </head>
  <body>
      <div class="container-fluid">

              <p><img src="<?php echo base_url().'assets/image/cci-herault.jpg';?>" alt="lol" >
               <img src="<?php echo base_url().'assets/image/polylogo.png';?>" alt="lol" style="float:right; margin-left:8px;" >
              </p>

      </div>
      <div class='container'>
          <div id="galerie">
              <img  class="active" src="<?php echo base_url().'assets/image/comedie.jpg';?>" alt="img1" >
              <img src="<?php echo base_url().'assets/image/Nimes.jpg';?>" alt="lol">
              <img src="<?php echo base_url().'assets/image/setes.jpg';?>" alt="lol" >
              <img src="<?php echo base_url().'assets/image/beziers.jpg';?>" alt="lol">
        
          </div>
          
          <div class="row">
              <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                  <h1>Article 1</h1>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean interdum risus vitae ex tincidunt consequat. Donec ac ipsum tempus mauris aliquam rhoncus. In sollicitudin risus vel facilisis iaculis. Morbi ut felis vel nunc accumsan placerat at id turpis. Integer tincidunt dui eget nisl ultrices, tempor blandit dolor facilisis. Morbi eget diam ex. Praesent sodales vel orci vel bibendum. Ut pharetra leo mauris, dictum pulvinar diam vulputate fringilla. Pellentesque nec tellus quis odio pellentesque tristique eget consectetur quam. Donec pharetra semper massa. Vivamus tincidunt eros mi, sollicitudin iaculis quam bibendum id.</p>
             
                  
              </article>
              <article class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                  <h1> Article 2 </h1>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean interdum risus vitae ex tincidunt consequat. Donec ac ipsum tempus mauris aliquam rhoncus. In sollicitudin risus vel facilisis iaculis. Morbi ut felis vel nunc accumsan placerat at id turpis. Integer tincidunt dui eget nisl ultrices, tempor blandit dolor facilisis. Morbi eget diam ex. Praesent sodales vel orci vel bibendum. Ut pharetra leo mauris, dictum pulvinar diam vulputate fringilla. Pellentesque nec tellus quis odio pellentesque tristique eget consectetur quam. Donec pharetra semper massa. Vivamus tincidunt eros mi, sollicitudin iaculis quam bibendum id.</p>
                          
              </article>
          </div>
      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=<?php echo base_url."assets/js/jquery.min.js";?>></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src=<?php echo base_url."assets/js/bootstrap.min.js";?>></script>
   
  </body>
  
</html>