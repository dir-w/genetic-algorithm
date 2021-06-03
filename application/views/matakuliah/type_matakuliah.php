<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
         <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newMapelModal">Tambah</a>


     </div>
     <div class="card-body">
      <div class="table-responsive">
          <table id="typeTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
            <!-- <table id="empTable" class="display"> -->
                <thead class="thead-light">
                  <tr> 
                    <th width="10px">No</th>
                    <th>Type Matakuliah</th>

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
<div class="modal fade" id="newMapelModal" tabindex="-1" role="dialog" aria-labelledby="newMapelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newMapelModalLabel">ADD MASTER TYPE MATAKULIAH</h5>
                
            </div>
            <form action="<?= base_url('data/typematkul'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ket" name="ket" placeholder="Type Mata Kuliah">
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
<div class="modal fade" id="ModalHapusTypeMatKul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusTypeMatKulModalLabel">WARNING MASTER TYPE MATAKULIAH</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <input type="text" name="idtpe" id="idtpe" value="" readonly="" visible>
                        <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="keter" id="keter" required="required" readonly="" visible></p>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapustypematkkul">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->


