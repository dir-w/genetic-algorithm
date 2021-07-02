 <!-- Begin Page Content -->
 <div class="container-fluid">

 	<!-- Page Heading -->
 	<h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

 	<div class="card"> 
 		<div class="card-header">
 			<a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newInputModal">Add</a>
 		</div>
 		<div class="row">
 			<div class="col-lg">
 				<?= $this->session->flashdata('message'); ?>
 			</div>
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
 								<!-- <th>Hari</th> -->
 								<!-- <th>Start</th>
 								<th>End</th>
 								<th>Semester</th> -->
 								<th>Tgl Pemakaian</th>
 								<th width="60px">Aksi</th>
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
 				<h5 class="modal-title text-danger" id="newInputModalLabel">INPUT PEMAKAIAN RUANGAN</h5>

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

 							<div class="row mb-2">
 								<label class="col-sm-4 col-form-label">Tahun Akademik</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="ta" id="ta" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($takademik as $tak):?>
 											<option value="<?= $tak['kode']; ?>"><?= $tak['tahun']; ?></option>
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
 									<input type="date" class="form-control" id="tpem" name="tpem" placeholder="Tanggal Pemakaian Ruangan">
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
 								<label class="col-sm-4 col-form-label">Semester Tipe</label>
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
 								<label class="col-sm-4 col-form-label">Semester</label>
 								<div class="col-sm-8">
 									<select class="form-control" name="smst" id="smst" required>
 										<option value="">-- Selected --</option>
 										<?php foreach($semester as $smst):?>
 											<option value="<?= $smst['kode']; ?>"><?= $smst['nama_semester']; ?></option>
 										<?php endforeach;?>
 									</select>
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
 					<h5 class="modal-title text-danger" id="hapusPemakaianModalLabel">WARNING PEMAKAIAN RUANGAN</h5>
 				</div>
 				<form class="form-horizontal">
 					<div class="modal-body">

 						<input type="hidden" name="ko" id="ko" value="" readonly="" visible>
 						<div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="narung" id="narung" required="required" readonly="" visible></p>

 						</div>

 					</div>
 					<div class="modal-footer">
 						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
 						<button class="btn_hapus btn btn-danger" id="btn_hapuspemakaian">Delete</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>
 <!--END MODAL HAPUS-->

 <!-- modal edit data -->
 <div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditPemakaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 	<div class="modal-dialog modal-xl" role="document">
 		<div class="modal-content">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h5 class="modal-title text-danger" id="EditPemakaianModalLabel">EDIT PEMAKAIAN RUANGAN</h5>

 				</div>
 				<form class="form-horizontal">
 					<div class="modal-body">
 						<div class="form-group">
 							<!-- <label for="range">Kode</label>                    -->
 							<input type="hidden" class="form-control" name="id_pemakaian" id="id_pemakaian" required="required" readonly="" >
 						</div>


 						<input type="hidden" class="form-control" name="nama_user" id="nama_user" required="required" readonly="" visible value="<?= $user['name']; ?>">

 						<div class="row">
 							<div class="col">
 								<div class="row mb-2">
 									<label class="col-sm-4 col-form-label">Kode Matakuliah</label>
 									<div class="col-sm-8">
 										<select class="form-control" name="kode_mk" id="kode_mk" required>
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
 										<select class="form-control" name="p_jawab" id="p_jawab" required>
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
 										<select class="form-control" name="n_ruang" id="n_ruang" required>
 											<option value="">-- Selected --</option>
 											<?php foreach($ruangan as $ru):?>
 												<option value="<?= $ru['kode']; ?>"><?= $ru['nama']; ?></option>
 											<?php endforeach;?>
 										</select>
 									</div>
 								</div>

 								<div class="row mb-2">
 									<label class="col-sm-4 col-form-label">Tgl Pemakaian</label>
 									<div class="col-sm-8" >
 										<!-- <input type="text" class="form-control" id="tgl" name="tgl" placeholder="Tanggal Pemakaian Ruangan"> -->
 										<!-- <input type="text" id="datepicker" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#datepicker" autocomplete="off" /> -->
 										<input type="text" id="tgl" class="form-control datepicker-input" data-toggle="datetimepicker" data-target="#tgl" autocomplete="off" />
 										<!-- <input type="text" id="datepicker" class="form-control datetimepicker-input" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" /> -->
 										<input type="date" class="form-control" id="tglpem" name="tglpem" placeholder="Tanggal Pemakaian Ruangan">
 									</div>
 								</div>

 								<div class="row mb-2">
 									<label class="col-sm-4 col-form-label">Dosen</label>
 									<div class="col-sm-8">
 										<select class="form-control" name="n_d" id="n_d" required>
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
 										<select class="form-control" name="semester" id="semester" required>
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
 										<input type="text" class="form-control" id="nama_mk" name="nama_mk" visible readonly="" placeholder="Nama Matakuliah">
 									</div>
 								</div>



 								<div id="ilang3" class="row mb-2">
 									<label class="col-sm-4 col-form-label">Nama Kegiatan</label>
 									<div class="col-sm-8">
 										<textarea class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan" visible  readonly=""></textarea>
 									</div>
 								</div>

 								<div id="ilang2" class="row mb-2">
 									<label class="col-sm-4 col-form-label">Kapasitas</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control" id="kapasitas" name="kapasitas" visible readonly="" placeholder="Kapasitas">
 									</div>
 								</div>

 								<div class="row mb-2">
 									<label class="col-sm-4 col-form-label">Hari</label>
 									<div class="col-sm-8">
 										<select class="form-control" name="hari" id="hari" required>
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
 										<select class="form-control" name="jam" id="jam" required>
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
 						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
 						<button class="btn_edit btn btn-danger" id="btn_editpemakaian">Save</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- END MODAL EDIT -->

 <!-- MODAL DETAIL -->
 <div class="modal fade" id="ModalDetailPemakaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 	<div class="modal-dialog modal-lg" role="document">
 		<div class="modal-content">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h5 class="modal-title text-danger" id="DetailPemakaianModalLabel">DETAIL PEMAKAIAN RUANGAN</h5>
 				</div>
 				<form class="form-horizontal">
 					<div class="modal-body">

 						<input type="hidden" name="idpemakaian" id="idpemakaian" value="" readonly="" visible>
 						
 						

 						<div class="card mb-3 col-lg-12">
 							<div class="row no-gutters">
									<!-- <tr>
										<td>Kode Ruangan</td>
										<td width="1px">:</td>
										<td id="dkoder1"></td>
									</tr> -->

									<div class="col-md-4">
										<div class="card-body">
											<h5 class="card-title">Kode Ruangan</h5>
											<p class="card-text jarak">Nama Ruangan</p>
											<p class="card-text jarak"><small class="text-muted">Nama Peminjam</small></p>
											<p class="card-text jarak"><small class="text-muted">Kegiatan</small></p>
											<p class="card-text jarak"><small class="text-muted">Tanggal Pemakaian Ruangan</small></p>
											<p class="card-text jarak"><small class="text-muted">Tahun Akademik</small></p>
											<p class="card-text jarak"><small class="text-muted">Kode Matakuliah</small></p>
											<p class="card-text jarak"><small class="text-muted">Nama Matakuliah</small></p>
											<p class="card-text jarak"><small class="text-muted">Type Matakuliah</small></p>
											<p class="card-text jarak"><small class="text-muted">Pararel</small></p>
											<p class="card-text jarak"><small class="text-muted">Semester tipe</small></p>
											<p class="card-text jarak"><small class="text-muted">Hari</small></p>
											<p class="card-text jarak"><small class="text-muted">Jam</small></p>
										</div>
									</div>
									<div class="col-md-1">
										<div class="card-body">
											<h5 class="card-title">:</h5>
											<p class="card-text jarak">:</p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
											<p class="card-text jarak"><small class="text-muted">:</small></p>
										</div>
									</div>
									<div class="col-md-7">
										<div class="card-body">
											
											<h5 class="card-title" id="dkoder"></h5>
											<p class="card-text jarak" id="dnamar"></p>
											<p class="card-text jarak"><small class="text-muted" id="dnamapeminjam"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dkegiatan"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dta"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dtglpr"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dkodemk"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dnamamk"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dnamatypemk"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dketeranganp"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dsemtipe"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="dhari"></small></p>
											<p class="card-text jarak"><small class="text-muted" id="djam"></small></p>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<!-- <button class="btn_hapus btn btn-danger" id="btn_hapuspemakaian">Delete</button> -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
 <!--END MODAL DETAIL-->