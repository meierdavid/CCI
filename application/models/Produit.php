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

        public function selectByEntreprise($numSiret){
            $this->load->database();
            return $this->db->select('*')
               ->from('produit')
               ->where('numSiret', $numSiret)
               ->get()
               ->result();
        }
        public function selectByCategorie($categorie){
           $this->load->database();
            return $this->db->select('*')
               ->from('produit')
               ->where('categorieProduit', $categorie)
               ->get()
               ->result();
        }


        public function selectBySoldes(){
            $this->load->database();
            return $this->db->select('*')
                ->from('produit')
                ->where('reducProduit >',0)
                ->get()
                ->result();
        }
        public function search($str){
            $this->load->database();
            return $this->db->select('*')
                ->from('produit')
                ->like('nomProduit',$str)
                ->get()
                ->result();
        }
         public function selectProduit($mail){
            $this->load->database();
            return $this->db->select('*')
                ->from('Produit')
                ->join('entreprise','entreprise.numSiret = produit.numSiret')
                ->join('faire_partie','faire_partie.numSiret = entreprise.numSiret')
                ->join('commercant', 'commercant.idCommercant = faire_partie.idCommercant')
                ->where('commercant.mailCommercant',$mail)
                ->get()
                ->result();
        }

        public function selectPropose($categorie,$id){
            return $this->db->limit(3)
                    ->select('*')
                    ->from('produit')
                    ->where('idProduit !=', $id)
                    ->where('categorieProduit', $categorie)
                    ->get()
                    ->result();

  		}

    	public function insert_with_picture($data) {
            $this->load->database();
            $this->db->set('nomProduit', $data['nomProduit'])
				->set('descriptionProduit', $data['descriptionProduit'])
				->set('numSiret', $data['numSiret'])
                ->set('categorieProduit', $data['categorieProduit'])
                ->set('prixUnitaireProduit', $data['prixUnitaireProduit'])
				->set('reducProduit', $data['reducProduit'])
				->set('couleurProduit', $data['couleurProduit'])
		        ->set('nbDispoProduit', $data['nbDispoProduit'])
				->set('imageProduit', $data['imageProduit'])
		        ->insert($this->table);
        }

		public function insert_without_picture($data) {
            $this->load->database();
            $this->db->set('nomProduit', $data['nomProduit'])
				->set('descriptionProduit', $data['descriptionProduit'])
				->set('numSiret', $data['numSiret'])
                ->set('categorieProduit', $data['categorieProduit'])
                ->set('prixUnitaireProduit', $data['prixUnitaireProduit'])
				->set('reducProduit', $data['reducProduit'])
				->set('couleurProduit', $data['couleurProduit'])
		        ->set('nbDispoProduit', $data['nbDispoProduit'])
		        ->insert($this->table);
        }

		public function delete($id){
      		$this->load->database();
      		return $this->db->where('idProduit',$id)
                    	->delete($this->table);
    	}

        public function update($id, $data) {
        $this->load->database();
		var_dump($data);
        $this->db->set('nomProduit', $data['nomProduit'])
                ->set('categorieProduit', $data['categorieProduit'])
		        ->set('descriptionProduit', $data['descriptionProduit'])
                ->set('prixUnitaireProduit', $data['prixUnitaireProduit'])
		        ->set('reducProduit', $data['reducProduit'])
		        ->set('couleurProduit', $data['couleurProduit'])
		        ->set('nbDispoProduit', $data['nbDispoProduit'])
				->set('imageProduit', $data['imageProduit'])
                ->where('idProduit', $id)
                ->update($this->table);
        }

		public function prix_a_afficher($id){
			$produit = $this->selectById($id);
			return intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100);
		}



    }
?>
