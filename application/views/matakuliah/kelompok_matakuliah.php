
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
            <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newKelMapelModal">Add</a>


        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="kelmatkulTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="10px">No</th>
                        <th width="100px">Kelompok</th>
                        <th>Keterangan</th>


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
<div class="modal fade" id="newKelMapelModal" tabindex="-1" role="dialog" aria-labelledby="newKelMapelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newKelMapelModalLabel">ADD MASTER KELOMPOK MATAKULIAH</h5>
                
            </div>
            <form action="<?= base_url('data/kelmatkul'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Kelompok</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_kel" name="nama_kel" placeholder="Type Mata Kuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ket_kel" name="ket_kel" placeholder="Type Mata Kuliah">
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
<div class="modal fade" id="ModalHapusKelMatKul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusKelMatKulModalLabel">WARNING MASTER KELOMPOK MATAKULIAH</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" name="idkel" id="idkel" value="" readonly="" visible>
                        <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="nama_kelo" id="nama_kelo" required="required" readonly="" visible></p>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapustkelmatkkul">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->

<!-- modal edit data -->
<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditKelMatkul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EditKelMatkulModalLabel">EDIT MASTER KELOMPOK MATAKULIAH</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="range">Kode</label>                    -->
                            <input type="text" class="form-control" name="idk" id="idk" required="required" readonly="" >
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Kelompok</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" placeholder="Type Mata Kuliah">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ket_kelompok" name="ket_kelompok" placeholder="Type Mata Kuliah">
                            </div>
                        </div>

                        
                    </div>             

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_edit btn btn-danger" id="btn_editkelmatakuliah">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->


