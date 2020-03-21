<?=content_open($title)?>
<a href="<?=site_url($url.'/form/tambah')?>" class="btn btn-success" ><i class="fa fa-plus"></i> Tambah</a>
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
							<a href="<?=site_url($url.'&ubah&id='.$row->id_hotspot)?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
							<a href="<?=site_url($url.'&hapus&id='.$row->id_hotspot)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
						</td>
					</tr>
				<?php
				$no++;
			}

		?>
	</tbody>
</table>
<?=content_close()?>