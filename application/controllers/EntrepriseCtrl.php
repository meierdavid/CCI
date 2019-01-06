<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EntrepriseCtrl extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $this->load->view('Entreprise/index');
    }

    public function add_entreprise() { //paremetre mail du commercant ou cookie pour le récupérer
        $this->load->model('entreprise');
        $this->load->helper('form');
        $this->load->view('entreprise/ajout_entreprise');
    }

    public function profil($num) {
        $this->load->helper('cookie');
        $this->load->helper('url');
        if ($this->input->cookie('commercantCookie') != FALSE) { // il faudra vérifier que c'est le bon commerçant qui est connecté
            $this->load->model('entreprise');
            $data['entreprise'] = $this->entreprise->selectById($num);
            $this->load->view('entreprise/index', $data);
            $this->load->view('entreprise/profil', $data);
        } else {
            $this->load->view('client/connexion');
        }
    }

    /*public function detail_entreprise($id) {
        $this->load->helper('form', 'url');
        $this->load->model('entreprise');
        $this->load->helper('cookie');

        if (isset($_COOKIE['commercantCookie'])) {
            if ($this->entreprise->selectById($id) != Null) {
                $data['entreprise'] = $this->entreprise->selectById($id);
                $this->load->view('commercant/index');
                $this->load->view('entreprise/profil', $data);
            } else {
                $data['message'] = "erreur : L'entreprise n'existe pas";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->liste_entreprise();
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('c/connexion');
        }
    }*/

	

  
   public function magasin_all(){
    $this->load->model('entreprise');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('entreprise');
    if (isset($_COOKIE['clientCookie']) ) {
    $cookie = $this->input->cookie('clientCookie');
    $data['client'] = $this->client->selectByMail($cookie);
    $data['entreprises_header'] = $this->entreprise->selectAll();
    
    $this->load->view('client/header',$data);
    $this->load->view('entreprise/liste_entreprises',$data);
    $this->load->view('client/footer');
    }else{
        $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('client/connexion');
    }
   }


       public function liste_produit($num) {
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->model('entreprise');
        $this->load->helper('form');
        if ($this->input->cookie('commercantCookie') != FALSE) { // il faudra vérifier que c'est le bon commerçant qui est connecté
            $data['entreprise'] = $this->entreprise->selectById($num);
            $data['produits'] = $this->produit->SelectByEntreprise($num);
            $this->load->view('entreprise/index', $data);
            $this->load->view('entreprise/liste_produit', $data);
        } else {
            $this->load->view('client/connexion');
        }
    }

    public function affichage_entreprise($id) {
        $this->load->model('entreprise');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->model('entreprise');
		$cookie=$this->input->cookie('clientCookie');
		$data['client']=$this->client->SelectByMail($cookie);
        $data['entreprises_header'] = $this->entreprise->selectAll();
        if (isset($_COOKIE['clientCookie'])) {
            if ($this->entreprise->selectById($id) != Null) {
                $data['entreprise'] = $this->entreprise->selectById($id);
                $this->load->view('client/header', $data);
                $this->load->view('entreprise/affichage_entreprise', $data);
                $this->load->view('client/footer');
            } else {
                //ereur l'entreprise n'existe pas (ne devrait pas pouvoir arriver)
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

}
