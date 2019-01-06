<link href="<?php echo base_url()."../template/css/page_contact.css"; ?>" rel="stylesheet" type="text/css" media="all" />

<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

<div class="row" id="contatti">
<div class="container mt-5" >
<br><br>
	
    <div class="row" style="height:550px;">
      <div class="col-md-6 maps" >
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d92423.42001294422!2d3.818189079785162!3d43.622532620844495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b6afa7b2d43a49%3A0xcf7d53a3a3f9cb4e!2sCCI+H%C3%A9rault+-+Saint-C%C3%B4me+Montpellier+centre!5e0!3m2!1sfr!2sfr!4v1546693420759" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <div class="col-md-6">
        <h2 class="text-uppercase mt-3 font-weight-bold text-white">Nous Contacter</h2><br>
		
        <form action="">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Nom/Entreprise" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Objet" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="email" class="form-control mt-2" placeholder="Email" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="number" class="form-control mt-2" placeholder="Numéro de téléphone" required>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Demande" rows="3" required></textarea>
              </div>
            </div>
            <div class="col-12">
			<div class="text-center">
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">
                  Je m'engage à respecter les <a href="<?php echo base_url("ClientCtrl/condition_utilisation/");?>">conditions d'utilisation</a>
                </label>
              </div>
            </div>
			</div>
            </div>
			<div class="text-center">
            <div class="col-12">
              <button class="btn btn-success" type="submit">Envoyer</button>
            </div>
			</div>
			<br>
          </div>
        </form>
        <div class="text-white">
		
        <h2 class="text-uppercase mt-4 font-weight-bold">Nos coordonnées</h2><br>
		
        <i class="fas fa-phone mt-3"></i> <a href="tel:+">04 99 51 54 00</a><br><br>
        <i class="fas fa-globe mt-3"></i> 32 Grand Rue Jean Moulin, 34000 Montpellier<br>
		<div class="text-center">
        <div class="my-4">
        <a href="https://www.facebook.com/CCIHerault/"><i class="fab fa-facebook fa-3x pr-4"></i></a>
        <a href="https://twitter.com/cciherault"><i style = "margin: 30px" class="fab fa-twitter fa-3x"></i></a>
        </div>
		</div>
        </div>
      </div>

    </div>
</div>
</div>
