<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ClientCtrl extends CI_Controller {

    // cette view sera utilisé pour afficher l'index du client quand le principe des cookies
    // fonctionnera. On l'appellera directement dans connection
    // si il n'y a pas de cookie client cette action redirige vers la page de déconnection
    public function index() {
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->model('client');
        var_dump($_COOKIE['clientCookie']);
        if (isset($_COOKIE['clientCookie'])) {
            $this->load->view('client/header');
            $this->load->view('client/accueil');
            $this->load->view('client/footer');
        } else {
            $this->load->view('pages/deconnexion');
        }
    }

    //Modifie le profil du client après validation du formulaire à la view client/profil
    public function modifier() {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->load->model('client');

        $this->form_validation->set_rules('prenomClient', 'Prénom', 'alpha_dash');
        $this->form_validation->set_rules('nomClient', 'Nom', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('mailClient', 'Email', 'valid_email');
        $this->form_validation->set_rules('codePClient', 'Code postale', 'integer');
        $this->form_validation->set_rules('villeClient', 'Ville', 'alpha_dash');
        $this->form_validation->set_rules('telClient', 'Numéro de téléphone', 'integer');
        
        if (isset($_COOKIE['clientCookie'])) {
            $varmail = $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varmail);
            $mdp = $data['client'][0]->mdpClient;
            $id = $data['client'][0]->idClient;
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('client/profil');
            } else {
                if ($varmail != $_POST['mailClient']) {
                    $data['message'] = "erreur : Vous ne pouvez pas changer votre adresse mail";
                    $this->load->view('errors/erreur_formulaire', $data);
                    $this->load->view('client/inscription');
                } else if ($_POST['mdpClient'] == $_POST['mdpClient2'] && $mdp == $_POST['mdpClient']) {
                    $data = array(
                        "prenomClient" => htmlspecialchars($_POST['prenomClient']),
                        "nomClient" => htmlspecialchars($_POST['nomClient']),
                        "mailClient" => htmlspecialchars($_POST['mailClient']),
                        "mdpClient" => htmlspecialchars($_POST['mdpClient']),
                        "adresseClient" => htmlspecialchars($_POST['adresseClient']),
                        "codePClient" => htmlspecialchars($_POST['codePClient']),
                        "villeClient" => htmlspecialchars($_POST['villeClient']),
                        "telClient" => htmlspecialchars($_POST['telClient']),
                        "pointClient" => htmlspecialchars(0),
                    );

                    $this->client->update($id, $data);
                    $data['client'] = $this->client->selectByMail($varmail);
                    $this->load->view('client/header');
                    $this->load->view('client/profil', $data);
                    $this->load->view('client/footer');
                } else {
                    $data['message'] = "erreur : la confirmation de Mot de passe ne correspond pas au premier";
                    $this->load->view('errors/erreur_formulaire', $data);
                    $this->load->view('client/header');
                    $this->load->view('client/profil', $data);
                    $this->load->view('client/footer');
                }
            }
        } else {
            $this->load->view('pages/deconnexion');
        }
    }
    // affiche la view client/profil si il y a un cookie client sinon déconnecte l'utilisateur
    public function profil() {
        $this->load->model('client');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        if (isset($_COOKIE['clientCookie'])) {
            $varmail = $this->input->cookie('clientCookie');
            if (isset($varmail)) {
                $data['client'] = $this->client->selectByMail($varmail);
                $this->load->view('client/header');
                $this->load->view('client/profil', $data);
                $this->load->view('client/footer');
            }
        } else {
            var_dump($_COOKIE);
        }

        // modifie le profil à l'envoi du formulaire
    }

    //Permet l'inscription du client. On doit verrifier qu'aucun autre client n'a déja utilisé cette adresse mail
    // ---On peut sécuriser cette fonction par envoie de mail---
    public function inscription() {
        // faire envoi de mail
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->load->model('client');
        $this->form_validation->set_rules('prenomClient', 'Prénom', 'alpha_dash');
        $this->form_validation->set_rules('nomClient', 'Nom', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('mailClient', 'Email', 'valid_email');
        $this->form_validation->set_rules('codePClient', 'Code postale', 'integer');
        $this->form_validation->set_rules('villeClient', 'Ville', 'alpha_dash');
        $this->form_validation->set_rules('telClient', 'Numéro de téléphone', 'integer');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('client/inscription');
        } else {
            if (null != $this->client->selectByMail($_POST['mailClient'])) {
                $data['message'] = "erreur : cet email n'est pas disponible";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/inscription');
            } else if ($_POST['mdpClient'] == $_POST['mdpClient2']) {
                $data = array(
                    "prenomClient" => htmlspecialchars($_POST['prenomClient']),
                    "nomClient" => htmlspecialchars($_POST['nomClient']),
                    "mailClient" => htmlspecialchars($_POST['mailClient']),
                    "mdpClient" => htmlspecialchars($_POST['mdpClient']),
                    "adresseClient" => htmlspecialchars($_POST['adresseClient']),
                    "codePClient" => htmlspecialchars($_POST['codePClient']),
                    "villeClient" => htmlspecialchars($_POST['villeClient']),
                    "telClient" => htmlspecialchars($_POST['telClient']),
                    "pointClient" => htmlspecialchars(0),
                );
                $this->client->insert($data);
                $this->load->view('pages/pageConnexion');
            } else {
                $data['message'] = "erreur : la confirmation de Mot de passe ne correspond pas au premier";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/inscription');
            }
        }
    }
    // vérifie la validité du formulaire client/connexion et créer le 'clientCookie'
    // Le cookie  est disponible sur le domaine: localhost aux chemins enfants de /cci/index.php

    public function connexion() {
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->model('client');
        $this->form_validation->set_rules('mailClient', 'Email', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('client/connexion');
        } else {
            $client = $this->client->selectByMail($_POST['mailClient']);
            //le client qui essaye de se connecter

            if ($client == null) {
                $data['message'] = "erreur : cet email n'existe pas";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/connexion');
            } else {
                if ($client[0]->mdpClient != $_POST['mdp']) {
                    $data['message'] = "erreur : mauvais mot de passe";
                    $this->load->view('errors/erreur_formulaire', $data);
                    $this->load->view('client/connexion');
                } else {
                    $data['client'] = $client;
                    if ($data['client'] != NULL && $_POST['mdp'] == $data['client'][0]->mdpClient) {
                        $cookie = array(
                            'name' => 'clientCookie',
                            'value' => $data['client'][0]->mailClient,
                            'expire' => '86500',
                            'domain' => 'localhost',
                            'path' => '/cci/index.php',
                        );
                        $this->input->set_cookie($cookie);
                        $this->load->view('client/header');
                        $this->load->view('client/accueil');
                        $this->load->view('client/footer');
                    }
                }
            }
        }
    }


    // Permet au client de changer son mot de passe
    public function changer_mdp() {
        $this->load->model('client');
        $this->load->helper('url');
        $this->load->library('form_validation');
        if (isset($_COOKIE['clientCookie'])) {
            $varid = $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varid);
            if (isset($_POST['mdpClientAncien']) && ($_POST['mdpClientAncien'] == $data['client'][0]->mdpClient)) {
                if ($_POST['mdpClientNouveau'] == $_POST['mdpClientConf']) {
                    $newMdp = $_POST['mdpClientNouveau'];
                    $this->client->updateMdp($varid, $newMdp);
                    setcookie("clientCookie", "", time() - 36000);
                    $this->load->view('client/connexion');
                } else {
                    $this->load->view('client/header');
                    $this->load->view('client/changer_mdp', $data);
                    $this->load->view('client/footer');
                }
            } else {
                $this->load->view('client/header');
                $this->load->view('client/changer_mdp', $data);
                $this->load->view('client/footer');
            }
        } else {
            $this->load->view('client/accueil');
        }
    }
    // permet au client de modifier son avis sur le produit passé en paramètre
    public function ajouter_avis($idProduit) {
        $this->load->model('client', 'produit');
        $this->load->model('poster_avis');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $data['produit'] = $this->produit->selectById($idProduit);
        $cookie = $this->input->cookie('clientCookie');
		$data['client']=$this->client->selectByMail($cookie);
        $cli = $this->client->selectByMail($cookie);

        $this->form_validation->set_rules('avisClient', 'Avis', 'alpha_dash');
		$this->form_validation->set_rules('noteClient', 'Note', 'integer');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('client/header');
            $this->load->view('client/avis_produit', $data);
            $this->load->view('client/footer');
        } else {

            if ($cli[0] == null) {
                $data['message'] = "erreur : pas de client";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/deconnexion');
            } else {

                $data = array(
                    "idProduit" => htmlspecialchars($idProduit),
                    "idClient" => htmlspecialchars($cli[0]->idClient),
                    "avisClient" => htmlspecialchars($_POST['avisClient']),
					"noteClient" => htmlspecialchars($_POST['noteClient'])
                );
                $this->poster_avis->insert($data);
				$data['client']=$this->client->selectByMail($cookie);
				$data['produit'] = $this->produit->selectById($idProduit);
                $this->load->view('client/header');
                $this->load->view('client/avis_produit', $data);
                $this->load->view('client/footer');
            }
        }
    }



    //permet de voir le détail d'un avis sur un produit dont l'idée est passé en paramètre
    //permet de modifier un avis après envoie du formulaire dans la view client/detail_avis
    public function detail_avis($idProduit){
        $this->load->helper('form', 'url');
        $this->load->model('produit','client');
        $this->load->model('poster_avis');
        $varMail = $this->input->cookie('clientCookie');
        $data['client'] = $this->client->selectByMail($varMail);
        $data['produit'] = $this->produit->selectById($idProduit);
        $data['avis'] = $this->poster_avis->selectByIdClient($data['client'][0]->idClient);
        if ($data['avis'] != NULL) {
            $this->load->view('client/header');
            $this->load->view('client/detail_avis', $data);
            $this->load->view('client/footer');
        } else {
            $this->load->view('produit/detail', $data);
        }
    }
    // permet de modifier l'avis du client ayant l'adresse mail contenue dans le cookie client par rapport
    // au produit dont l'id est passé en paramètre
    // Un client ne peut avoir qu'un avis sur un produit
    public function modifier_avis($idProduit) {
        $this->load->model('client', 'produit');
        $this->load->model('poster_avis');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $data['produit'] = $this->produit->selectById($idProduit);
        $cookie = $this->input->cookie('clientCookie');
		$data['client']=$this->client->selectByMail($cookie);
		$data['avis']=$this->poster_avis->selectByIdClientIdProduit($data['client'][0]->idClient,$idProduit);
        $cli = $this->client->selectByMail($cookie);

        $this->form_validation->set_rules('avisClient', 'Avis', 'alpha_dash');
		$this->form_validation->set_rules('noteClient', 'Note', 'integer');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('client/header');
            $this->load->view('client/modifier_avis', $data);
            $this->load->view('client/footer');
        } else {

            if ($cli[0] == null) {
                $data['message'] = "erreur : pas de client";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/deconnexion');
            } else {

                $data = array(
                    "idProduit" => htmlspecialchars($idProduit),
                    "idClient" => htmlspecialchars($cli[0]->idClient),
                    "avisClient" => htmlspecialchars($_POST['avisClient']),
					"noteClient" => htmlspecialchars($_POST['noteClient'])
                );
                $this->poster_avis->update($idProduit,$cli[0]->idClient,$data['avisClient'],$data['noteClient']);
				$data['client']=$this->client->selectByMail($cookie);
				$data['produit'] = $this->produit->selectById($idProduit);
				$data['avis'] = $this->poster_avis->selectByIdProduit($idProduit);
                $this->load->view('client/header');
                $this->load->view('produit/liste_avis', $data);
                $this->load->view('client/footer');
            }
        }
    }
    //deconnecte le client le redirige vers la page de connexion et enleve la durée de vie du cookie
    public function deconnexion() {
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        setcookie("clientCookie", "", time() - 86500);
        $this->load->view('pages/deconnexion');
        $this->connexion();
    }

}
