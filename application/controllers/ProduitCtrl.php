<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProduitCtrl extends CI_Controller {

  public function index() {
    $this->load->helper('url');
    $this->load->view('produit/profil');
  }

  public function profil() {
    $this->load->model('produit');
    $data['produit'] = $this->produit->selectById(1);
    // mettre mail pour la sélection
    $this->load->helper('url');
    $this->load->view('produit/profil', $data);

    // modifie le profil à l'envoi du formulaire
    // ptdddr pas mal les cc
  }

  public function liste_produit() {
    $this->load->model('Produit');
    if ($this->input->cookie('commercantCookie') != null) {
      $varid = $this->input->cookie('commercantCookie');
      $data['commercant'] = $this->commercant->selectByMail($varid);
      $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);
      if ($data['entreprises'] != NULL) {
        $data['produit'] = $this->Produit->selectProduit($varid);
        $this->load->view('commercant/index', $data);
        $this->load->view('produit/liste_produit', $data);

      } else {
        $this->ajout_entreprise();
      }
    } else {
      $this->load->view('client/connexion');
    }
  }

  public function liste_entreprise_dropbox() {
    $this->load->helper('cookie');
    $this->load->model('commercant');
    $this->load->model('entreprise');

    $varid = $this->input->cookie('commercantCookie');
    $data['commercant'] = $this->commercant->selectByMail($varid);
    $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);

    return $data;
  }

  public function ajout_produit() {
    // faire envoi de mail
    // envoi de mail lors de l'inscription d'un produit ?
    $this->load->model('produit');
    $this->load->model('entreprise');
    $this->load->helper('form');
    $this->load->library('form_validation');
    if ($this->input->cookie('commercantCookie') != null) {
      $varMail = $this->input->cookie('commercantCookie');
      $data['commercant'] = $this->commercant->selectByMail($varMail);
      $data = $this->liste_entreprise_dropbox();
      if ($this->entreprise->selectById($_POST['numSiret']) != null) {


        $config = array(
          'upload_path' => "./assets/image/Produits",
          'allowed_types' => "gif|jpg|png|jpeg|pdf",
          'overwrite' => FALSE,
          'max_size' => "8192000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
          'max_height' => "1536",
          'max_width' => "2048",
          'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);

        //SI IL N'Y A PAS DE FICHIER

        if (!(isset($_FILES['imageProduit']['name']) && !empty($_FILES['imageProduit']['name']))) {
          $data = array(
            "nomProduit" => htmlspecialchars($_POST['nomProduit']),
            "categorieProduit" => htmlspecialchars($_POST['categorieProduit']),
            "numSiret" => htmlspecialchars($_POST['numSiret']),
            "descriptionProduit" => htmlspecialchars($_POST['descriptionProduit']),
            "prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
            "reducProduit" => htmlspecialchars($_POST['reducProduit']),
            "couleurProduit" => htmlspecialchars($_POST['couleurProduit']),
            "nbDispoProduit" => htmlspecialchars($_POST['nbDispoProduit'])
          );
          $this->produit->insert_without_picture($data);
          $data['produit'] = $this->produit->selectAll();
          $this->liste_produit();
        }

        // SI IL Y A UN FICHIER
        else {

          if (!($this->upload->do_upload('imageProduit'))) {

            log_message('error', $this->upload->display_errors());
            $data['message'] = "erreur : la photo n'a pas pu s'importer";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('commercant/index', $data);
            $this->load->view('produit/ajout_produit');

          }
          else {
            $file_data = $this->upload->data();

            $data = array(
              "nomProduit" => htmlspecialchars($_POST['nomProduit']),
              "categorieProduit" => htmlspecialchars($_POST['categorieProduit']),
              "numSiret" => htmlspecialchars($_POST['numSiret']),
              "descriptionProduit" => htmlspecialchars($_POST['descriptionProduit']),
              "prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
              "reducProduit" => htmlspecialchars($_POST['reducProduit']),
              "couleurProduit" => htmlspecialchars($_POST['couleurProduit']),
              "nbDispoProduit" => htmlspecialchars($_POST['nbDispoProduit']),
              "imageProduit" => htmlspecialchars($file_data['file_name'])
            );
            $this->produit->insert_with_picture($data);
            $data['produit'] = $this->produit->selectAll();
            $this->modifier_image($file_data['file_name']);
          }
        }
      }
      else {

        $data['message'] = "erreur : mauvais numéro de Siret";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('commercant/index', $data);
        $this->load->view('produit/ajout_produit', $data);
      }
    }
    else
    {
      $this->load->view('pages/deconnexion');
      $this->load->view('client/connexion');
    }

  }

  public function supprimer_produit($id) {
    $this->load->model('produit');
    $this->load->model('poster_avis');
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->poster_avis->deleteByidProduit($id);
    $this->produit->delete($id);
    $data['message'] = "Le produit a bien été supprimé";
    $this->load->view('errors/validation_formulaire', $data);
    $this->liste_produit();
  }

  public function detail_produit($id) {
    $this->load->model('produit');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    $cookie = $this->input->cookie('clientCookie');
        $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    if (isset($_COOKIE['commercantCookie']) ) {
      if ($this->produit->selectById($id) != Null) {
        $data['produit'] = $this->produit->selectById($id);
        $this->load->view('commercant/index');
        $this->load->view('produit/detail', $data);
      } else {
        //ereur le produit n'existe pas
        $this->liste_produit();
      }
    } else {
      $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('client/connexion');
    }
  }

  //comme détail produit mais pour le client ( ne permet pas la modification )
public function affichage_produit($id) {
    $this->load->model('produit','entreprise');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    $cookie = $this->input->cookie('clientCookie');
        $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    if (isset($_COOKIE['clientCookie']) ) {
      if ($this->produit->selectById($id) != Null) {
        $data['produit'] = $this->produit->selectById($id);
        $data['entreprise'] = $this->entreprise->selectById($data['produit'][0]->numSiret);
        $data['note']=$this->moyenne_note_produit(($data['produit'][0]->idProduit));
        $data['produitsProposés']=$this->produit->selectPropose($data['produit'][0]->categorieProduit,$id);
        $this->load->view('client/header',$data);
        $this->load->view('produit/affichage_produit', $data);
        $this->load->view('client/footer');
      } else {
        //ereur le produit n'existe pas
        $this->liste_produit();
      }
    } else {
      $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('client/connexion');
    }
  }
  public function produit_all(){
      $this->load->model('produit','entreprise');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    if (isset($_COOKIE['clientCookie']) ) {
    $cookie = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    $this->load->view('client/header',$data);
    $this->load->view('produit/liste_categories',$data);
    $this->load->view('client/footer');
    }else{
        $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('client/connexion');
    }
  }
  public function comparer_produit($id){
    $this->load->model('produit','entreprise');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    $cookie = $this->input->cookie('clientCookie');
        $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    if (isset($_COOKIE['clientCookie']) ) {
      if ($this->produit->selectById($id) != Null) {
        $data['produit'] = $this->produit->selectById($id);
        $data['entreprises']['entreprise0'] = $this->entreprise->selectById($data['produit'][0]->numSiret);
        $data['notes'][0]=$this->moyenne_note_produit(($data['produit'][0]->idProduit));
        $data['produitsProposés']=$this->produit->selectPropose($data['produit'][0]->categorieProduit,$id);
        foreach ($data['produitsProposés'] as $item){
            array_push($data['notes'],$this->moyenne_note_produit($item->idProduit));
        }
        $i = 1;
        foreach ($data['produitsProposés'] as $item){
            $data['entreprises']['entreprise'.$i] =$this->entreprise->selectById($item->numSiret);
            $i= $i +1;
        }
        $this->load->view('client/header',$data);
        $this->load->view('produit/comparaison_produit',$data);
        $this->load->view('client/footer');
      } else {
        //ereur le produit n'existe pas
        $this->liste_produit();
      }
    } else {
      $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
			$this->load->view('errors/erreur_formulaire', $data);
			$this->load->view('client/connexion');
    }
  }
  public function moyenne_note_produit($idProduit){
    $this->load->model('poster_avis');
    return $this->poster_avis->moyenne($idProduit);
  }


  public function modifier() {
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('produit');
    if (isset($_COOKIE['commercantCookie'])) {
      $id = $_POST['idProduit'];
	  $produit = $this->produit->selectById($id);
	  if($_POST['categorieProduit'] == NULL){
		  $categorie=$produit[0]->categorieProduit;
	  }
	  else {
		  $categorie=$_POST['categorieProduit'];
	  }
	  //SI IL N'Y A PAS DE NOUVELLE IMAGE
	  if (!(isset($_FILES['imageProduit']['name']) && !empty($_FILES['imageProduit']['name']))) {
		  // SI IL Y EN AVAIT UNE AVANT
		  if($produit[0]->imageProduit != "null" ){
				$data = array(
			"nomProduit" => htmlspecialchars($_POST['nomProduit']),
			"categorieProduit" => htmlspecialchars($categorie),
			"numSiret" => htmlspecialchars($_POST['numSiret']),
			"descriptionProduit" => htmlspecialchars($_POST['descriptionProduit']),
			"prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
			"reducProduit" => htmlspecialchars($_POST['reducProduit']),
			"couleurProduit" => htmlspecialchars($_POST['couleurProduit']),
			"nbDispoProduit" => htmlspecialchars($_POST['nbDispoProduit']),
			"imageProduit" => htmlspecialchars($produit[0]->imageProduit)
		  );
		  }
			else {
			//SI IL N'Y EN AVAIT PAS AVANT
				$data = array(
			"nomProduit" => htmlspecialchars($_POST['nomProduit']),
			"categorieProduit" => htmlspecialchars($categorie),
			"numSiret" => htmlspecialchars($_POST['numSiret']),
			"descriptionProduit" => htmlspecialchars($_POST['descriptionProduit']),
			"prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
			"reducProduit" => htmlspecialchars($_POST['reducProduit']),
			"couleurProduit" => htmlspecialchars($_POST['couleurProduit']),
			"nbDispoProduit" => htmlspecialchars($_POST['nbDispoProduit']),
		  );
			}
			 $this->produit->update($id, $data);
		  $data['produit'] = $this->produit->selectById($id);
		  $data['message'] = "Le produit a été modifié avec succès";
		  $this->load->view('errors/validation_formulaire', $data);
		  $this->liste_produit();
	  }

	  //SI IL Y A UNE NOUVELLE IMAGE
	  else {
		  $config = array(
          'upload_path' => "./assets/image/Produits",
          'allowed_types' => "gif|jpg|png|jpeg|pdf",
          'overwrite' => FALSE,
          'max_size' => "8192000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
          'max_height' => "1536",
          'max_width' => "2048",
          'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
		  if (!($this->upload->do_upload('imageProduit'))) {

            log_message('error', $this->upload->display_errors());
            $data['message'] = "erreur : la photo n'a pas pu s'importer";
            $this->load->view('errors/erreur_formulaire', $data);
          	$this->load->view('commercant/index');
			$this->load->view('produit/detail', $data);

          }
          else {
            $file_data = $this->upload->data();

            $data = array(
              "nomProduit" => htmlspecialchars($_POST['nomProduit']),
              "categorieProduit" => htmlspecialchars($categorie),
              "numSiret" => htmlspecialchars($_POST['numSiret']),
              "descriptionProduit" => htmlspecialchars($_POST['descriptionProduit']),
              "prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
              "reducProduit" => htmlspecialchars($_POST['reducProduit']),
              "couleurProduit" => htmlspecialchars($_POST['couleurProduit']),
              "nbDispoProduit" => htmlspecialchars($_POST['nbDispoProduit']),
              "imageProduit" => htmlspecialchars($file_data['file_name'])
            );
			$this->produit->update($id, $data);
			  $data['produit'] = $this->produit->selectById($id);
			  $data['message'] = "Le produit a été modifié avec succès";
			  $this->load->view('errors/validation_formulaire', $data);
			  $this->modifier_image($file_data['file_name']);
		  }
	  }


		}
	else {
		  $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
		  $this->load->view('errors/erreur_formulaire', $data);
		  $this->load->view('client/connexion');
	}

  }


  public function supprimer_image($id){
	$this->load->model('produit');
	$produit = $this->produit->selectById($id);
	$data = array(
              "nomProduit" => htmlspecialchars($produit[0]->nomProduit),
              "categorieProduit" => htmlspecialchars($produit[0]->categorieProduit),
              "numSiret" => htmlspecialchars($produit[0]->numSiret),
              "descriptionProduit" => htmlspecialchars($produit[0]->descriptionProduit),
              "prixUnitaireProduit" => htmlspecialchars($produit[0]->prixUnitaireProduit),
              "reducProduit" => htmlspecialchars($produit[0]->reducProduit),
              "couleurProduit" => htmlspecialchars($produit[0]->couleurProduit),
              "nbDispoProduit" => htmlspecialchars($produit[0]->nbDispoProduit),
			   "imageProduit" => htmlspecialchars(NULL),
            );
	$this->produit->update($id, $data);
	$data['produit'] = $this->produit->selectById($id);
	$data['message'] = "L'image a été supprimée avec succès";
	$this->load->view('errors/validation_formulaire', $data);
    $this->liste_produit();
  }


  public function categorie($categorie) {
    $i=0;
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('produit');
    $this->load->model('entreprise');
    $cookie = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    if ($this->produit->selectByCategorie($categorie) != null) {
      $data['produit'] = $this->produit->selectByCategorie($categorie);
      foreach ($data['produit'] as $item) {
        $data['note'][$i]=$this->moyenne_note_produit($item->idProduit);
        $i=$i+1;
      }
      $this->load->view('client/header',$data);
      $this->load->view('produit/produit_par_categorie(2)', $data);
      $this->load->view('client/footer');
    } else {
      $data['message'] = "erreur : Désolé, les produits de cette catégorie ne sont pas disponibles";
      $this->load->view('errors/erreur_formulaire', $data);
      $this->load->view('client/header',$data);
      $this->load->view('client/accueil');
      $this->load->view('client/footer');
    }
  }

  public function produit_entreprise($idEntreprise) {
	$i=0;
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('produit','entreprise');
    $this->load->model('entreprise');
    $cookie = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    if ($this->produit->selectByEntreprise($idEntreprise) != null) {
      $data['produit'] = $this->produit->selectByEntreprise($idEntreprise);
	  foreach ($data['produit'] as $item) {
        $data['note'][$i]=$this->moyenne_note_produit($item->idProduit);
        $i=$i+1;
      }
      $data['entreprise'] = $this->entreprise->selectById($idEntreprise);
      $this->load->view('client/header',$data);
      $this->load->view('produit/produit_par_entreprise(2)', $data);
      $this->load->view('client/footer');
    } else {
      $data['message'] = "Cette entreprise n'a pas de produit disponible pour le moment";
      $this->load->view('errors/erreur_formulaire', $data);
      $this->load->view('client/header',$data);
      $this->load->view('client/accueil');
      $this->load->view('client/footer');
    }
  }

  public function soldes() {
	$i=0;
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('produit');
    $this->load->model('entreprise');
    $cookie = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    if ($this->produit->selectBySoldes() != null) {
      $data['produit'] = $this->produit->selectBySoldes();
	  foreach ($data['produit'] as $item) {
        $data['note'][$i]=$this->moyenne_note_produit($item->idProduit);
        $i=$i+1;
      }
      $this->load->view('client/header',$data);
      $this->load->view('produit/produit_par_soldes(2)', $data);
      $this->load->view('client/footer');
    } else {
      $this->load->view('client/header',$data);
      $this->load->view('client/accueil');
      $this->load->view('client/footer');
    }
  }

  public function search() {
    $i=0;
    $this->load->helper('form', 'url','cookie');
    $this->load->model('produit');
    $this->load->model('entreprise');
    $cookie = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    if (isset($_POST['search'])) {
      $str = $_POST['search'];
      $str = preg_replace("#[^0-9a-z]#i", "", $str);
      if ($this->produit->search($str) != null) {
        $data['produit'] = $this->produit->search($str);
		$data['recherche']=$_POST['search'];
	foreach ($data['produit'] as $item) {
        $data['note'][$i]=$this->moyenne_note_produit($item->idProduit);
        $i=$i+1;
      }
        $this->load->view('client/header',$data);
        $this->load->view('produit/produit_par_recherche(2)', $data);
        $this->load->view('client/footer');
      } else {
        $data['message'] = "Aucun produit trouvé";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('client/header',$data);
        $this->load->view('client/accueil');
        $this->load->view('client/footer');
      }
    } else {
      //
    }
  }




  public function modifier_image($imageProduit){
    $this->load->library('image_lib');
    $config['image_library'] = 'gd2';
    $config['source_image'] = './assets/image/Produits/'.$imageProduit;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = 150;
    $config['height'] = 150;
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    $this->liste_produit();
  }


  public function liste_avis($idProduit) {
    $this->load->helper('form', 'url');
    $this->load->model('produit','client');
    $this->load->model('poster_avis');
    $this->load->model('entreprise');
    $data['entreprises_header'] = $this->entreprise->selectAll();
    $varMail = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($varMail);
    $data['produit'] = $this->produit->selectById($idProduit);
    $data['avis'] = $this->poster_avis->selectByIdProduit($idProduit);

    if ($data['avis'] != NULL) {
      $this->load->view('client/header',$data);
      $this->load->view('produit/liste_avis', $data);
      $this->load->view('client/footer');
    } else {
      $this->load->view('client/header',$data);
      $this->load->view('produit/premier_avis', $data);
      $this->load->view('client/footer');
    }
  }


  public function prix_a_afficher($idProduit){
	  $this->load->model('produit');
          return ($this->produit->prix_a_afficher($idProduit));
  }

  public function produit_offre(){
      $this->load->model('produit');
      $data['produit']= $this->produit->selectByOffre();
      $this->affichage_produit($data['produit'][0]->idProduit);
  }

  public function produit_recent(){
      $this->load->model('produit');
      $data['produit']= $this->produit->selectByRecent();
      $this->affichage_produit($data['produit'][0]->idProduit);
  }
}
