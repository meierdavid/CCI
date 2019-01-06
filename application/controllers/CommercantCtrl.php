<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommercantCtrl extends CI_Controller {


	public function index()
	{
		if($this->input->cookie('commercantCookie') != null){
			$this->load->helper('url');
			$this->load->view('commercant/connexion');
		}
	}

	public function profil()
	{
		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->helper('form');

		if($this->input->cookie('commercantCookie') != Null){
			$varMail= $this->input->cookie('commercantCookie'); // rentrer un mail dans votre base de données en attendant qu'on fasse les cookies
			$this->load->model('commercant');
			$data['commercant'] = $this->commercant->selectByMail($varMail);
			$this->load->view('commercant/index',$data);
			$this->load->view('commercant/profil',$data);
		}
		else{
			$this->load->view('pages/pageconnexion');
		}
	}

	public function changer_mdp(){ // info commercant avec cookie
		$this->load->helper('cookie');
		$this->load->model('commercant');
		$this->load->helper('url');
		$this->load->library('form_validation');

		if(isset($_COOKIE['commercantCookie'])){
			$varid= $this->input->cookie('commercantCookie');
			$data['commercant'] = $this->commercant->selectByMail($varid);
			if(isset($_POST['mdpCommercantAncien'])) {
				if (password_verify($_POST['mdpCommercantAncien'], $data['commercant'][0]->mdpCommercant)){ //dé-hashage
					if($_POST['mdpCommercantNouveau'] == $_POST['mdpCommercantConf']){
						$newMdp = crypt($_POST['mdpCommercantNouveau'],'md5');
						$this->commercant->updateMdp($varid,$newMdp);
						setcookie("commercantCookie", "", time() - 36000);

						$data['message'] = "Votre mot de passe a été modifié avec succès";
						$this->load->view('errors/validation_formulaire', $data);
						$this->load->view('commercant/index');
					}
					else{
						$data['message'] = "ereur : La confirmation de mot de passe ne correspond pas au premier";
						$this->load->view('errors/erreur_formulaire', $data);
						$this->load->view('commercant/index');
						$this->load->view('commercant/changer_mdp',$data);
					}
				}
				else{
					$data['message'] = "ereur : L'ancien mot de passe n'est pas conforme";
					$this->load->view('errors/erreur_formulaire', $data);
					$this->load->view('commercant/index',$data);
					$this->load->view('commercant/changer_mdp',$data);
				}
			}
			else {
				$this->load->view('commercant/index');
				$this->load->view('commercant/changer_mdp',$data);
			}
		}
		else{
			$data['message'] = "ereur : Votre session a expiré, veuillez vous reconnecter";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('commercant/connexion');
		}
	}

	public function modifier_commercant(){
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model('commercant');

		$this->form_validation->set_rules('prenomCommercant', 'Prénom', 'alpha_dash');
		$this->form_validation->set_rules('nomCommercant', 'Nom', 'alpha_numeric_spaces');
		$this->form_validation->set_rules('mailCommercant', 'Email', 'valid_email');
		$this->form_validation->set_rules('codePCommercant', 'Code postale', 'integer');
		$this->form_validation->set_rules('villeCommercant', 'Ville', 'alpha_dash');
		$this->form_validation->set_rules('telCommercant', 'Numéro de téléphone', 'integer');

		if (isset($_COOKIE['commercantCookie'])){
			$varmail = $this->input->cookie('commercantCookie');
			$data['commercant'] = $this->commercant->selectByMail($varmail);
			$id = $data['commercant'][0]->idCommercant;
			$mdp = $data['commercant'][0]->mdpCommercant;

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('commercant/profil');
			}
			else if ($varmail != $_POST['mailCommercant']) {
				$data['message'] = "erreur : Vous ne pouvez pas changer votre adresse email";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('commercant/inscription');
			}
			$data = array(
				"prenomCommercant" => htmlspecialchars($_POST['prenomCommercant']),
				"nomCommercant" => htmlspecialchars($_POST['nomCommercant']),
				"mailCommercant" => htmlspecialchars($_POST['mailCommercant']),
				"mdpCommercant" => htmlspecialchars($mdp),
				"adresseCommercant" => htmlspecialchars($_POST['adresseCommercant']),
				"codePCommercant" => htmlspecialchars($_POST['codePCommercant']),
				"villeCommercant" => htmlspecialchars($_POST['villeCommercant']),
				"telCommercant" => htmlspecialchars($_POST['telCommercant']),
			);

			$this->commercant->update($id, $data);
			$data['commercant'] = $this->commercant->selectByMail($varmail);
			$data['message'] = "Votre profil commercant a été modifié avec succès";
			$this->load->view('errors/validation_formulaire', $data);
			$this->load->view('commercant/index');
			$this->load->view('commercant/profil');
	}
	else {
		$data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
		$this->load->view('errors/erreur_formulaire', $data);
		$this->load->view('commercant/connexion');
	}
}

public function check_connexion(){
	$this->load->helper('cookie');

	if(isset($_POST['mail']) && isset($_POST['mdp']) ){
		$this->load->model('commercant');
		$data['commercant'] = $this->commercant->selectByMail($_POST['mail']);
		if( $data['commercant'] != NULL && $_POST['mdp'] == $data['commercant'][0]->mdpCommercant ){
			$cookie = array(
				'name'   => 'commercantCookie',
				'value'  => $data['commercant'][0]->mailCommercant,
				'expire' => '3600'
			);
			$this->input->set_cookie($cookie);

			echo $this->input->cookie('commercantCookie');

			$this->load->view('commercant/index',$data);
		}
		else{
			$data['message']="erreur mauvais mot de passe ou mauvaise adresse mail";
			$this->load->view('errors/erreur_formulaire', $data['message']);
			// erreur mauvais mdp ou mauvaise adresse mail
		}
	}
	else{
		// erreur
	}
}
public function valider_commande($idPanier, $idProduit){
    $this->load->model('panier');
    $this->load->model('produit');
    $this->load->model('commander');
    $this->load->model('commercant');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    $varid = $this->input->cookie('commercantCookie');
    $data['commercant'] = $this->commercant->selectByMail($varid);
    $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);
    $data['produit'] = $this->produit->selectById($idProduit);
    $data['entreprise'] = $this->produit->selectEntrepriseById($idProduit);
    //valider la commande
    $numSiret = $data['entreprise'][0]->numSiret;
    $this->commander->updateReception($idPanier,$idProduit,'1');
    $data['commander'] =$this->commander->selectById($idPanier,$idProduit);

    //payer entreprise
    $prix = $this->produit->prix_a_afficher($idProduit) * $data['commander'][0]->quantiteProd;
    $nouveauSoldeEntreprise = $data['entreprise'][0]->soldeEntreprise + $prix;
    $this->entreprise->updateCredit($numSiret, $nouveauSoldeEntreprise);
    $this->historique_commande();
}
public function annuler_commande($idPanier, $idProduit){
    $this->load->model('panier');
    $this->load->model('produit');
    $this->load->model('commander');
    $this->load->model('commercant');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    $varid = $this->input->cookie('commercantCookie');
    $data['commercant'] = $this->commercant->selectByMail($varid);
    $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);
    $data['produit'] = $this->produit->selectById($idProduit);
    $data['client'] = $this->commander->selectClient($idPanier);
    $idClient =$data['client'][0]->idClient;
    //annuler la commande
    $this->commander->updateAnnuler($idPanier,$idProduit,'1');
    $data['commander'] =$this->commander->selectById($idPanier,$idProduit);
    // réaugmenter la quantité
    $nouvelleQuantite = $data['produit'][0]->nbDispoProduit + $data['commander'][0]->quantiteProd;
    $this->produit->updateQuantite($idProduit, $nouvelleQuantite);
    //annulation des points
    $prix = $this->produit->prix_a_afficher($idProduit) * $data['commander'][0]->quantiteProd;
    $nouveauPoint = $data['client'][0]->pointClient - ($prix / 10);
    $this->client->updatePoint($idClient, $nouveauPoint);
    //rembourser client
    $nouveauSoldeClient = $data['client'][0]->creditClient + $prix;
    $this->client->updateCredit($idClient, $nouveauSoldeClient);
    $this->historique_commande();
}
public function historique_commande(){
    $this->load->model('panier');
    $this->load->model('produit');
    $this->load->model('commander');
    $this->load->model('commercant');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    $varid = $this->input->cookie('commercantCookie');
    $data['commercant'] = $this->commercant->selectByMail($varid);
    $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);
    $this->load->view('commercant/index',$data);
    foreach ($data['entreprises'] as $entreprise){
        $data['commandes'] = $this->entreprise->selectCommandes($entreprise->numSiret);
         // select la date et le code de retrait de la commande SQL

        $this->load->view('commercant/historique_entreprise',$data);
    }
}

public function liste_entreprise_dropbox(){
	$this->load->helper('cookie');
	$this->load->model('commercant');
	$this->load->model('entreprise');

	$varid = $this->input->cookie('commercantCookie');
	$data['commercant'] = $this->commercant->selectByMail($varid);
	$data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);

	return $data;
}

public function form_ajout_produit(){
	$this->load->model('produit');
	$this->load->model('commercant');
	$this->load->model('entreprise');
	$this->load->helper('form','url');
	$this->load->helper('cookie');
	$this->load->library('form_validation');

	if($this->input->cookie('commercantCookie') != null){
		$varMail= $this->input->cookie('commercantCookie');
		$data['commercant']=$this->commercant->selectByMail($varMail);
		$data = $this->liste_entreprise_dropbox();
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('commercant/index',$data);
			$this->load->view('produit/ajout_produit', $data);
		}
	}
	else{
		$data['message'] = "ereur : Votre session a expiré, veuillez vous reconnecter";
		$this->load->view('errors/erreur_formulaire', $data);
		$this->load->view('commercant/connexion');
	}
}

    public function form_ajout_bonreduc(){
        $this->load->model('bonreduc');
        $this->load->model('commercant');
        $this->load->model('entreprise');
        $this->load->helper('form','url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');

        if($this->input->cookie('commercantCookie') != null){
            $varMail= $this->input->cookie('commercantCookie');
            $data['commercant']=$this->commercant->selectByMail($varMail);
            $data = $this->liste_entreprise_dropbox();
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('commercant/index',$data);
                $this->load->view('bonreduc/ajout_bonreduc', $data);
            }
        }
        else{
            $data['message'] = "ereur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('commercant/connexion');
        }
    }

        public function liste_entreprise(){
            $this->load->helper('cookie');
            $this->load->model('commercant');
            $this->load->model('entreprise');
            if($this->input->cookie('commercantCookie') != null){
                $varid = $this->input->cookie('commercantCookie');
                $data['commercant'] = $this->commercant->selectByMail($varid);
                $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);

                if( $data['entreprises'] != NULL){
                    $this->load->view('commercant/index',$data);
                    $this->load->view('commercant/liste_entreprise',$data);

                }
                else{
                    $this->ajout_entreprise();
                }
            }
            else{
                $this->load->view('commercant/connexion');
            }
        }

public function ajout_entreprise() {

    $this->load->helper('form','url');
	$this->load->helper('cookie');
	$this->load->library('form_validation');
	$this->load->model('entreprise');
	$this->load->model('commercant');

	$this->form_validation->set_rules('numSiret', 'n° SIRET', 'required');
	$this->form_validation->set_rules('nomEntreprise', "Nom de l'entreprise", 'alpha_numeric_spaces');
	$this->form_validation->set_rules('codePEntreprise', 'Code postale', 'integer');
	$this->form_validation->set_rules('villeEntreprise', 'Ville', 'alpha_dash');
	$this->form_validation->set_rules('TempsReservMax', 'Temps maximum de réservation en heure', 'integer');

    if ($this->input->cookie('commercantCookie') != null) {
      $varMail = $this->input->cookie('commercantCookie');
      $data['commercant'] = $this->commercant->selectByMail($varMail);
	  if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('commercant/index',$data);
			$this->load->view('commercant/ajout_entreprise');
		}
		else {
		  if ($this->entreprise->selectById($_POST['numSiret']) == null) {

				$id= $data['commercant'][0]->idCommercant;

				$horairesEntreprise=$_POST['lundi_matin_ouverture']."-".$_POST['lundi_matin_fermeture']."/".
				$_POST['lundi_soir_ouverture']."-".$_POST['lundi_soir_fermeture']." ".
				$_POST['mardi_matin_ouverture']."-".$_POST['mardi_matin_fermeture']."/".
				$_POST['mardi_soir_ouverture']."-".$_POST['mardi_soir_fermeture']." ".
				$_POST['mercredi_matin_ouverture']."-".$_POST['mercredi_matin_fermeture']."/".
				$_POST['mercredi_soir_ouverture']."-".$_POST['mercredi_soir_fermeture']." ".
				$_POST['jeudi_matin_ouverture']."-".$_POST['jeudi_matin_fermeture']."/".
				$_POST['jeudi_soir_ouverture']."-".$_POST['jeudi_soir_fermeture']." ".
				$_POST['vendredi_matin_ouverture']."-".$_POST['vendredi_matin_fermeture']."/".
				$_POST['vendredi_soir_ouverture']."-".$_POST['vendredi_soir_fermeture']." ".
				$_POST['samedi_matin_ouverture']."-".$_POST['samedi_matin_fermeture']."/".
				$_POST['samedi_soir_ouverture']."-".$_POST['samedi_soir_fermeture']." ".
				$_POST['dimanche_matin_ouverture']."-".$_POST['dimanche_matin_fermeture']."/".
				$_POST['dimanche_soir_ouverture']."-".$_POST['dimanche_soir_fermeture'];

				if($_POST['livraisonEntreprise'] == "Oui"){ //livraison OUI
					$livraison = 1;
				}
				else{
					$livraison = 0;
				}

			$config = array(
			  'upload_path' => "./assets/image/Logos",
			  'allowed_types' => "gif|jpg|png|jpeg|pdf",
			  'overwrite' => FALSE,
			  'max_size' => "8192000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			  'max_height' => "1536",
			  'max_width' => "2048",
			  'encrypt_name' => TRUE
			);
			$this->load->library('upload', $config);

			//SI IL N'Y A PAS DE FICHIER

			if (!(isset($_FILES['logoEntreprise']['name']) && !empty($_FILES['logoEntreprise']['name']))) {
			  $data=array(
					"numSiret"=> htmlspecialchars($_POST['numSiret']),
					"nomEntreprise"=> htmlspecialchars($_POST['nomEntreprise']),
					"adresseEntreprise"=> htmlspecialchars($_POST['adresseEntreprise']),
					"codePEntreprise"=> htmlspecialchars($_POST['codePEntreprise']),
					"villeEntreprise" => htmlspecialchars($_POST['villeEntreprise']),
					"horairesEntreprise" => htmlspecialchars($horairesEntreprise),
					"livraisonEntreprise" => htmlspecialchars($livraison),
					"tempsReservMax" => htmlspecialchars($_POST['tempsReservMax']),
					"siteWebEntreprise" => htmlspecialchars($_POST['siteWebEntreprise']),
				);

				$this->entreprise->insert($data,$id);
				$data['message'] = "L'entreprise a bien été ajoutée";
				$this->load->view('errors/validation_formulaire', $data);
				$this->load->view('commercant/index',$data);
				$data['entreprise'] =$this->entreprise->selectById($_POST['numSiret']);
				$this->load->view('entreprise/profil',$data);
			}

			// SI IL Y A UN FICHIER
			else {

			  if (!($this->upload->do_upload('logoEntreprise'))) {

				log_message('error', $this->upload->display_errors());
				$data['message'] = "erreur : le logo n'a pas pu s'importer";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('commercant/index', $data);
				$this->load->view('commercant/ajout_entreprise');

			  }
			  else {
				$file_data = $this->upload->data();

				$data=array(
					"numSiret"=> htmlspecialchars($_POST['numSiret']),
					"nomEntreprise"=> htmlspecialchars($_POST['nomEntreprise']),
					"adresseEntreprise"=> htmlspecialchars($_POST['adresseEntreprise']),
					"codePEntreprise"=> htmlspecialchars($_POST['codePEntreprise']),
					"villeEntreprise" => htmlspecialchars($_POST['villeEntreprise']),
					"horairesEntreprise" => htmlspecialchars($horairesEntreprise),
					"livraisonEntreprise" => htmlspecialchars($livraison),
					"tempsReservMax" => htmlspecialchars($_POST['tempsReservMax']),
					"siteWebEntreprise" => htmlspecialchars($_POST['siteWebEntreprise']),
					"siteWebEntreprise" => htmlspecialchars($_POST['siteWebEntreprise']),
					"logoEntreprise" => htmlspecialchars($file_data['file_name'])

				);

				$this->entreprise->insert($data,$id);
				$data['message'] = "L'entreprise a bien été ajoutée";
				$this->load->view('errors/validation_formulaire', $data);
				$this->modifier_logo($file_data['file_name']);

			  }
			}
		  }
		  else {

			$data['message'] = "erreur : mauvais numéro de Siret";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('commercant/index', $data);
			$this->load->view('commercant/ajout_entreprise', $data);
		  }
		}
	}
    else
    {
      $this->load->view('pages/deconnexion');
      $this->load->view('pages/pageConnexionSellers');
    }


  }




      public function modifier_entreprise() {
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    if (isset($_COOKIE['commercantCookie'])) {
		$id=$_POST['numSiret'];
	  $entreprise = $this->entreprise->selectById($id);
	  $varMail = $this->input->cookie('commercantCookie');
      $data['commercant'] = $this->commercant->selectByMail($varMail);

	  //SI IL N'Y A PAS DE NOUVELLE IMAGE
	  if (!(isset($_FILES['logoEntreprise']['name']) && !empty($_FILES['logoEntreprise']['name']))) {
		  // SI IL Y EN AVAIT UNE AVANT
		  if($entreprise[0]->logoEntreprise != "null" ){
			$data = array(
				"numSiret" => htmlspecialchars($_POST['numSiret']),
                "nomEntreprise" => htmlspecialchars($_POST['nomEntreprise']),
                "adresseEntreprise" => htmlspecialchars($_POST['adresseEntreprise']),
                "codePEntreprise" => htmlspecialchars($_POST['codePEntreprise']),
                "villeEntreprise" => htmlspecialchars($_POST['villeEntreprise']),
                "horairesEntreprise" => htmlspecialchars($_POST['horairesEntreprise']),
                "livraisonEntreprise" => htmlspecialchars($_POST['livraisonEntreprise']),
                "tempsReservMax" => htmlspecialchars($_POST['tempsReservMax']),
                "siteWebEntreprise" => htmlspecialchars($_POST['siteWebEntreprise']),
				"logoEntreprise" => htmlspecialchars($entreprise[0]->logoEntreprise)
		  );
		  }
			else {
			//SI IL N'Y EN AVAIT PAS AVANT
				$data = array(
				"numSiret" => htmlspecialchars($_POST['numSiret']),
                "nomEntreprise" => htmlspecialchars($_POST['nomEntreprise']),
                "adresseEntreprise" => htmlspecialchars($_POST['adresseEntreprise']),
                "codePEntreprise" => htmlspecialchars($_POST['codePEntreprise']),
                "villeEntreprise" => htmlspecialchars($_POST['villeEntreprise']),
                "horairesEntreprise" => htmlspecialchars($_POST['horairesEntreprise']),
                "livraisonEntreprise" => htmlspecialchars($_POST['livraisonEntreprise']),
                "tempsReservMax" => htmlspecialchars($_POST['tempsReservMax']),
                "siteWebEntreprise" => htmlspecialchars($_POST['siteWebEntreprise']),
		  );
			}
			 $this->entreprise->update($id, $data);
		  $data['entreprise'] = $this->entreprise->selectById($id);
		  $data['message'] = "L'entreprise a été modifié avec succès";
		  $this->load->view('errors/validation_formulaire', $data);
		  $this->liste_entreprise();
	  }

	  //SI IL Y A UNE NOUVELLE IMAGE
	  else {
		  $config = array(
          'upload_path' => "./assets/image/Logos",
          'allowed_types' => "gif|jpg|png|jpeg|pdf",
          'overwrite' => FALSE,
          'max_size' => "8192000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
          'max_height' => "1536",
          'max_width' => "2048",
          'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
		  if (!($this->upload->do_upload('logoEntreprise'))) {

            log_message('error', $this->upload->display_errors());
            $data['message'] = "erreur : le logo n'a pas pu s'importer";
            $this->load->view('errors/erreur_formulaire', $data);
          	$this->load->view('commercant/index');
			$this->load->view('entreprise/profil', $data);

          }
          else {
            $file_data = $this->upload->data();

            $data = array(
                "numSiret" => htmlspecialchars($_POST['numSiret']),
                "nomEntreprise" => htmlspecialchars($_POST['nomEntreprise']),
                "adresseEntreprise" => htmlspecialchars($_POST['adresseEntreprise']),
                "codePEntreprise" => htmlspecialchars($_POST['codePEntreprise']),
                "villeEntreprise" => htmlspecialchars($_POST['villeEntreprise']),
                "horairesEntreprise" => htmlspecialchars($_POST['horairesEntreprise']),
                "livraisonEntreprise" => htmlspecialchars($_POST['livraisonEntreprise']),
                "tempsReservMax" => htmlspecialchars($_POST['tempsReservMax']),
                "siteWebEntreprise" => htmlspecialchars($_POST['siteWebEntreprise']),
				"logoEntreprise" => htmlspecialchars($file_data['file_name'])
            );
			$this->entreprise->update($id, $data);
			  $data['entreprise'] = $this->entreprise->selectById($id);
			  $data['message'] = "L'entreprise a été modifié avec succès";
			  $this->load->view('errors/validation_formulaire', $data);
			  $this->modifier_logo($file_data['file_name']);
		  }
	  }
	}
	else {
		  $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
		  $this->load->view('errors/erreur_formulaire', $data);
		  $this->load->view('commercant/connexion');
	}

  }


  public function detail_entreprise($id) {
    $this->load->model('commercant');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    $data['entreprises_header'] = $this->entreprise->selectAll();
    if (isset($_COOKIE['commercantCookie']) ) {
      if ($this->entreprise->selectById($id) != Null) {
        $data['entreprise'] = $this->entreprise->selectById($id);
        $this->load->view('commercant/index');
        $this->load->view('entreprise/profil', $data);
      } else {
        //ereur le produit n'existe pas
        $this->liste_entreprise();
      }
    } else {
      $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('commercant/connexion');
    }
  }





  public function modifier_logo($logoEntreprise){
    $this->load->library('image_lib');
    $config['image_library'] = 'gd2';
    $config['source_image'] = './assets/image/Logos/'.$logoEntreprise;
    //$config['new_image'] = './assets/image/Produits/resized_img.jpg';
    //$config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = 200;
    $config['height'] = 200;
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    $this->liste_entreprise();
  }


  public function supprimer_logo($id){
	$this->load->model('entreprise');
	$entreprise = $this->entreprise->selectById($id);
	$data = array(
              "numSiret" => htmlspecialchars($entreprise[0]->numSiret),
                "nomEntreprise" => htmlspecialchars($entreprise[0]->nomEntreprise),
                "adresseEntreprise" => htmlspecialchars($entreprise[0]->adresseEntreprise),
                "codePEntreprise" => htmlspecialchars($entreprise[0]->codePEntreprise),
                "villeEntreprise" => htmlspecialchars($entreprise[0]->villeEntreprise),
                "horairesEntreprise" => htmlspecialchars($entreprise[0]->horairesEntreprise),
                "livraisonEntreprise" => htmlspecialchars($entreprise[0]->livraisonEntreprise),
                "tempsReservMax" => htmlspecialchars($entreprise[0]->tempsReservMax),
                "siteWebEntreprise" => htmlspecialchars($entreprise[0]->siteWebEntreprise),
			   "logoEntreprise" => htmlspecialchars(NULL),
            );
	$this->entreprise->update($id, $data);
	$data['entreprise'] = $this->entreprise->selectById($id);
	$data['message'] = "Le logo a été supprimée avec succès";
	$this->load->view('errors/validation_formulaire', $data);
    $this->liste_entreprise();
  }


// Cette fonction est en commentaire car le but était d'ajouter un produit à une entreprise
// OR ce sont les sous produit qui sont lié à une entreprise
/* public function ajout_produit() {
$this->load->helper('form','url');
$this->load->helper('cookie');
$this->load->library('form_validation');
$this->load->model('commercant');
$this->load->model('entreprise');
$this->load->model('produit');
if($this->input->cookie('commercantCookie') != null){
$varMail= $this->input->cookie('commercantCookie');
$data['commercant']=$this->commercant->selectByMail($varMail);
$data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);
if ($this->form_validation->run() == FALSE)
{
$this->load->view('commercant/index',$data);
$this->load->view('commercant/ajout_produit',$data);
}
}
else
{
$data=array("numSiret"=> htmlspecialchars($_POST['numSiret']),
"nomProduit"=> htmlspecialchars($_POST['nomProduit']),
"adresseEntreprise"=> htmlspecialchars($_POST['adresseEntreprise']),
"codePEntreprise"=> htmlspecialchars($_POST['codePEntreprise']),
"villeEntreprise" => htmlspecialchars($_POST['villeEntreprise']),
"horairesEntreprise" => htmlspecialchars($horairesEntreprise),
"livraisonEntreprise" => htmlspecialchars($_POST['livraisonEntreprise']),
"tempsReservMax" => htmlspecialchars($_POST['tempsReservMax']),
);

}
}*/

public function connexion(){
	$this->load->helper('form','url');
	$this->load->helper('cookie');
	$this->load->library('form_validation');
	$this->load->model('commercant');
	$this->form_validation->set_rules('mailCommercant', 'Email', 'required');
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('commercant/connexion');
	}
	else
	{

		$com = $this->commercant->selectByMail($_POST['mailCommercant']);
		//le commercant qui essaye de se connecter

		if ($com == null){
			$data['message']="erreur : cette adresse email n'existe pas";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('commercant/connexion');
		}
		else{
			if(!password_verify($_POST['mdp'], $com[0]->mdpCommercant)){ //dé-hashage
				$data['message']="erreur : mauvais mot de passe";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('commercant/connexion');
			}
			else{
				//mettre la connexion dans les cookies
				//setcookie('commercantCookie',$com[0]->idCommercant,time()+3600,'/','');
				//	$this->load->view('commercant/index',$data);
				$data['commercant'] = $com;
				if($data['commercant'] != NULL && password_verify($_POST['mdp'], $com[0]->mdpCommercant)){ //dé-hashage
					$cookie = array(
						'name'   => 'commercantCookie',
						'value'  => $data['commercant'][0]->mailCommercant,
						'expire' => '3600'
					);
					$this->input->set_cookie($cookie);
					echo $this->input->cookie('commercantCookie');
					$this->load->view('commercant/index');
				}
			}
		}
	}
}

public function deconnexion(){
	$this->load->helper('url');
	$this->load->helper('cookie');
	delete_cookie("commercantCookie");
	$data['message'] = "Vous avez bien été deconnecté";
	$this->load->view('errors/validation_formulaire', $data);
	$this->connexion();
}

public function lie_commercant(){
	$this->load->model('commercant');
	$this->load->model('faire_partie');
	$this->load->helper('form','url');
	$this->load->helper('cookie');
	$this->load->library('form_validation');

	$cookie=$this->input->cookie('commercantCookie');
	$faitpartie=$this->commercant->selectById($cookie);
	//ligne de faire_partie correspondant à l'email Commercant

	$this->form_validation->set_rules('mailCommercant', 'Email', 'required');

	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('commercant/lie_commercant');
	}
	else
	{
		$comm=$this->commercant->selectByMail($_POST['mailCommercant']);
		//ligne commercant correspondant à cet email

		if ($comm == null){
			$data['message']="erreur : cette adresse email n'existe pas";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('commercant/lie_commercant');
		}
		else if( $faitpartie[0] == null){
			$data['message']="erreur : ce numéro SIRET ne corrspond pas à votre entreprise";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('commercant/lie_commercant');
		}
		else{
			$data=array(
				"numSiret"=> htmlspecialchars($_POST['siret']),
				"idCommercant"=> htmlspecialchars($comm[0]->idCommercant)
			);
			$this->faire_partie->insert($data);
		}
	}
}

public function inscription(){
	$this->load->model('commercant');
	$this->load->helper('form','url');
	$this->load->library('form_validation');

	$this->form_validation->set_rules('prenomCommercant', 'Prénom', 'alpha_dash');
	$this->form_validation->set_rules('nomCommercant', 'Nom', 'alpha_numeric_spaces');
	$this->form_validation->set_rules('mailCommercant', 'Email', 'valid_email');
	$this->form_validation->set_rules('codePCommercant', 'Code postale', 'integer');
	$this->form_validation->set_rules('villeCommercant', 'Ville', 'alpha_dash');
	$this->form_validation->set_rules('telCommercant', 'Numéro de téléphone', 'integer');

	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('commercant/inscription');
	}
	else
	{
		if (null != $this->commercant->selectByMail($_POST['mailCommercant'])){
			$data['message']="erreur : cet email n'est pas disponible";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('commercant/inscription');
		}
		else if($_POST['mdpCommercant'] == $_POST['mdpCommercant2'] ){
			$data=array(
				"prenomCommercant"=> htmlspecialchars($_POST['prenomCommercant']),
				"nomCommercant"=> htmlspecialchars($_POST['nomCommercant']),
				"mailCommercant" => htmlspecialchars($_POST['mailCommercant']),
				"mdpCommercant" => htmlspecialchars(crypt($_POST['mdpCommercant'],'md5')), //mot de passe en hashage
				"adresseCommercant"=> htmlspecialchars($_POST['adresseCommercant']),
				"codePCommercant"=> htmlspecialchars($_POST['codePCommercant']),
				"villeCommercant" => htmlspecialchars($_POST['villeCommercant']),
				"telCommercant" => htmlspecialchars($_POST['telCommercant']),
			);
			$this->commercant->insert($data);
			$data['message'] = "Vous avez été inscrit en tant que commerçant";
			$this->load->view('errors/validation_formulaire', $data);
			$this->load->view('commercant/connexion');
		}
		else {
			$data['message']="erreur : la confirmation de Mot de passe ne correspond pas au premier";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('commercant/inscription');
		}
	}
}

public function condition_utilisation(){
  $this->load->helper('form', 'url');

  $this->load->view('conditions');
}

}
