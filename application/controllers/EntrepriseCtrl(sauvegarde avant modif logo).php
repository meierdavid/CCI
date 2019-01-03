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
            $this->load->view('pages/pageconnexion');
        }
    }

    public function detail_entreprise($id) {
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
            $this->load->view('commercant/connexion');
        }
    }

    public function modifier_entreprise() {
        $this->load->helper('form', 'url');
        $this->load->model('entreprise');

        if (isset($_COOKIE['commercantCookie'])) {
            $id = $_POST['numSiret'];
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
            $this->entreprise->update($id, $data);
            $data['entreprise'] = $this->entreprise->selectById($id);
            $data['message'] = "L'entreprise a été modifié avec succès";
            $this->load->view('errors/validation_formulaire', $data);
            $this->load->view('commercant/index');
            $this->load->view('commercant/liste_entreprise', $data);
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('commercant/connexion');
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
            $this->load->view('pages/pageconnexion');
        }
    }

    public function affichage_entreprise($id) {
        $this->load->model('entreprise');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->model('entreprise');
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
