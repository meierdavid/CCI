<?php
class client extends CI_Model{

	protected $table ='client';

	public function __construct() {
		parent::__construct();
	}

	public function selectAll(){

		$this->load->database();

		return $this->db->select('*')
		->from('client')
		->get()
		->result();
	}
        public function deleteByMail($mail){
            $this->load->database();
            return $this->db->where('mailClient',$mail)
	    ->delete($this->table);
        }

	public function selectById($id) {

		$this->load->database();

		return $this->db->select('*')
		->from('client')
		->where('idClient', $id)
		->get()
		->result();

	}

	public function selectByMail($mail) {

		$this->load->database();

		return $this->db->select('*')
		->from('client')
		->where('mailClient', $mail)
		->get()
		->result();
	}

	public function getLastClientId() {

		$this->load->database();

		return $this->db->select('idClient')
		->from('client')
		->order_by('idClient', 'desc')
		->limit(1)
		->get()
		->result();
	}

	public function insert($data) {

		$this->load->database();
		$this->db->set('prenomClient', $data['prenomClient'])
		->set('nomClient', $data['nomClient'])
		->set('mailClient', $data['mailClient'])
		->set('adresseClient', $data['adresseClient'])
		->set('codePClient', $data['codePClient'])
		->set('villeClient', $data['villeClient'])
		->set('telClient', $data['telClient'])
		->set('mdpClient', $data['mdpClient'])
		->set('pointClient', $data['pointClient'])
		->insert($this->table);
	}

	public function delete($id){

		$this->load->database();

		return $this->db->where('idClient',$id)
		->delete($this->table);
	}

	public function update($id, $data) {

		$this->load->database();

		$this->db->set('prenomClient', $data['prenomClient'])
		->set('nomClient', $data['nomClient'])
		->set('mailClient', $data['mailClient'])
		->set('adresseClient', $data['adresseClient'])
		->set('codePClient', $data['codePClient'])
		->set('villeClient', $data['villeClient'])
		->set('telClient', $data['telClient'])
		->set('mdpClient', $data['mdpClient'])
		->set('pointClient', $data['pointClient'])
                ->where('idClient', $id)
		->update($this->table);
	}

	public function updateMdp($id,$mdp){

		$this->load->database();

		return $this->db->where('mailClient',$id)
			->set('mdpClient',$mdp)
			->update($this->table);
	}
        
        public function updateCredit($id,$credit){
            $this->load->database();
            
            return $this->db->where('idClient',$id)
			->set('creditClient',$credit)
			->update($this->table);
            
        }

}
?>
