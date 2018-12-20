<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SousproduitCtrl extends CI_Controller {

	
	    public function index()
        {
            $this->load->helper('url');
            $this->load->view('produit/profil');               
	    }

	    public function add_sousproduit(){ //permet l'ajout d'un sousproduit depuis un compte commercant
        $this->load->model('sousproduit');
        $this->load->helper('form');
        $this->load->view('sousproduit/ajout_sousproduit');
        $this->load->view('commercant/index');

        $data=array(
            "nomProduit"=> htmlspecialchars($_GET['nomProduit']),
            "descriptionProduit"=> htmlspecialchars($_GET['descriptionProduit']),
            "prixUnitaireProduit" => htmlspecialchars($_GET['prixUnitaireProduit']),
            "reducProduit" => htmlspecialchars($_GET['reducProduit']),
        );

        $this->produit->insert($data);
        }

        
        public function inscription(){
                // faire envoi de mail
                // envoi de mail lors de l'inscription d'un produit ?
                $this->load->model('produit');
				$this->load->helper('form');
				$this->load->view('produit/inscription');
                $data=array(
                            "nomProduit"=> htmlspecialchars($_GET['nomProduit']),
                            "descriptionProduit"=> htmlspecialchars($_GET['descriptionProduit']),
                            "prixUnitaireProduit" => htmlspecialchars($_GET['prixUnitaireProduit']),
                            "reducProduit" => htmlspecialchars($_GET['reducProduit']),
			    );
   		        $this->produit->insert($data);
	    }
   



}
