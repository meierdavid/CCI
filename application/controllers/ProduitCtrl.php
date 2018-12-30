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
      $this->load->view('commercant/connexion');
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
      $this->load->view('pages/pageConnexionSellers');
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
    var_dump("detail");
    if (isset($_COOKIE['commercantCookie'])) {
      if ($this->produit->selectById($id) != Null) {
        var_dump("produit");
        $data['produit'] = $this->produit->selectById($id);
        $this->load->view('commercant/index');
        $this->load->view('produit/detail', $data);
      } else {
        //ereur le produit n'existe pas
        $this->liste_produit();
      }
    } else {
      $this->load->view('pages/deconnexion');
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
      var_dump($id);
      var_dump($_POST);
      $data = array(
        "nomProduit" => htmlspecialchars($_POST['nomProduit']),
        "categorieProduit" => htmlspecialchars($_POST['categorieProduit']),
        "numSiret" => htmlspecialchars($_POST['numSiret']),
        "descriptionProduit" => htmlspecialchars($_POST['descriptionProduit']),
        "prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
        "reducProduit" => htmlspecialchars($_POST['reducProduit']),
        "couleurProduit" => htmlspecialchars($_POST['couleurProduit']),
        "nbDispoProduit" => htmlspecialchars($_POST['nbDispoProduit']),
      );
      $this->produit->update($id, $data);
      $data['produit'] = $this->produit->selectById($id);
      $data['message'] = "Le produit a été modifié avec succès";
      $this->load->view('errors/validation_formulaire', $data);
      $this->load->view('commercant/index');
      $this->load->view('produit/detail', $data);
    } else {
      $this->load->view('pages/deconnexion');
    }
  }

  public function categorie($categorie) {
    $i=0;
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('produit');
    if ($this->produit->selectByCategorie($categorie) != null) {
      $data['produit'] = $this->produit->selectByCategorie($categorie);
      foreach ($data['produit'] as $item) {
        $data['note'][$i]=$this->moyenne_note_produit($item->idProduit);
        $i=$i+1;
      }
      var_dump($data);
      $this->load->view('client/header');
      $this->load->view('produit/produit_par_categorie(2)', $data);
      $this->load->view('client/footer');
    } else {
      $this->load->view('client/header');
      $this->load->view('client/accueil');
      $this->load->view('client/footer');
    }
  }

  public function produit_entreprise($idEntreprise) {
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('produit','entreprise');
    if ($this->produit->selectByEntreprise($idEntreprise) != null) {
      $data['produit'] = $this->produit->selectByEntreprise($idEntreprise);
      $data['entreprise'] = $this->entreprise->selectById($idEntreprise);
      $this->load->view('client/header');
      $this->load->view('produit/produit_par_entreprise', $data);
      $this->load->view('client/footer');
    } else {
      $this->load->view('client/header');
      $this->load->view('client/accueil');
      $this->load->view('client/footer');
    }
  }

  public function soldes() {
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('produit');
    if ($this->produit->selectBySoldes() != null) {
      $data['produit'] = $this->produit->selectBySoldes();
      $this->load->view('client/header');
      $this->load->view('produit/produit_par_soldes', $data);
      $this->load->view('client/footer');
    } else {
      $this->load->view('client/header');
      $this->load->view('client/accueil');
      $this->load->view('client/footer');
    }
  }

  public function search() {
    $this->load->helper('form', 'url','cookie');
    $this->load->library('form_validation');
    $this->load->model('produit');
    if (isset($_POST['search'])) {
      $str = $_POST['search'];
      $str = preg_replace("#[^0-9a-z]#i", "", $str);
      if ($this->produit->search($str) != null) {
        $data['produit'] = $this->produit->search($str);
        $this->load->view('client/header');
        $this->load->view('produit/produit_par_recherche', $data);
        $this->load->view('client/footer');
      } else {
        //
      }
    } else {
      //
    }
  }




  public function modifier_image($imageProduit){
    $this->load->library('image_lib');
    $config['image_library'] = 'gd2';
    $config['source_image'] = './assets/image/Produits/'.$imageProduit;
    //$config['new_image'] = './assets/image/Produits/resized_img.jpg';
    //$config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']         = 200;
    $config['height']       = 200;
    $this->image_lib->initialize($config);
    var_dump($config);
    $this->image_lib->resize();
    $this->liste_produit();
  }


  public function liste_avis($idProduit) {
    $this->load->helper('form', 'url');
    $this->load->model('produit','client');
    $this->load->model('poster_avis');
    $varMail = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($varMail);
    $data['produit'] = $this->produit->selectById($idProduit);
    $data['avis'] = $this->poster_avis->selectByIdProduit($idProduit);

    if ($data['avis'] != NULL) {
      $this->load->view('client/header');
      $this->load->view('produit/detail', $data);
      $this->load->view('produit/liste_avis', $data);
      $this->load->view('client/footer');
    } else {
      $this->load->view('produit/detail', $data);
    }
  }


}
