<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

  <div class="card">
    <div class="card-header">
      <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newStatusDosenModal">Add</a>
    </div>
    <div class="row">
      <div class="col-lg">
        <?= validation_errors(); ?>
        <?= $this->session->flashdata('message'); ?>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="statusdosenTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
          <!-- <table id="empTable" class="display"> -->
            <thead class="thead-light">
              <tr> 
                <th width="10px">No</th>
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
<div class="modal fade" id="newStatusDosenModal" tabindex="-1" role="dialog" aria-labelledby="newStatusDosenModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="newStatusDosenModalLabel">ADD MASTER STATUS DOSEN</h5>

      </div>
      <form action="<?= base_url('data/StatusDosen'); ?>" method="post">
        <div class="modal-body">

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="stat_dosen" name="stat_dosen" placeholder="Status Dosen">
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
<div class="modal fade" id="ModalHapusStatusDosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="hapusStatusdosenModalLabel">WARNING MASTER STATUS DOSEN</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> -->
                </div>
                <form class="form-horizontal">
                  <div class="modal-body">

                    <input type="hidden" name="kode" id="kode" value="" readonly="" visible>
                    <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="namas" id="namas" required="required" readonly="" visible></p>

                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button class="btn_hapus btn btn-danger" id="btn_hapusstatusdosen">Delete</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--END MODAL HAPUS-->

        <!-- modal edit data -->
        <div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditStatusDosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-danger" id="EditStatusdosenModalLabel">EDIT MASTER STATUS DOSEN</h5>

                </div>
                <form class="form-horizontal">
                  <div class="modal-body">
                    <div class="form-group">
                      <!-- <label for="range">Kode</label>                    -->
                      <input type="hidden" class="form-control" name="skode" id="skode" required="required" readonly="" >
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Status</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="namastat" name="namastat" placeholder="Nomor Induk Pegawai">
                      </div>
                    </div>


                  </div>             

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button class="btn_edit btn btn-danger" id="btn_editstatusdosen">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
<!--END MODAL EDIT-->