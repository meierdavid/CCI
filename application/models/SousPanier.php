<?php
	class souspanier extends CI_Model{
        
        protected $table ='souspanier';
     	
        public function __construct() {
        	parent::__construct();
    	} 
	   
        public function selectAll(){
		
        $this->load->database();
    	
        return $this->db->select('*')
               ->from('souspanier')
               ->get()
               ->result();
        }
        
        public function selectById($id) {
    	
        	$this->load->database();
    	
        	return $this->db->select('*')
                    ->from('souspanier')
                    ->where('idSousPanier', $id)
                    ->get()
                    ->result();
            
  		}
     
  		
        public function getLastsouspanierId() {
    	
        	$this->load->database();
    	
        	return $this->db->select('idSousPanier')
        	        ->from('souspanier')
                    ->order_by('idSousPanier', 'desc')
                    ->limit(1)
                    ->get()
                    ->result();
  		}
    	
        public function insert($data) {
        
            $this->load->database();
            $this->db->set('montantSousPanier', $data['montantSousPanier'])
        	->set('numSiret', $data['numSiret'])
 		->set('idPanier', $data['idPanier'])
		->insert($this->table);
        }   
			
		public function delete($id){
      		
            $this->load->database();
      		
            return $this->db->where('idSousPanier',$id)
                    	->delete($this->table);
    	}
        
        public function update($id, $data) {
            
            $this->load->database();
            
            $this->db->set('montantSousPanier', $data['montantSousPanier'])
        	->set('numSiret', $data['numSiret'])
 		->set('idPanier', $data['idPanier'])
                ->update($this->table);
        }
	
    }
?>