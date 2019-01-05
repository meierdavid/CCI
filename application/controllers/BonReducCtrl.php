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

    public function liste_bonreduc_client() {
        $this->load->model('BonReduc');
        $this->load->helper('form', 'url');

        if ($this->input->cookie('clientCookie') != null) {
			$cookie=$this->input->cookie('clientCookie');
			$data['client']=$this->client->SelectByMail($cookie);
			$data['entreprises_header'] = $this->entreprise->selectAll();
            $data['bonreduc'] = $this->BonReduc->SelectAll();
            $this->load->view('client/header', $data);
            $this->load->view('bonreduc/liste_bonreduc_client', $data);
            $this->load->view('client/footer');
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
						"descriptionBon" => htmlspecialchars($_POST['descriptionBon']),
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

    public function detail_bonreduc($id) {
        $this->load->model('bonreduc');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        var_dump("detail");
        if (isset($_COOKIE['commercantCookie']) ) {
            if ($this->bonreduc->selectById($id) != Null) {
                var_dump("bonreduc");
                $data['bonreduc'] = $this->bonreduc->selectById($id);
                $this->load->view('commercant/index');
                $this->load->view('bonreduc/detail', $data);
                var_dump($data);
            } else {
                //ereur le produit n'existe pas
                $this->liste_bonreduc();
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('commercant/connexion');
        }
    }

    public function modifier() {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->load->model('bonreduc');
        if (isset($_COOKIE['commercantCookie'])) {
            $id = $_POST['idBon'];
            $data = array(
                "libelleBon" => htmlspecialchars($_POST['libelleBon']),
                "numSiret" => htmlspecialchars($_POST['numSiret']),
                "pourcentageBon" => htmlspecialchars($_POST['pourcentageBon']),
                "idBon" => htmlspecialchars($_POST['idBon']),
				"descriptionBon" => htmlspecialchars($_POST['descriptionBon']),
            );
            $this->bonreduc->update($id, $data);
            $data['bonreduc'] = $this->bonreduc->selectById($id);
            $data['message'] = "Le Bon a été modifié avec succès";
            $this->load->view('commercant/index');
            $this->load->view('bonreduc/liste_bonreduc', $data);
        }

        else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('commercant/connexion');
        }

    }






}
