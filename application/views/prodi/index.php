<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
            <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newProdiModal">Add</a>
        </div>
        
        
        <div class="row">
            <div class="col-lg">
                <?= validation_errors(); ?>
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="prodiTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="7px">No</th>
                        <th width="8px">ID Prodi</th>
                        <th>Nama Prodi</th>
                        <th>Fakultas</th>
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
<div class="modal fade" id="newProdiModal" tabindex="-1" role="dialog" aria-labelledby="newProdiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newMapelModalLabel">ADD MASTER PRODI</h5>
                
            </div>
            <form action="<?= base_url('data/prodi'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Kode Prodi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="koprod" name="koprod" placeholder="Kode Prodi">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama Prodi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_pro" name="nama_pro" placeholder="Nama Prodi">

                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama Fakultas</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="fak" id="fak" required>
                                <option value="">-- Selected --</option>
                                <?php foreach($fakul as $fa):?>
                                    <option value="<?= $fa['kode']; ?>"><?= $fa['nama_fakultas']; ?></option>
                                <?php endforeach;?>
                            </select>
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
<div class="modal fade" id="ModalHapusProdi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusProdiModalLabel">WARNING MASTER PRODI</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <input type="hidden" name="ko" id="ko" value="" readonly="" visible>
                    <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="nama_prod" id="nama_prod" required="required" readonly="" visible></p>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                    <button class="btn_hapus btn btn-danger" id="btn_hapusprodi">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--END MODAL HAPUS-->

<!-- modal edit data -->
<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditProdi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EditProdiModalLabel">EDIT MASTER PRODI</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="range">Kode</label>                    -->
                            <input type="hidden" class="form-control" name="kode" id="kode" required="required" readonly="" >
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Kode Prodi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="koprodi" name="koprodi" placeholder="Kode Prodi">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Prodi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" placeholder="Kode Matakuliah">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Fakultas</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="kode_fakultas" id="kode_fakultas" required>
                                    <option value="">-- Selected --</option>
                                    <?php foreach($fakul as $faku):?>
                                        <option value="<?= $faku['kode']; ?>"><?= $faku['nama_fakultas']; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>


                    </div>             

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_edit btn btn-danger" id="btn_editprodi">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->