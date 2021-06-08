<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

	<div class="card">
		<div class="card-header">
			<a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newPeminjamModal">Add</a>


		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="peminjamTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
					<!-- <table id="empTable" class="display"> -->
						<thead class="thead-light">
							<tr> 
								<th width="7px">No</th>
								<th>No PPKU</th>
								<th>No Peminjam</th>
								<th>Nama Kegiatan</th>
								<th>Tgl Surat Peminjaman</th>
								<th>Hari</th>
								<th>Tgl Kegiatan</th>
								<th>Fasilitas</th>
								<th>Penanggung Jawab</th>
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
<div class="modal fade" id="newPeminjamModal" tabindex="-1" role="dialog" aria-labelledby="newFasilitasModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="newPeminjamModalLabel">ADD MASTER PEMINJAM</h5>

			</div>
			<form action="<?= base_url('peminjam/peminjaman'); ?>" method="post">
				<div class="modal-body">


					<div class="row mb-3">
						<label class="col-sm-4 col-form-label">No Surat PPKU</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nppku" name="nppku" placeholder="No Surat PPKU">
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-sm-4 col-form-label">No Peminjaman</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nop" name="nop" placeholder="No Surat Peminjaman">
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-sm-4 col-form-label">Nama Kegiatan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="keg" name="keg" placeholder="Nama Kegiatan">
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-sm-4 col-form-label">Tgl Surat Peminj</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="tsp" name="tsp" placeholder="Tanggal Surat Peminjaman">
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-sm-4 col-form-label">Hari</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="har" name="har" placeholder="Hari">
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-sm-4 col-form-label">Tgl Kegiatan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="tg" name="tg" placeholder="Tanggal Kegiatan">
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-sm-4 col-form-label">Fasilitas</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="fas" name="fas" placeholder="Fasilitas">
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-sm-4 col-form-label">Penanggung Jawab</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="penj" name="penj" placeholder="Penanggung Jawab">
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
<div class="modal fade" id="ModalHapusFasilitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-danger" id="hapusFasilitasModalLabel">WARNING MASTER FASILITAS</h5>
				</div>
				<form class="form-horizontal">
					<div class="modal-body">

						<input type="hidden" name="ko" id="ko" value="" readonly="" visible>
						<div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="nama_f" id="nama_f" required="required" readonly="" visible></p>

						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
						<button class="btn_hapus btn btn-danger" id="btn_hapusfasilitas">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--END MODAL HAPUS-->

<!-- modal edit data -->
<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditFasilitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-danger" id="EditFasilitasModalLabel">EDIT MASTER FASILITAS</h5>

				</div>
				<form class="form-horizontal">
					<div class="modal-body">
						<div class="form-group">
							<!-- <label for="range">Kode</label>                    -->
							<input type="hidden" class="form-control" name="kode" id="kode" required="required" readonly="" >
						</div>

						<div class="row mb-3">
							<label class="col-sm-4 col-form-label">Nama Fasilitas</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nama_fasilitas" name="nama_fasilitas" placeholder="Nama Jurusan">
							</div>
						</div>


					</div>             

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
						<button class="btn_edit btn btn-danger" id="btn_editfasilitas">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--END MODAL EDIT-->