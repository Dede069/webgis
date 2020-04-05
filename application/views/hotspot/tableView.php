<?=content_open($title)?>
<a href="<?=site_url($url.'/form/tambah')?>" class="btn btn-success" ><i class="fa fa-plus"></i> Tambah</a>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
	<i class="fa fa-upload"></i> Import CSV
</button>
<hr>
<?=$this->session->flashdata('info')?>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Lokasi</th>
			<th>Nama Kecamatan</th>
			<th>Keterangan</th>
			<th>Lat</th>
			<th>Lng</th>
			<th>Tanggal</th>
			<th>Marker</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			foreach ($datatable->result() as $row) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->lokasi?></td>
						<td><?=$row->nm_kecamatan?></td>
						<td><?=$row->keterangan?></td>
						<td><?=$row->lat?></td>
						<td><?=$row->lng?></td>
						<td><?=$row->tanggal?></td>
						<td class="text-center"><?=($row->marker==''?'-':'<img src="'.assets('unggah/marker/'.$row->marker).'" width="40px">')?></td>
						<td>
							<a href="<?=site_url($url.'/form/ubah/'.$row->id_hotspot)?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
							<a href="<?=site_url($url.'/hapus/'.$row->id_hotspot)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
						</td>
					</tr>
				<?php
				$no++;
			}

		?>
	</tbody>
</table>
<?=content_close()?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Upload CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="post" action="<?=site_url($url.'/importcsv')?>" enctype="multipart/form-data">
      <div class="modal-body">
	    	<div class="form-group">
	    		<label>File CSV</label>
	    		<div class="row">
		    		<div class="col-md-12">
	    				<?=input_file('csv','')?>
	    			</div>
	    		</div>
	    	</div>
      </div>
      <div class="modal-footer">
		<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
  </div>
</div>