<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageCtrl extends CI_Controller {

	
	    public function index()
        {
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('client/connexion');
        }

        public function Accueil()
        {
            $this->load->helper('url');
            $this->load->view('pages/pageaccueil');
        }

        public function ConnexionCommercant(){
            $this->load->helper('form','url');
            $this->load->helper('cookie');
            $this->load->library('form_validation');
            $this->load->model('commercant');

            $this->form_validation->set_rules('mailCommercant', 'Email', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('commercant/connexion');
            }
            else
            {

                $com=$this->commercant->selectByMail($_POST['mailCommercant']);
                //le commercant qui essaye de se connecter

                if ($this->commercant->selectByMail($_POST['mailCommercant']) == null){
                    $this->load->view('commercant/lie_commercant');
                    echo "<div class='alert alert-danger text-center'>Cet email n'existe pas</div>";
                }
                else{
                    $com = $this->commercant->selectByMail($_POST['mailCommercant']);
                    if( $com[0]->mdpCommercant != $_POST['mdp']){
                        $this->load->view('commercant/connexion');
                        echo "<div class='alert alert-danger text-center'>Mauvais mot de passe</div>";
                    }
                    else{
                        echo "formumaire bien remplie";
                        //mettre la connexion dans les cookies
                        //setcookie('commercantCookie',$com[0]->idCommercant,time()+3600,'/','');
                        //	$this->load->view('commercant/index',$data);

                        $data['commercant'] = $this->commercant->selectByMail($_POST['mailCommercant']);
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
                    }
                }

            }
        }

        public function ConnexionAdmin()
        {
		$this->load->helper('url');
		$this->load->view('pages/pageconnexionadmin');
	    }

	    public function choix_inscription()
        {
            $this->load->helper('url');
            $this->load->view('pages/choix_inscription');
        }

        public function ConnexionSellers()
        {
		$this->load->helper('url');
		$this->load->view('pages/pageconnexionsellers');
	    }

}
