<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanierCtrl extends CI_Controller {


    public function index()
    {
        $this->load->helper('url');
        $this->load->view('client/accueil');
    }


    public function liste_panier(){
        $this->load->model('Panier');
        if($this->input->cookie('clientCookie') != null){
            $varid = $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varid);
            $data['paniers'] = $this->commercant->selectPanier($data['client'][0]->idClient);
            if( $data['paniers'] != NULL){
                $data['produit'] = $this->Produit->selectProduit($varid);
                $this->load->view('client/accueil',$data);
                $this->load->view('client/liste_panier',$data);
            }
            else{
                $this->ajout_panier();
            }
        }
        else{
            $this->load->view('client/connexion');
        }
    }

    public function ajout_panier(){
        // faire envoi de mail
        // envoi de mail lors de l'inscription d'un produit ?
        $this->load->model('panier');
        $this->load->model('produit');
        $this->load->helper('form');
        if($this->entreprise->selectById($_POST['numSiret']) != null){

            var_dump($_POST);
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
            var_dump("mauvais");
            $data['message']="erreur : mauvais numéro de Siret";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('commercant/index',$data);
            $this->load->view('produit/ajout_produit');
        }
    }

    public function supprimer_panier($id){
        $this->load->model('panier');
        $this->load->helper('form','url');
        $this->load->library('form_validation');
        $this->load->view('client/accueil');
        $this->produit->delete($id);
        echo "panier Supprimé";
        $this->liste_panier();
    }

    public function modifier(){
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->load->model('panier');
        if(isset($_COOKIE['clientCookie'])){
            $id = $_POST['idPanier'];
            var_dump($id);
            var_dump($_POST);
            $data=array(
                "datePanier"=> htmlspecialchars($_POST['datePanier']),
                "codePromo"=> htmlspecialchars($_POST['codePromo']),
                "annulationPanier"=> htmlspecialchars($_POST['annulationPanier']),
                "finaliserPanier"=> htmlspecialchars($_POST['finaliserPanier']),
                "paiementPanier" => htmlspecialchars($_POST['paiementPanier']),
                "prixTotPanier" => htmlspecialchars($_POST['prixTotPanier']),
            );
            $this->panier->update($id,$data);
            $data['panier']= $this->panier->selectById($id);

            $this->load->view('client/accueil');
            $this->load->view('panier/detail',$data);

        }
        else{
            $this->load->view('pages/deconnexion');
        }
    }



}
