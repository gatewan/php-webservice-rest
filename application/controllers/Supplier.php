<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	//require APPPATH . '/libraries/REST_Controller.php';
	require(APPPATH . 'libraries/REST_Controller.php');
	
//class Supplier extends REST_Controller {
class Supplier extends \Restserver\Libraries\REST_Controller {	
	function __construct($config = 'rest'){
		parent:: __construct($config);
		$this->load->database();
	}
	
	//Menampilkan data kontak
	function index_get(){
		$id =  $this->get('suppliers');
		if($id == ''){
			$kontak = $this->db->get('suppliers')->result();
		}else{
			$this->db->where('SupplierID', $id);
			$kontak = $this->db->get('suppliers')->result();
		}
		$this->response($kontak, 200);	
	}
	//Mengirim atau menambah data kontak baru
	function index_post(){
			$data = array(
//'SupplierID' 	=> $this->post('id'),
				'ContactName'	=> $this->post('contactname'),
				'Address'		=> $this->post('address')
			);
			if($insert){
				$this->response($data, 200);
			}else{
				$this->response(array('status' => 'fail', 502));
			}
			
		}
	//Memperbarui data kontak yang telah ada
	function index_put(){
		$id = $this->put('id');
		$data = array(
			'SupplierID'		=> $this->post('id'),
			'ContactName'		=> $this->post('contactname'),
			'Address'		=> $this->post('address')
		);
		$this->db->where('SupplierID', $id);
		$update = $this->db->update('supplier', $data);
		if($update){
			$this->response($data,200);
		}else{
			$this->response(array('status' => 'fail', 502));
		}
	}
	//Menghapus data
	function index_delete(){
		$id = $this->delete('id');
		$this->db->where('SupplierID', $id);
		$delete = $this->db->delete('supplier');
		if($delete){
			$this->response(array('status' => 'success'), 201);
		}else{
			$this->response(array('status' => 'fail', 502));
		}
	}
}