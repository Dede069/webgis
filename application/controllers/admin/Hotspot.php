<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotspot extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('HotspotModel','Model');
		$this->load->model('KecamatanModel');
		$this->load->model('KategorihotspotModel');
	}

	public function index()
	{
		$datacontent['url']='admin/hotspot';
		$datacontent['title']='Halaman Hotpost';
		$datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('admin/hotspot/tableView',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('admin/layouts/html',$data);
	}
	public function form($parameter='',$id='')
	{
		$datacontent['url']='admin/hotspot';
		$datacontent['parameter']=$parameter;
		$datacontent['id']=$id;
		$datacontent['title']='Form Hotpost';
		$data['content']=$this->load->view('admin/hotspot/formView',$datacontent,TRUE);
		$data['js']=$this->load->view('admin/hotspot/js/formJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('admin/layouts/html',$data);
	}
	public function simpan()
	{
		if($this->input->post()){
			$data=[
				'id_kecamatan'=>$this->input->post('id_kecamatan'),
				'id_kategori_hotspot'=>$this->input->post('id_kategori_hotspot'),
				'keterangan'=>$this->input->post('keterangan'),
				'lokasi'=>$this->input->post('lokasi'),
				'lat'=>$this->input->post('lat'),
				'lng'=>$this->input->post('lng'),
				'tanggal'=>$this->input->post('tanggal'),
				'polygon'=>$this->input->post('polygon'),
			];
			// upload
			if($_FILES['marker']['name']!=''){
				$upload=upload('marker','marker','image');
				if($upload['info']==true){
					$data['marker']=$upload['upload_data']['file_name'];
				}
				elseif($upload['info']==false){
					$info='<div class="alert alert-danger alert-dismissible">
	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            		<h4><i class="icon fa fa-ban"></i> Error!</h4> '.$upload['message'].' </div>';
					$this->session->set_flashdata('info',$info);
					redirect('admin/hotspot');
					exit();
				}
			}
			// upload
			
			if($_POST['parameter']=="tambah"){
				$this->Model->insert($data);
			}
			else{
				$this->Model->update($data,['id_hotspot'=>$this->input->post('id_hotspot')]);
			}

		}
		redirect('admin/hotspot');
	}

	public function export($jenis='pdf'){
		if($jenis=='pdf'){
			$datacontent['title']='Hotspot Report';
			$datacontent['datatable']=$this->Model->get();
			$html=$this->load->view('admin/hotspot/pdfView',$datacontent,TRUE);
			generatePdf($html,'Data Hotspot','A4','landscape');
		}
	}
	
	public function importcsv(){
		if($this->input->post()){
			if($_FILES['csv']['name']!=''){
				$getKecamatan=$this->KecamatanModel->get();
				$id_kecamatan=[];
				foreach ($getKecamatan->result() as $row) {
					$id_kecamatan[strtolower(trim($row->kd_kecamatan))]=$row->id_kecamatan;
				}
				// print_r($id_kecamatan);
				$getKategoriHotspot=$this->KategorihotspotModel->get();
				$id_kategori_hotspot=[];
				foreach ($getKategoriHotspot->result() as $row) {
					$id_kategori_hotspot[strtolower($row->kd_kategori_hotspot)]=$row->id_kategori_hotspot;
				}

				$upload=upload('csv','csv','csv');
				if($upload['info']==true){
					$filename=$upload['upload_data']['file_name'];
					$file=FCPATH.'assets/unggah/csv/'.$filename;
					$csv = array_map(function($v){return str_getcsv($v, ";");}, file($file));
					foreach ($csv as $row) {
						$data[]=[
							'id_kecamatan'=>$id_kecamatan[strtolower($row[3])],
							'id_kategori_hotspot'=>$id_kategori_hotspot[strtolower($row[7])],
							'keterangan'=>$row[4],
							'lokasi'=>$row[2],
							'lat'=>$row[5],
							'lng'=>$row[6],
							'tanggal'=>$row[1],
						];
					}
					$this->Model->insert_batch($data);
					unlink($file);
					$info='<div class="alert alert-success alert-dismissible">
				            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				            <h4><i class="icon fa fa-check"></i> Sukses!</h4> Import data dari CSV sukses </div>';
				}
				elseif($upload['info']==false){
					$info='<div class="alert alert-danger alert-dismissible">
	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            		<h4><i class="icon fa fa-ban"></i> Error!</h4> '.$upload['message'].' </div>';
				}
			}
			else{
				$info='<div class="alert alert-danger alert-dismissible">
	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            		<h4><i class="icon fa fa-ban"></i> Error!</h4> Tidak ada file CSV yang diunggah</div>';
			}
		}
		$this->session->set_flashdata('info',$info);
		redirect('admin/hotspot');
	}

	public function importzip(){
		if($this->input->post()){
			if($_FILES['zip']['name']!=''){
				$getKecamatan=$this->KecamatanModel->get();
				$id_kecamatan=[];
				foreach ($getKecamatan->result() as $row) {
					$id_kecamatan[strtolower(str_replace('.','',trim($row->kd_kecamatan)))]=$row->id_kecamatan;
				}
				$getKategoriHotspot=$this->KategorihotspotModel->get();
				$id_kategori_hotspot=[];
				foreach ($getKategoriHotspot->result() as $row) {
					$id_kategori_hotspot[strtolower($row->kd_kategori_hotspot)]=$row->id_kategori_hotspot;
				}
				$upload=upload('zip','zip','zip');
				if($upload['info']==true){
					// extract zip
					$filename=$upload['upload_data']['file_name'];
					$zipFile = FCPATH.'assets/unggah/zip/'.$filename;
					$newFolder = FCPATH.'assets/unggah/zip/'.(str_replace('.zip','',$filename));
					$zip = new ZipArchive;
					//proses extract file zip
					if ($zip->open($zipFile) === TRUE) {
					    $zip->extractTo($newFolder);
					    $zip->close();
					    //lakukan pembacaan folder hasil ekstrak zip
					    foreach (glob($newFolder.'/*.txt') as $file) {
					    	$basename = basename($file);
					    	$kd_kecamatan = substr($basename, 0, 6);
					    	$tanggal = substr($basename, 6, 4).'-'.substr($basename, 10, 2).'-'.substr($basename, 12, 2);
					    	$txt = array_map(function($v){return str_getcsv($v, ";");}, file($file));
							foreach ($txt as $row) {
								$data[]=[
									'id_kecamatan'=>$id_kecamatan[$kd_kecamatan],
									'id_kategori_hotspot'=>$id_kategori_hotspot[strtolower($row[5])],
									'keterangan'=>$row[2],
									'lokasi'=>$row[1],
									'lat'=>$row[3],
									'lng'=>$row[4],
									'tanggal'=>$tanggal,
								];
							}
							//hapus file
							unlink($file);
					    }
						$this->Model->insert_batch($data);
						//hapus file zip
						unlink($zipFile);
						//remove folder extract zip
						rmdir($newFolder);

						$info='<div class="alert alert-success alert-dismissible">
					            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					            <h4><i class="icon fa fa-check"></i> Sukses!</h4> Import data dari ZIP sukses </div>';
					} else {
						$info='<div class="alert alert-danger alert-dismissible">
					            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					            <h4><i class="icon fa fa-check"></i> Sukses!</h4> Import data dari ZIP gagal </div>';
					}
				
				}
				elseif($upload['info']==false){
					$info='<div class="alert alert-danger alert-dismissible">
	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            		<h4><i class="icon fa fa-ban"></i> Error!</h4> '.$upload['message'].' </div>';
				}
			}
			else{
				$info='<div class="alert alert-danger alert-dismissible">
	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            		<h4><i class="icon fa fa-ban"></i> Error!</h4> Tidak ada file ZIP yang diunggah</div>';
			}
		}
		$this->session->set_flashdata('info',$info);
		redirect('admin/hotspot');
	}

	public function hapus($id=''){
		// hapus file di dalam folder
		$this->db->where('id_hotspot',$id);
		$get=$this->Model->get()->row();
		$geojson_hotspot=$get->geojson_hotspot;
		unlink('assets/unggah/geojson/'.$geojson_hotspot);
		// end hapus file di dalam folder
		$this->Model->delete(["id_hotspot"=>$id]);
		redirect('admin/hotspot');
	}
}
