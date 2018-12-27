<?php
	class commercant extends CI_Model{

        protected $table ='commercant';

     	  public function __construct(){
        	parent::__construct();
    	  }

    	public function selectAll(){

      $this->load->database();

      	return $this->db->select('*')
               ->from('commercant')
               ->get()
               ->result();
        }

      public function selectById($id){

        $this->load->database();

        return $this->db->select('*')
                    ->from('commercant')
                    ->where('idCommercant', $id)
                    ->get()
                    ->result();
        }

				public function selectByMail($mail) {

        	$this->load->database();

        	return $this->db->select('*')
          ->from('commercant')
          ->where('mailCommercant',$mail)
          ->get()
          ->result();
        }


        public function selectEntreprise($id){
            $this->load->database();
            return $this->db->select('*')
                ->from('Entreprise')
                ->join('faire_partie','faire_partie.numSiret = entreprise.numSiret')
                ->where('idCommercant', $id)
                ->get()
                ->result();
        }


        public function getLastCommercantId() {

        $this->load->database();

        return $this->db->select('idCommercant')
        	        ->from('commercant')
                    ->order_by('idCommercant', 'desc')
                    ->limit(1)
                    ->get()
                    ->result();
  		}

        public function insert($data) {

        $this->load->database();

        $this->db->set('prenomCommercant', $data['prenomCommercant'])
        		  ->set('nomCommercant', $data['nomCommercant'])
 				      ->set('mailCommercant', $data['mailCommercant'])
              ->set('adresseCommercant', $data['adresseCommercant'])
              ->set('codePCommercant', $data['codePCommercant'])
              ->set('villeCommercant', $data['villeCommercant'])
              ->set('telCommercant', $data['telCommercant'])
              ->set('mdpCommercant', $data['mdpCommercant'])
				->insert($this->table);
        }


        public function delete($id){

          $this->load->database();

          return $this->db->where('idCommercant',$id)
                ->delete($this->table);
    	  }

        public function update($id,$data){

          $this->load->database();

          return $this->db->where('idCommercant',$id)
            	->set('nomCommercant', $data['nomCommercant'])
 				      ->set('mailCommercant', $data['mailCommercant'])
              ->set('adresseCommercant', $data['adresseCommercant'])
              ->set('codePCommercant', $data['codePCommercant'])
              ->set('villeCommercant', $data['villeCommercant'])
              ->set('telCommercant', $data['telCommercant'])
              ->set('mdpCommercant', $data['mdpCommercant'])
				->update($this->table);
    	}

    	public function updateMdp($id,$mdp){

          $this->load->database();

          return $this->db->where('mailCommercant',$id)
              ->set('mdpCommercant',$mdp)
	     ->update($this->table);
    	}
    }
?>
