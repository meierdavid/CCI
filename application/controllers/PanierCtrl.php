<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanierCtrl extends CI_Controller {


  public function index()
  {
    $this->load->helper('url');
    $this->load->view('client/accueil');
  }

  public function finaliser(){
    $this->load->model('panier');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    if (isset($_COOKIE['clientCookie'])) {

      //

    }else{
      $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
      $this->load->view('errors/erreur_formulaire', $data);
      $this->load->view('client/connexion');
    }
  }



public function liste_panier(){
  $this->load->model('panier');
  $this->load->model('produit');

  if($this->input->cookie('clientCookie') != null){
    $varid = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($varid);

    $data['panier'] = $this->panier->selectByIdClient($data['client'][0]->idClient);
    if( $data['panier'] != NULL){
      $data['produit'] = $this->produit->selectProduit($varid);
      $this->load->view('client/header');
      $this->load->view('client/liste_panier',$data);
      $this->load->view('client/footer');
    }
    else{
      $this->panier->ajout_panier();
    }
  }
  else{
    $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
    $this->load->view('errors/erreur_formulaire', $data);
    $this->load->view('client/connexion');
  }
}

public function ajout_panier($idProduit){
  $this->load->model('panier');
  $this->load->model('produit');
  //$this->load->model('commander');

  $this->load->helper('form', 'url');
  $this->load->helper('cookie');

  if(isset($_COOKIE['clientCookie'])){
    $varmail = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($varmail);
    $idClient = $data['client'][0]->idClient;

    $data['produit'] = $this->produit->selectById($idProduit);
    $prix = $this->produit->prix_a_afficher($idProduit);
    $date = date("d-m-y H:i:s");

    $data['panier'] = $this->panier->selectByIdClient($idClient);

    if($data['panier'] == null){ //panier inexistant : on le créé
      $data=array(
        "datePanier"=> htmlspecialchars($date),
        "annulationPanier"=> htmlspecialchars(0),
        "codePromo"=> htmlspecialchars(0),
        "paiementPanier"=> htmlspecialchars(0),
        "finaliserPanier" => htmlspecialchars(0),
        "idClient" => htmlspecialchars($idClient),
        "prixTotPanier" => htmlspecialchars($prix),
      );
      $this->panier->insert($data);

      $data['message'] = "Le produit a bien été ajouté au panier";
      $this->load->view('errors/validation_formulaire', $data);
      $this->load->view('client/header');
      $this->load->view('client/accueil');
      $this->load->view('client/footer');
    }
    else{ //panier déjà existant : MAJ
      $prix = $prix + $data['panier'][0]->prixTotPanier;
      $idPanier = $data['panier'][0]->idPanier;

      $data=array(
        "annulationPanier"=> htmlspecialchars(0),
        "codePromo"=> htmlspecialchars(0),
        "datePanier"=> htmlspecialchars($date),
        "finaliserPanier" => htmlspecialchars(0),
        "paiementPanier"=> htmlspecialchars(0),
        "prixTotPanier" => htmlspecialchars($prix),
      );
      $this->panier->update($idPanier, $data);

      $data['message'] = "Le produit a bien été ajouté au panier";
      $this->load->view('errors/validation_formulaire', $data);
      $this->load->view('client/header');
      $this->load->view('client/accueil');
      $this->load->view('client/footer');
    }
  }
  else {
    $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
    $this->load->view('errors/erreur_formulaire', $data);
    $this->load->view('client/connexion');
  }
}

public function supprimer_produit_panier($idProduit){
  $this->load->model('panier');
  $this->load->helper('form','url');


}

public function supprimer_panier($id){
  $this->load->model('panier');
  $this->load->helper('form','url');
  $this->load->library('form_validation');
  $this->load->view('client/accueil');
  $this->produit->delete($id);
  echo "panier Supprimé";
  $this->liste_panier();
}

public function modifier(){
  $this->load->helper('form', 'url');
  $this->load->library('form_validation');
  $this->load->model('panier');
  if(isset($_COOKIE['clientCookie'])){
    $id = $_POST['idPanier'];
    var_dump($id);
    var_dump($_POST);
    $data=array(
      "datePanier"=> htmlspecialchars($_POST['datePanier']),
      "codePromo"=> htmlspecialchars($_POST['codePromo']),
      "annulationPanier"=> htmlspecialchars($_POST['annulationPanier']),
      "finaliserPanier"=> htmlspecialchars($_POST['finaliserPanier']),
      "paiementPanier" => htmlspecialchars($_POST['paiementPanier']),
      "prixTotPanier" => htmlspecialchars($_POST['prixTotPanier']),
    );
    $this->panier->update($id,$data);
    $data['panier']= $this->panier->selectById($id);

    $this->load->view('client/accueil');
    $this->load->view('panier/detail',$data);

  }
  else{
    $this->load->view('pages/deconnexion');
  }
}



}
