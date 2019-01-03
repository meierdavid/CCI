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
                $data['bonreduc'] = $this->BonReduc->selectBonReduc($varid);
                $this->load->view('commercant/index', $data);
                $this->load->view('bonreduc/liste_bonreduc', $data);

            } else {
                $this->ajout_bon();
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

    public function supprimer_bonreduc($id) {
        $this->load->model('BonReduc');
        $this->load->model('Entreprise');
        $this->load->helper('form', 'url');
        $this->BonReduc->delete($id);
        $data['message'] = "Le bon a bien été supprimé";
        $this->load->view('errors/validation_formulaire', $data);
        $this->liste_bonreduc();
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
                    );
                    $this->bonreduc->insert($data);
                    $data['bonreduc'] = $this->bonreduc->selectAll();
                    $this->liste_bonreduc();

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
