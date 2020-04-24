<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->logged!==true){
	      redirect('auth');
	    }
	    $this->load->model('KecamatanModel');
	}

	public function data($jenis='kecamatan')
	{
		header('Content-Type: application/json');
		$response=[];
		if($jenis=='kecamatan'){
			$getKecamatan=$this->KecamatanModel->get();
			foreach ($getKecamatan->result() as $row) {
				$data=null;
				$data['id_kecamatan']=$row->id_kecamatan;
				$data['kd_kecamatan']=$row->kd_kecamatan;
				$data['geojson_kecamatan']=$row->geojson_kecamatan;
				$data['warna_kecamatan']=$row->warna_kecamatan;
				$data['nm_kecamatan']=$row->nm_kecamatan;
				$response[]=$data;
			}
			echo "var dataKecamatan=".json_encode($response,JSON_PRETTY_PRINT);
		}
		
	}
}
