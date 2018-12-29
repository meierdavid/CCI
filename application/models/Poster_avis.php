<?php

class poster_avis extends CI_Model{

  protected $table ='poster_avis';

  public function __construct(){
    parent::__construct();
  }

  public function selectAll(){
    $this->load->database();

    return $this->db->select('*')
    ->from('poster_avis')
    ->get()
    ->result();
  }

  public function selectByIdClient($id){
    $this->load->database();

    return $this->db->select('*')
    ->from('poster_avis')
    ->where('idClient', $id)
    ->get()
    ->result();
  }
  
  public function selectByNote($note){
    $this->load->database();

    return $this->db->select('*')
    ->from('poster_avis')
    ->where('noteClient', $note)
    ->get()
    ->result();
  }

  public function selectByIdProduit($id){

    $this->load->database();

    return $this->db->select('*')
    ->from('poster_avis')
    ->where('idProduit', $id)
    ->get()
    ->result();
  }

  public function insert($data) {

  $this->load->database();

  $this->db->set('idClient', $data['idClient'])
        ->set('idProduit', $data['idProduit'])
		->set('avisClient', $data['avisClient'])
		->set('noteClient', $data['noteClient'])
		->insert($this->table);
  }
  
  
	public function moyenne($id){
		$produit = $this->selectByIdProduit($id);
		$somme = 0 ;
		$nb = 0;
		foreach ($produit as $item) {
			$somme = $somme+$item->noteClient; 
			$nb=$nb+1;
		}
		if ($nb==0) {
			return 0;
		}
		else {
			return $somme/$nb;
		}
		
	}
  
  
   public function deleteByidClient($idClient) {
		$this->load->database();
		$this->db->delete('poster_avis', array('idClient' => $idClient));
   }
  
	public function deleteByidProduit($idProduit) {
		$this->load->database();
		$this->db->delete('poster_avis', array('idProduit' => $idProduit));
   }
  
  

    public function update($idProduit, $idClient, $avis) {
        $this->load->database();
        $this->db->set('avisClient', $avis)
                ->where('idProduit', $idProduit)
                ->where('idClient', $idClient)
                ->update($this->table);
    }


}

?>
