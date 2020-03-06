<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('KecamatanModel','Model');
	}

	public function index()
	{
		$datacontent['url']='kecamatan';
		$datacontent['title']='Halaman Kecamatan';
		$datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('kecamatan/tabelView',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('layouts/html',$data);
	}
	public function form($parameter='',$id='')
	{
		$datacontent['url']='kecamatan';
		$datacontent['parameter']=$parameter;
		$datacontent['id']=$id;
		$datacontent['title']='Form Kecamatan';
		$data['content']=$this->load->view('kecamatan/formView',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('layouts/html',$data);
	}
	public function simpan()
	{
		if($this->input->post('simpan')){
			$data=[
				'kd_kecamatan'=>$this->input->post('kd_kecamatan'),
				'nm_kecamatan'=>$this->input->post('nm_kecamatan'),
				'warna_kecamatan'=>$this->input->post('warna_kecamatan'),
			];
			if($_POST['parameter']=="tambah"){
				$this->Model->insert($data);
			}
			else{
				$this->Model->update($data,['id_kecamatan'=>$this->input->post('id_kecamatan')]);
			}

		}

		redirect('kecamatan');
	}
}
