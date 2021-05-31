<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>
    
    <div class="card">
        <div class="card-header">
           <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newRuanganModal">Tambah</a>


       </div>
       <div class="card-body">
          <div class="table-responsive">
              <table id="ruangTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="10px">No</th>
                        <th width="60px">Kode Ruangan</th>
                        <th>Nama Ruangan</th>
                        <th width="15px">kapasitas</th>
                        <th>Type</th>
                        <th>Jenis</th>
                        <!-- <th>Prodi</th> -->

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
<div class="modal fade" id="newRuanganModal" tabindex="-1" role="dialog" aria-labelledby="newRuanganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newRuanganModalLabel">ADD MASTER RUANGAN</h5>
                
            </div>
            <form action="<?= base_url('data/ruangan'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">ID Ruangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="id" name="id" placeholder="ID Ruangan">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Ruanagn">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Kapasitas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kapasitas" name="kapasitas" placeholder="Kapasitas Ruangan">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Type</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="type" name="type" placeholder="Type Ruangan">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Jenis</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="jenis_ruangan" id="jenis_ruangan" required>
                                <option value="">-- Selected --</option>
                                <?php foreach($ruang as $ru):?>
                                    <option value="<?= $ru['idj']; ?>"><?= $ru['nama_jenis']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Lantai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lantai" name="lantai" placeholder="Lantai Ruangan">
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


