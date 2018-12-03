<?php
	class produit extends CI_Model{
        protected $table ='produit';
     	public function __construct() {
        	parent::__construct();
    	} 
	public function selectAll(){
		$this->load->database();
    	return $this->db->select('*')
               ->from('produit')
               ->get()
               ->result();
        }
        public function selectById($id) {
    		$this->load->database();
    		return $this->db->select('*')
                    ->from('produit')
                    ->where('idProduit', $id)
                    ->get()
                    ->result();
            
  		}
            
  		
  		
    	public function insert($data) {
            $this->load->database();
            $this->db->set('nomProduit', $data['nomProduit'])
				->set('descriptionProduit', $data['descriptionProduit'])
                ->set('prixUnitaireProduit', $data['prixUnitaireProduit'])
				->set('reducProduit', $data['reducProduit'])
		->insert($this->table);
        }   
			
		public function delete($id){
      		$this->load->database();
      		return $this->db->where('idProduit',$id)
                    	->delete($this->table);
    	}
        
        public function update($id, $data) {
        $this->load->database();
        $this->db->set('nomProduit', $data['nomProduit'])
				->set('descriptionProduit', $data['descriptionProduit'])
                ->set('prixUnitaireProduit', $data['prixUnitaireProduit'])
				->set('reducProduit', $data['reducProduit'])
                ->update($this->table);
        }
	
    }
?>