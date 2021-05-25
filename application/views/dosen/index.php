<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
            <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newDosenModal">Add</a>


        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="dosenTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="10px">No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Status</th>

                        <th width="50px">Aksi</th>
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
<div class="modal fade" id="newDosenModal" tabindex="-1" role="dialog" aria-labelledby="newDosenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newDosenModalLabel">ADD MASTER DOSEN</h5>
                
            </div>
            <form action="<?= base_url('data/Dosen'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">NIP</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="nip" name="nip" placeholder="Nomor Induk Pegawai">
                      </div>
                  </div>

                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">NAMA</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nam Pegawai">
                    </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">ALAMAT</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Pegawai">
                  </div>
              </div>

              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Telp/HP</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="telp" name="telp" placeholder="No Telp/HP Pegawai">
                  </div>
              </div>

              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">STATUS</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="status_dosen" name="status_dosen" placeholder="Nomor Induk Pegawai">
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


