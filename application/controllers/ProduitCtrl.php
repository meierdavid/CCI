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
            //mettre mail pour la sélection
            $this->load->helper('url');
            $this->load->view('produit/profil',$data);
            
            // modifie le profil à l'envoi du formulaire
        }
                
        
        public function inscription(){
                // faire envoi de mail
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
