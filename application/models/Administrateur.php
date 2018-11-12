<?php
	class administrateur extends CI_Model{
        
        protected $table ='administrateur';
     	
        public function __construct() {
        	parent::__construct();
    	} 

        public function selectAll(){
		
        $this->load->database();
    	
            return $this->db->select('*')
               ->from('administrateur')
               ->get()
               ->result();
        }
        

        public function selectById($id) {
    		
            $this->load->database();
    		
            return $this->db->select('*')
                ->from('administrateur')
                ->where('idAdministrateur', $id)
                ->get()
                ->result();
            
  		}
        
        public function selectByMail($mail) {
    		
            $this->load->database();
    		
            return $this->db->select('*')
                    ->from('administrateur')
                    ->where('mailAdministrateur', $mail)
                    ->get()
                    ->result();
        }
  		
        public function getLastUserId() {
    	
        	$this->load->database();
    	
        	return $this->db->select('idAdministrateur')
        	        ->from('administrateur')
                    ->order_by('idAdministrateur', 'desc')
                    ->limit(1)
                    ->get()
                    ->result();
  		}
    	
        public function insert($data) {
        
            $this->load->database();
            $this->db->set('prenomAdministrateur', $data['prenomAdministrateur'])
                ->set('nomAdministrateur', $data['nomAdministrateur'])
 		        ->set('mailAdministrateur', $data['mailAdministrateur'])
                ->set('adresseAdministrateur', $data['adresseAdministrateur'])
                ->set('codePAdministrateur', $data['codePAdministrateur'])
                ->set('villeAdministrateur', $data['villeAdministrateur'])
                ->set('telAdministrateur', $data['telAdministrateur'])
                ->set('mdpAdministrateur', $data['mdpAdministrateur'])
		      ->insert($this->table);
        }   
			
		public function delete($id){
      		$this->load->database();
      		return $this->db->where('idAdministrateur',$id)
                    	->delete($this->table);
    	}
        
        public function update($id, $data) {
        
        $this->load->database();
        
        $this->db->set('prenomAdministrateur', $data['prenomAdministrateur'])
        	    ->set('nomAdministrateur', $data['nomAdministrateur'])
 		        ->set('mailAdministrateur', $data['mailAdministrateur'])
                ->set('adresseAdministrateur', $data['adresseAdministrateur'])
                ->set('codePAdministrateur', $data['codePAdministrateur'])
                ->set('villeAdministrateur', $data['villeAdministrateur'])
                ->set('telAdministrateur', $data['telAdministrateur'])
                ->set('mdpAdministrateur', $data['mdpAdministrateur'])
                ->update($this->table);
        }
	
    }
?>