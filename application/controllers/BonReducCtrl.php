<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BonReducCtrl extends CI_Controller {

    public function liste_bon() {
        $this->load->model('BonReduc');
        if ($this->input->cookie('commercantCookie') != null) {
            $varid = $this->input->cookie('commercantCookie');
            $data['commercant'] = $this->commercant->selectByMail($varid);
            $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);
            if ($data['entreprises'] != NULL) {
                $data['bonreduc'] = $this->BonReduc->selectBonReduc($varid);
                $this->load->view('commercant/index', $data);
                $this->load->view('bonreduc/liste_bon', $data);
            } else {
                $this->ajout_bon();
            }
        } else {
            $this->load->view('commercant/connexion');
        }
    }
}
