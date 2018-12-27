<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProduitCtrl extends CI_Controller {

	
	    public function index()
        {
            $this->load->helper('url');
            $this->load->view('produit/profil');               
	    }

        public function profil()
        {
            $this->load->model('produit');
            $data['produit'] = $this->produit->selectById(1);
            // mettre mail pour la sélection
            $this->load->helper('url');
            $this->load->view('produit/profil',$data);

            // modifie le profil à l'envoi du formulaire
            // ptdddr pas mal les cc
        }


        
        public function liste_produit(){
            $this->load->model('Produit');
            $data['produit'] = $this->Produit->selectAll();
            $this->load->view('commercant/index');
            $this->load->view('produit/liste_produit',$data);
        }
        
        public function ajout_produit(){
                // faire envoi de mail
                // envoi de mail lors de l'inscription d'un produit ?
                $this->load->model('produit');
                $this->load->model('entreprise');
                $this->load->helper('form');
                if($this->entreprise->selectById($_POST['numSiret']) != null){
                    
                    
                   $data=array(
                        "nomProduit"=> htmlspecialchars($_POST['nomProduit']),
                        "categorieProduit"=> htmlspecialchars($_POST['categorieProduit']),
                        "numSiret"=> htmlspecialchars($_POST['numSiret']),
                        "descriptionProduit"=> htmlspecialchars($_POST['descriptionProduit']),
                        "prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
                        "reducProduit" => htmlspecialchars($_POST['reducProduit']),
                   );
                   
                   $this->produit->insert($data);
                   $data['produit'] = $this->produit->selectAll();
                   $this->load->view('commercant/index',$data);
                   $this->load->view('produit/liste_produit',$data);
                   }
                   else
                   {
                        var_dump("mauvais ");
                        $data['message']="erreur : mauvais numéro de Siret";
                        $this->load->view('errors/erreur_formulaire', $data);
                        $this->load->view('commercant/index',$data);
                        $this->load->view('produit/ajout_produit');
                   }
        }
        
        public function supprimer_produit($id){
            $this->load->model('produit');
            $this->load->helper('form','url');
            $this->load->library('form_validation');
            $this->load->view('administrateur/index');
            $this->produit->delete($id);
            echo "produit Supprimé";
            $this->liste_produit();
        }
        
        public function detail_produit($id){
            $this->load->model('produit');
            $this->load->helper('form', 'url');
            $this->load->helper('cookie');
            $this->load->library('form_validation');
            if(isset($_COOKIE['commercantCookie'])){
                $varmail= $this->input->cookie('commercantCookie');
                if($this->produit->selectById($id) != Null){
                    $data['produit'] = $this->produit->selectById($id);
                    $this->load->view('commercant/index');
                    $this->load->view('produit/detail',$data);
                    
                }
                else{
                    //ereur le produit n'existe pas
                   $this->liste_produit(); 
                }
            }
            else{
                // deconnecter le commercant
            }
        }
        
        public function modifier(){
            $this->load->helper('form', 'url');
            $this->load->library('form_validation');
            $this->load->model('client');
            $this->form_validation->set_rules('prenomClient', 'Prénom', 'alpha_dash');
            $this->form_validation->set_rules('nomClient', 'Nom', 'alpha_numeric_spaces');
            $this->form_validation->set_rules('mailClient', 'Email', 'valid_email');
            $this->form_validation->set_rules('codePClient', 'Code postale', 'integer');
            $this->form_validation->set_rules('villeClient', 'Ville', 'alpha_dash');
            $this->form_validation->set_rules('telClient', 'Numéro de téléphone', 'integer');
            if(isset($_COOKIE['clientCookie'])){
                $varmail= $this->input->cookie('clientCookie');
                $data['client'] = $this->client->selectByMail($varmail);
                $mdp = $data['client'][0]->mdpClient;
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('client/profil');
                } else {
                    if ($varmail != $_POST['mailClient']) {
                            $data['message']="erreur : Vous ne pouvez pas changer votre adresse mail";
                            $this->load->view('errors/erreur_formulaire', $data);
                            $this->load->view('client/inscription');
                    } else if ($_POST['mdpClient'] == $_POST['mdpClient2'] && $mdp == $_POST['mdpClient']) {
                            $this->client->deleteByMail($varmail);
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
                            $data['client']= $this->client->selectByMail($varmail);
                            $this->load->view('client/header');
                            $this->load->view('client/profil',$data);
                            $this->load->view('client/footer');
                    } else {
                            $data['message']="erreur : la confirmation de Mot de passe ne correspond pas au premier";
                            $this->load->view('errors/erreur_formulaire', $data);
                            $this->load->view('client/header');
                            $this->load->view('client/profil',$data);
                            $this->load->view('client/footer');
                    }
                }
            }
            else{
                $this->load->view('pages/deconnexion');
            }
        }



}
