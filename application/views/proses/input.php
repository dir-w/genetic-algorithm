 <!-- Begin Page Content -->
 <div class="container-fluid">

 	<!-- Page Heading -->
 	<h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

 	<div class="card"> 
 		<div class="card-header">
 			<a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newInputModal">Add</a>


 		</div>
 		<div class="card-body">
 			<div class="table-responsive">
 				<table id="inputTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
 					<!-- <table id="empTable" class="display"> -->
 						<thead class="thead-light">
 							<tr> 
 								<th width="7px">No</th>
 								<th>Kode Matakuliah</th>
 								<th>Peminjam</th>
 								<th>Ruangan</th>
 								<th>Nama Matakuliah</th>
 								<th>Kapasitas</th>
 								<th>Hari</th>
 								<th>Start</th>
 								<th>End</th>
 								<th>Semester</th>
 								<th>Tgl Pemakaian</th>
 								<th width="45px">Aksi</th>
 							</tr>
 						</thead>

 						<!-- load barang -->


 					</table>
 				</div>


 			</div>
 		</div>



 	</div>
 	<!-- /.container-fluid -->

 </div>
 <!-- End of Main Content --> 


 <!-- Modal add -->
 <div class="modal fade" id="newInputModal" tabindex="-1" role="dialog" aria-labelledby="newFasilitasModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title text-danger" id="newInputModalLabel">INPUT DATA PEMAKAIAN RUANGAN</h5>

 			</div>
 			<form action="<?= base_url('proses/pemakaian'); ?>" method="post">
 				<div class="modal-body">
 					
 					<input type="hidden" class="form-control" name="namauser" id="namauser" required="required" readonly="" visible value="<?= $user['name']; ?>">

 					<div class="row">
 						<div class="col">
 							<div class="row mb-2">
 								<label class="col-sm-4 col-form-label">Kode Matakuliah</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="kodemk" id="kodemk" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($matakuliah as $mk):?>
 											<option value="<?= $mk['kode']; ?>"><?= $mk['nama_kode']; ?></option>
 										<?php endforeach;?>
 									</select>
 								</div>
 							</div>

 							<div class="row mb-2">
 								<label class="col-sm-4 col-form-label">Peminjam</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="pjawab" id="pjawab" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($pemin as $pm):?>
 											<option value="<?= $pm['kode_p']; ?>"><?= $pm['pj']; ?></option>
 										<?php endforeach;?>
 									</select>
 								</div>
 							</div>

 							<div id="ilang1" class="row mb-2">
 								<label class="col-sm-4 col-form-label">Nama Ruangan</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="nruang" id="nruang" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($ruangan as $ru):?>
 											<option value="<?= $ru['kode']; ?>"><?= $ru['nama']; ?></option>
 										<?php endforeach;?>
 									</select>
 								</div>
 							</div>

 							<div class="row mb-2">
 								<label class="col-sm-4 col-form-label">Tgl Pemakaian</label>
 								<div class="col-sm-8">
 									<input type="date" class="form-control" id="tpem" name="tpem" placeholder="Tanggal Surat Peminjaman">
 								</div>
 							</div>

 							

 							<div class="row mb-2">
 								<label class="col-sm-4 col-form-label">Dosen</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="nd" id="nd" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($dosen as $ds):?>
 											<option value="<?= $ds['kode']; ?>"><?= $ds['nama']; ?></option>
 										<?php endforeach;?>
 									</select>
 								</div>
 							</div>

 							<div class="row mb-2">
 								<label class="col-sm-4 col-form-label">Semester</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="set" id="set" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($semestertipe as $st):?>
 											<option value="<?= $st['kode']; ?>"><?= $st['tipe_semester']; ?></option>
 										<?php endforeach;?>
 									</select>
 								</div>
 							</div>

 						</div>

 						<div class="col">
 							<div id="ilang" class="row mb-2">
 								<label class="col-sm-4 col-form-label">Nama Matakuliah</label>
 								<div class="col-sm-8">
 									<input type="text" class="form-control" id="namamk" name="namamk" visible readonly="" placeholder="Nama Matakuliah">
 								</div>
 							</div>

 							

 							<div id="ilang3" class="row mb-2">
 								<label class="col-sm-4 col-form-label">Nama Kegiatan</label>
 								<div class="col-sm-8">
 									<textarea class="form-control" id="keg" name="keg" placeholder="Nama Kegiatan" visible  readonly=""></textarea>
 								</div>
 							</div>

 							<div id="ilang2" class="row mb-2">
 								<label class="col-sm-4 col-form-label">Kapasitas</label>
 								<div class="col-sm-8">
 									<input type="text" class="form-control" id="kapas" name="kapas" visible readonly="" placeholder="Kapasitas">
 								</div>
 							</div>

 							<div class="row mb-2">
 								<label class="col-sm-4 col-form-label">Hari</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="har" id="har" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($hari as $hr):?>
 											<option value="<?= $hr['kode']; ?>"><?= $hr['nama']; ?></option>
 										<?php endforeach;?>
 									</select>
 								</div>
 							</div>


 							<div class="row mb-2">
 								<label class="col-sm-4 col-form-label">Jam</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="ja" id="ja" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($jam as $jm):?>
 											<option value="<?= $jm['kode']; ?>"><?= $jm['start'].'-'.$jm['end']; ?></option>
 										<?php endforeach;?>
 									</select>
 								</div>
 							</div>

 						</div>
 					</div>




 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn btn btn-outline-danger" data-dismiss="modal">Close</button>
 					<button type="submit" class="btn btn btn btn-outline-success">Add</button>
 				</div>
 			</form>
 		</div>
 	</div>
 </div> 
 <!--END MODAL Add-->

 <!--MODAL HAPUS-->
 <div class="modal fade" id="ModalHapusPemakaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h5 class="modal-title text-danger" id="hapusPemakaianModalLabel">WARNING MASTER PEMAKAIAN</h5>
 				</div>
 				<form class="form-horizontal">
 					<div class="modal-body">

 						<input type="hidden" name="ko" id="ko" value="" readonly="" visible>
 						<div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="narung" id="narung" required="required" readonly="" visible></p>

 						</div>

 					</div>
 					<div class="modal-footer">
 						<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
 						<button class="btn_hapus btn btn-danger" id="btn_hapuspemakaian">Delete</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>
 <!--END MODAL HAPUS-->

 <!-- modal edit data -->
 <div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditPeminjam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h5 class="modal-title text-danger" id="EditPeminjamModalLabel">EDIT MASTER PEMINJAM</h5>

 				</div>
 				<form class="form-horizontal">
 					<div class="modal-body">
 						<div class="form-group">
 							<!-- <label for="range">Kode</label>                    -->
 							<input type="hidden" class="form-control" name="kode_p" id="kode_p" required="required" readonly="" >
 						</div>

 						<div class="row mb-3">
 							<label class="col-sm-4 col-form-label">No Surat PPKU</label>
 							<div class="col-sm-8">
 								<input type="text" class="form-control" id="no_ppku" name="no_ppku" placeholder="No Surat PPKU">
 							</div>
 						</div>

 						<div class="row mb-3">
 							<label class="col-sm-4 col-form-label">No Peminjaman</label>
 							<div class="col-sm-8">
 								<input type="text" class="form-control" id="no_peminjam" name="no_peminjam" placeholder="No Surat Peminjaman">
 							</div>
 						</div>

 						<div class="row mb-3">
 							<label class="col-sm-4 col-form-label">Nama Kegiatan</label>
 							<div class="col-sm-8">
 								<input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan">
 							</div>
 						</div>

 						<div class="row mb-3">
 							<label class="col-sm-4 col-form-label">Tgl Surat Peminj</label>
 							<div class="col-sm-8">
 								<input type="date" class="form-control" id="tglsp" name="tglsp" placeholder="Tanggal Surat Peminjaman">
 							</div>
 						</div>

 						<div class="row mb-3">
 							<label class="col-sm-4 col-form-label">Hari</label>
 							<div class="col-sm-8">
 								<!-- <input type="text" class="form-control" id="hari" name="hari" placeholder="Hari"> -->
 								<select class="form-control" name="hari" id="hari" required>
 									<option value="">-- Selected --</option>

 									<option value="Senin">Senin</option>
 									<option value="Selasa">Selasa</option>
 									<option value="Rabu">Rabu</option>
 									<option value="Kamis">Kamis</option>
 									<option value="Jum'at">Jum'at</option>
 									<option value="Sabtu">Sabtu</option>
 									<option value="Minggu">Minggu</option>

 								</select>
 							</div>
 						</div>

 						<div class="row mb-3">
 							<label class="col-sm-4 col-form-label">Tgl Kegiatan</label>
 							<div class="col-sm-8">
 								<input type="date" class="form-control" id="tglkeg" name="tglkeg" placeholder="Tanggal Kegiatan">
 							</div>
 						</div>

 						<div class="row mb-3">
 							<label class="col-sm-4 col-form-label">Fasilitas</label>
 							<div class="col-sm-8">
 								<!-- <input type="text" class="form-control" id="fasilitas" name="fasilitas" placeholder="Fasilitas"> -->
 								<select class="form-control" name="fasilitas" id="fasilitas" required>
 									<option value="">-- Selected --</option>
 									<?php foreach($fasi as $fa):?>
 										<option value="<?= $fa['kode_f']; ?>"><?= $fa['nama_fasilitas']; ?></option>
 									<?php endforeach;?>
 								</select>
 							</div>
 						</div>

 						<div class="row mb-3">
 							<label class="col-sm-4 col-form-label">Penanggung Jawab</label>
 							<div class="col-sm-8">
 								<input type="text" class="form-control" id="penanggungj" name="penanggungj" placeholder="Penanggung Jawab">
 							</div>
 						</div>


 					</div>             

 					<div class="modal-footer">
 						<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
 						<button class="btn_edit btn btn-danger" id="btn_editpeminjam">Save</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>
<!--END MODAL EDIT