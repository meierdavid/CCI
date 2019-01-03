<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BonReducCtrl extends CI_Controller {

    public function liste_bonreduc() {
        $this->load->model('BonReduc');
        if ($this->input->cookie('commercantCookie') != null) {
            $varid = $this->input->cookie('commercantCookie');
            $data['commercant'] = $this->commercant->selectByMail($varid);
            $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);
            if ($data['entreprises'] != NULL) {
                var_dump($data);
                $data['bonreduc'] = $this->BonReduc->selectById($varid);
                $this->load->view('commercant/index', $data);
                $this->load->view('bonreduc/liste_bonreduc', $data);
            } else {
                $this->ajout_bon();
            }
        } else {
            $this->load->view('commercant/connexion');
        }
    }

    public function supprimer_bonreduc($id) {
        $this->load->model('BonReduc');
        $this->load->model('Entreprise');
        $this->load->helper('form', 'url');
        $this->bonreduc->delete($id);
        $data['message'] = "Le bon a bien été supprimé";
        $this->load->view('errors/validation_formulaire', $data);
        $this->liste_bon();
    }

    public function ajout_bonreduc() {

        $this->load->model('bonreduc');
        $this->load->model('entreprise');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if ($this->input->cookie('commercantCookie') != null) {
            $varMail = $this->input->cookie('commercantCookie');
            $data['commercant'] = $this->commercant->selectByMail($varMail);
            $data = $this->liste_entreprise_dropbox();
            if ($this->entreprise->selectById($_POST['numSiret']) != null) {

                $data = array(
                        "libelleBon" => htmlspecialchars($_POST['libelleBon']),
                        "numSiret" => htmlspecialchars($_POST['numSiret']),
                        "pourcentageBon" => htmlspecialchars($_POST['pourcentageBon']),
                        "prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit'])
                    );
                    $this->BonReduc->insert($data);
                    $data['bonreduc'] = $this->BonReduc->selectAll();
                    $this->liste_produit();

            }
            else {

                $data['message'] = "erreur : mauvais numéro de Siret";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('commercant/index', $data);
                $this->load->view('bonreduc/ajout_bonreduc', $data);
            }
        }
        else
        {
            $this->load->view('pages/deconnexion');
            $this->load->view('pages/pageConnexionSellers');
        }

    }





}
