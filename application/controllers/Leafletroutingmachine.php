<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leafletroutingmachine extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('HotspotModel');
		$this->load->model('KecamatanModel');
	}

	public function index()
	{
		$datacontent['url']='leafletroutingmachine';
		$datacontent['title']='Halaman Leaflet Routing Machine';
		// $datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('leafletroutingmachine/mapView',$datacontent,TRUE);
		$data['js']=$this->load->view('leafletroutingmachine/js/mapJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('layouts/html',$data);
	}
}
