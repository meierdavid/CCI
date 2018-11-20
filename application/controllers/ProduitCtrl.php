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

        
        public function ajout_produit(){
                // faire envoi de mail
				
			    $this->load->model('produit');
				$this->load->helper('form');
				$this->load->view('produit/ajout_produit');
				
				 $data=array(
                            "nomProduit"=> htmlspecialchars($_GET['nomProduit']),
                            "descriptionProduit"=> htmlspecialchars($_GET['descriptionProduit']),
                            "prixUnitaireProduit" => htmlspecialchars($_GET['prixUnitaireProduit']),
                            "reducProduit" => htmlspecialchars($_GET['reducProduit']),
			);	
				$this->produit->insert($data);
				/*
				$config['upload_path'] = './assets/image/Produits';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				
               

				if (!($this->upload->do_upload("imageProduit"))){
					
					//Vue mise pour tester 
					//$this->load->view('client/inscription');
				}
				else{
					$file_data = $this->upload->data();
					
					//Vue mise pour tester 
					$this->load->view('administrateur/inscription');
				}
              */
	  }
   
}
