<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommercantCtrl extends CI_Controller {

	
	public function index()
	{       
        if($this->input->cookie('commercantCookie')!= FALSE){
        $this->load->helper('url');
        $this->load->view('commercant/profil');     
        }
	}

    public function profil()
    {
        $this->load->helper('cookie');
        $this->load->helper('url');
        if($this->input->cookie('commercantCookie')!= FALSE){
            $varMail= $this->input->cookie('commercantCookie'); // rentrer un mail dans votre base de données en attendant qu'on fasse les cookies
            $this->load->model('commercant');
           
            $data['commercant'] = $this->commercant->selectByMail($varMail);
            $this->load->view('commercant/index',$data);
            $this->load->view('commercant/profil',$data);
        }
        else{
            $this->load->view('pages/pageconnexion');
        }
    }
    public function changer_mdp(){ // info commercant avec cookie
        $this->load->helper('cookie');
        $this->load->model('commercant');
        $this->load->helper('url');
        $varMail= $this->input->cookie('commercantCookie');
        $data['commercant'] = $this->commercant->selectByMail($varMail); 
        
        if(isset($_POST['mdpCommercantAncien']) && ($_POST['mdpCommercantAncien'] == $data['commercant'][0]->mdpCommercant) ){ // + tester Bon Ancien mot de passe
            if($_POST['mdpCommercantNouveau'] == $_POST['mdpCommercantConf']){
                $newMdp = $_POST['mdpCommercantNouveau'];
                $this->commercant->updateMdp($varMail,$newMdp);
                delete_cookie("commercantCookie");
                $this->load->view('pages/pageconnexion');
            }
        }
        else{
            $this->load->view('commercant/index',$data);
            $this->load->view('commercant/changer_mdp',$data);
        }
        
        
    }
    public function check_connexion(){
       $this->load->helper('cookie');
        if(isset($_POST['mail']) && isset($_POST['mdp']) ){
            $this->load->model('commercant');
            $data['commercant'] = $this->commercant->selectByMail($_POST['mail']);
            
            if( $data['commercant'] != NULL && $_POST['mdp'] == $data['commercant'][0]->mdpCommercant ){
                $cookie = array(

                                'name'   => 'commercantCookie',

                                'value'  => $data['commercant'][0]->mailCommercant,

                                'expire' => '3600'

                                

                             );	
                $this->input->set_cookie($cookie);
                	
                echo $this->input->cookie('commercantCookie');
                
                $this->load->view('commercant/index',$data);
            }
            else{
                //$erreur="erreur mauvais mot de passe ou mauvaise adresse mail";
                //$data['error']=$erreur;
                $this->load->view('commercant/connexion');
                // erreur mauvais mdp ou mauvaise adresse mail
            }
        }
        else{
            // erreur 
        }
    }
    public function liste_entreprise(){
        $this->load->helper('cookie');
        $this->load->model('commercant');
        $this->load->model('entreprise');
        $varMail= $this->input->cookie('commercantCookie');
        $data['entreprises']=$this->commercant->selectEntreprise($varMail);
        
        if( $data['entreprises'] != NULL){
            $this->load->view('commercant/index',$data);
           $this->load->view('commercant/liste_entreprise',$data);
           
        }
        else{
            $this->add_entreprise();
        }
    }
    public function add_entreprise() { //mettre parametre mail ou utiliser cookie
        // use insert for model entreprise paramètre $data , $idCommercant
        $this->load->helper('form');
        $this->load->helper('cookie');
        $this->load->model('entreprise');
        $this->load->model('commercant');
        if($this->input->cookie('commercantCookie') != False){
        $varMail= $this->input->cookie('commercantCookie');
        $data['commercant']=$this->commercant->selectByMail($varMail);
        $id= $data['commercant'][0]->idCommercant;
        if(isset($_POST['nomEntreprise'])){
            $data=array(
                            "numSiret"=> htmlspecialchars($_POST['numSiret']),
                            "nomEntreprise"=> htmlspecialchars($_POST['nomEntreprise']),
                            "adresseEntreprise"=> htmlspecialchars($_POST['adresseEntreprise']),
                            "codePEntreprise"=> htmlspecialchars($_POST['codePEntreprise']),
                            "villeEntreprise" => htmlspecialchars($_POST['villeEntreprise']),
                            "horairesEntreprise" => htmlspecialchars($_POST['horairesEntreprise']),
                            "livraisonEntreprise" => htmlspecialchars($_POST['livraisonEntreprise']),
                            "tempsReservMax" => htmlspecialchars($_POST['tempsReservMax']),
                        ); 
            
         
                $this->entreprise->insert($data,$id); 
                $this->load->view('commercant/validation_ajout_entreprise');
                
        }
        else{
            $this->load->view('commercant/index',$data);
            $this->load->model('entreprise');		
            $this->load->helper('form');
            $this->load->view('commercant/ajout_entreprise');
        }
        }
        else{
            //pas de cookie
        }
        
    }
    public function connexion(){
        $this->load->helper('url');
        $this->load->view('commercant/connexion');
        
    }
        
    public function validation_inscription(){
        $this->load->model('commercant');		
        $this->load->helper('form');
        if(isset($_POST['mdpCommercant']) && $_POST['mdpCommercant']==$_POST['mdpCommercant2']){
                $data=array(
                            "prenomCommercant"=> htmlspecialchars($_POST['prenomCommercant']),
                            "nomCommercant"=> htmlspecialchars($_POST['nomCommercant']),
                            "mailCommercant" => htmlspecialchars($_POST['mailCommercant']),
                            "mdpCommercant" => htmlspecialchars($_POST['mdpCommercant']),
                            "adresseCommercant"=> htmlspecialchars($_POST['adresseCommercant']),
                            "codePCommercant"=> htmlspecialchars($_POST['codePCommercant']),
                            "villeCommercant" => htmlspecialchars($_POST['villeCommercant']),
                            "telCommercant" => htmlspecialchars($_POST['telCommercant']),);  
                $this->commercant->insert($data); 
                $this->load->view('commercant/validation_inscription');
        }
        else{
             $this->load->view('commercant/inscription');
        }
        
    }
    public function lie_commercant(){
        //vérifier le num de siret du commercant
        // ajouter à la table faire_partie
        $this->load->model('commercant');		
        $this->load->helper('form');
        $this->load->view('commercant/lie_commercant');
        
    }
    public function inscription(){
        $this->load->model('commercant');		
        $this->load->helper('form');
        $this->load->view('commercant/inscription');
      
	}

}
