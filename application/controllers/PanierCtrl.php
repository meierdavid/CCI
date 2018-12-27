<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanierCtrl extends CI_Controller {


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
        if($this->input->cookie('commercantCookie') != null){
            $varid = $this->input->cookie('commercantCookie');
            $data['commercant'] = $this->commercant->selectByMail($varid);
            $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);
            if( $data['entreprises'] != NULL){
                $data['produit'] = $this->Produit->selectProduit($varid);
                $this->load->view('commercant/index',$data);
                $this->load->view('produit/liste_produit',$data);
            }
            else{
                $this->ajout_entreprise();
            }
        }
        else{
            $this->load->view('commercant/connexion');
        }
    }

    public function ajout_produit(){
        // faire envoi de mail
        // envoi de mail lors de l'inscription d'un produit ?
        $this->load->model('produit');
        $this->load->model('entreprise');
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
        var_dump("detail");
        if(isset($_COOKIE['commercantCookie'])){
            if($this->produit->selectById($id) != Null){
                var_dump("produit");
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
        $this->load->model('produit');
        if(isset($_COOKIE['commercantCookie'])){
            $id = $_POST['idProduit'];
            var_dump($id);
            var_dump($_POST);
            $data=array(
                "nomProduit"=> htmlspecialchars($_POST['nomProduit']),
                "categorieProduit"=> htmlspecialchars($_POST['categorieProduit']),
                "numSiret"=> htmlspecialchars($_POST['numSiret']),
                "descriptionProduit"=> htmlspecialchars($_POST['descriptionProduit']),
                "prixUnitaireProduit" => htmlspecialchars($_POST['prixUnitaireProduit']),
                "reducProduit" => htmlspecialchars($_POST['reducProduit']),
            );
            $this->produit->update($id,$data);
            $data['produit']= $this->produit->selectById($id);
            $this->load->view('commercant/index');

            $this->load->view('produit/detail',$data);

        }
        else{
            $this->load->view('pages/deconnexion');
        }
    }



}
