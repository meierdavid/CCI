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
   



}
