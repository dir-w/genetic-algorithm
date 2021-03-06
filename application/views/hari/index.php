<!-- Begin Page Content -->
<div class="container-fluid"> 

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>
    
    <div class="card">
        <div class="card-header">
           <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newHariModal">Add</a>
       </div>
       <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table id="hariTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
            <!-- <table id="empTable" class="display"> -->
                <thead class="thead-light">
                  <tr> 
                    <th width="10px">No</th>
                    <th>Nama hari</th>

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
<div class="modal fade" id="newHariModal" tabindex="-1" role="dialog" aria-labelledby="newHariModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newMenuModalLabel">ADD MASTER HARI</h5>
                
            </div>
            <form action="<?= base_url('data/hari'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Hari</label>
                        <div class="col-sm-8">
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
<div class="modal fade" id="ModalHapusHari" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapushariModalLabel">WARNING MASTER HARI</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" name="kode" id="kode" value="" readonly="">
                        <div class="alert alert-warning"><p>Are you sure you want to delete?</p></div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapushari">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->

<!-- modal edit data -->

<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditHari" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EdithariModalLabel">EDIT MASTER HARI</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">

                            <input type="hidden" class="form-control" name="ekode" id="ekode" required="required" readonly="" >
                        </div>

                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <div class="row">

                                <div class="col">
                                    <input type="text" class="form-control" name="nhari" id="nhari">
                                    <!-- <select class="form-control" name="nhari" id="nhari" required>
                                        <option value="">-- Selected --</option>

                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jum'at">Jum'at</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option> -->

                                    </select>
                                </div>

                                <div class="col-2">
                                    <input type="text" class="form-control" name="id_hari" id="id_hari" required="required" readonly="" visible>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn_edit btn btn-danger" id="btn_edithari">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->
