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


        public function form_ajout_produit(){
            // faire envoi de mail
            // envoi de mail lors de l'inscription d'un produit ?
            $this->load->model('produit');
            $this->load->helper('form');
            $this->load->view('produit/ajout_produit');

        }

        
        public function ajout_produit(){
                // faire envoi de mail
                // envoi de mail lors de l'inscription d'un produit ?
                $this->load->model('produit');
				$this->load->helper('form');

				$data=array(
                            "nomProduit"=> htmlspecialchars($_POST['nomProduit']),
                            "descriptionProduit"=> htmlspecialchars($_POST['descriptionProduit']),
                            "prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
                            "reducProduit" => htmlspecialchars($_POST['reducProduit']),
			    );
                $this->produit->insert($data);
                $this->load->view('produit/ajout_produit');

        }
   



}
