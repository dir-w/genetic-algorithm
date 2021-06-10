
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
            <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newPararelMKModal">Add</a>


        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="pararelmatkulTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="10px">No</th>
                        <th>Nama</th>
                        <!-- <th>Keterangan</th> -->


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
<div class="modal fade" id="newPararelMKModal" tabindex="-1" role="dialog" aria-labelledby="newPararelMKModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newPararelMKModalLabel">ADD MASTER PARAREL MATAKULIAH</h5>
                
            </div>
            <form action="<?= base_url('data/pararelmatkul'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="namapar" name="namapar" placeholder="Nama Jenis Matakuliah">
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
<div class="modal fade" id="ModalHapusPararelMatKul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusPararelMatKulModalLabel">WARNING MASTER PARAREL MATAKULIAH</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" name="idjm" id="idjm" value="" readonly="" visible>
                        <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="nama_j" id="nama_j" required="required" readonly="" visible></p>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapustpararelmatkkul">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->

<!-- modal edit data -->
<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditPararelMatkul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EditPararelMatkulModalLabel">EDIT MASTER PARAREL MATAKULIAH</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="range">Kode</label>                    -->
                            <input type="hidden" class="form-control" name="idjmk" id="idjmk" required="required" readonly="" >
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_pararelmk" name="nama_pararelmk" placeholder="Nama jenis Matakuliah">
                            </div>
                        </div>

                        
                    </div>             

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_edit btn btn-danger" id="btn_editpararelmatakuliah">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->


