<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->logged!==true){
	      redirect('auth');
	    }
	}

	public function index()
	{
		$datacontent['title']='Halaman Beranda';
		$data['content']=$this->load->view('berandaView',$datacontent,TRUE);
		$data['title']='Selamat Datang di Beranda';
		$this->load->view('layouts/html',$data);
	}
}
