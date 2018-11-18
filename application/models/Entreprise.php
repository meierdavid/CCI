<?php
	class entreprise extends CI_Model{

        protected $table ='entreprise';
        
     	  public function __construct(){
        	parent::__construct();
    	  } 

    	public function selectAll(){
			
      $this->load->database();
    	
      	return $this->db->select('*')
               ->from('entreprise')
               ->get()
               ->result();
        }

      public function selectById($id){
    		
        $this->load->database();
    		
        return $this->db->select('*')
                    ->from('entreprise')
                    ->where('numSiret',$id)
                    ->get()
                    ->result();
        }
             public function selectByMail($mail) {
    	
        	$this->load->database();
    	
        	return $this->db->select('*')
                    ->from('entreprise')
                    ->where('mailEntreprise', $mail)
                    ->get()
                    ->result();
        }
  		
                
  		public function getLastEntrepriseId() {
    		
        $this->load->database();
    		
        return $this->db->select('numSiret')
        	        ->from('entreprise')
                    ->order_by('numSiret', 'desc')
                    ->limit(1)
                    ->get()
                    ->result();
  		}

        public function insert($data,$id) {
        
        $this->load->database();
        
        $this->db->set('numSiret', $data['numSiret'])
              ->set('nomEntreprise', $data['nomEntreprise'])
              ->set('adresseEntreprise', $data['adresseEntreprise'])
              ->set('codePEntreprise', $data['codePEntreprise'])
              ->set('villeEntreprise', $data['villeEntreprise'])
              ->set('horairesEntreprise', $data['horairesEntreprise'])
              ->set('livraisonEntreprise', $data['livraisonEntreprise'])
              ->set('tempsReservMax', $data['tempsReservMax'])
				->insert($this->table);
        $this->db->set('idCommercant',$id)
                ->set('numSiret',$data['numSiret'])
                ->insert('faire_partie');
        
        }   

        public function delete($id){
      		
          $this->load->database();
      		
          return $this->db->where('numSiret',$id)
                ->delete($this->table);
    	  }
        
        public function update($id,$data){
      		
          $this->load->database();
      		
          return $this->db->where('numSiret',$id)
            	->set('nomEntreprise', $data['nomEntreprise'])
              ->set('adresseEntreprise', $data['adresseEntreprise'])
              ->set('codePEntreprise', $data['codePEntreprise'])
              ->set('villeEntreprise', $data['villeEntreprise'])
              ->set('horairesEntreprise', $data['horairesEntreprise'])
              ->set('livraisonEntreprise', $data['livraisonEntreprise'])
              ->set('tempsReservMax', $data['tempsReservMax'])
				->update($this->table);
    	}
    }
?>