
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
            <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newJenisMKModal">Add</a>


        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="jenismatkulTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="10px">No</th>
                        <th width="100px">Nama</th>
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
<div class="modal fade" id="newJenisMKModal" tabindex="-1" role="dialog" aria-labelledby="newJenisMKModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newJenisMKModalLabel">ADD MASTER JENIS MATAKULIAH</h5>
                
            </div>
            <form action="<?= base_url('data/jenismatkul'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_jen" name="nama_jen" placeholder="Nama Jenis Matakuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ket_jen" name="ket_jen" placeholder="Keterangan Jenis Matakuliah">
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
<div class="modal fade" id="ModalHapusJenisMatKul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusJenisMatKulModalLabel">WARNING MASTER JENIS MATAKULIAH</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" name="idjm" id="idjm" value="" readonly="" visible>
                        <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="nama_j" id="nama_j" required="required" readonly="" visible></p>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapustjenismatkkul">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->

<!-- modal edit data -->
<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditJenisMatkul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EditJenisMatkulModalLabel">EDIT MASTER JENIS MATAKULIAH</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="range">Kode</label>                    -->
                            <input type="hidden" class="form-control" name="idjmk" id="idjmk" required="required" readonly="" >
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Kelompok</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_jenismk" name="nama_jenismk" placeholder="Nama jenis Matakuliah">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ket_jenismk" name="ket_jenismk" placeholder="Keterangan Jenis Matakuliah">
                            </div>
                        </div>

                        
                    </div>             

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_edit btn btn-danger" id="btn_editjenismatakuliah">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->


