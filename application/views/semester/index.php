 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
            <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newSemesterModal">Add</a>
        </div>
        <div class="row">
            <div class="col-lg">
                <?= validation_errors(); ?>
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="semesterTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="7px">No</th>
                        <th>Nama Semeter</th>
                        <th>Tipe Semester</th>
                        
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
<div class="modal fade" id="newSemesterModal" tabindex="-1" role="dialog" aria-labelledby="newSemesterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newSemesterModalLabel">ADD MASTER SEMESTER</h5>
                
            </div>
            <form action="<?= base_url('data/semester'); ?>" method="post">
                <div class="modal-body">


                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama Semester</label>
                        <div class="col-sm-8">
                            <input type="text" onkeyup="this.value = this.value.toUpperCase()"class="form-control" id="nama_sms" name="nama_sms" placeholder="Nama Prodi">

                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Tipe Semester</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="smst" id="smst" required>
                                <option value="">-- Selected --</option>
                                <?php foreach($smst as $st):?>
                                    <option value="<?= $st['kode']; ?>"><?= $st['tipe_semester']; ?></option>
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
<div class="modal fade" id="ModalHapusSemester" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusSemesterModalLabel">WARNING MASTER SEMESTER</h5>

                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" name="ko" id="ko" value="" readonly="" visible>
                        <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="nama_smst" id="nama_smst" required="required" readonly="" visible></p>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapussemester">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->

<!-- modal edit data -->
<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditSemester" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EditSemesterModalLabel">EDIT MASTER SEMESTER</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="range">Kode</label>                    -->
                            <input type="text" class="form-control" name="kode" id="kode" required="required" readonly="" >
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Semester</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_semester" name="nama_semester" placeholder="Nama Semester">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Tipe Semester</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="semester_tipe" id="semester_tipe">
                                   <option value="">-- Selected --</option>
                                   <?php foreach($smst as $st):?>
                                    <option value="<?= $st['kode']; ?>"><?= $st['tipe_semester']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>


                </div>             

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button class="btn_edit btn btn-danger" id="btn_editsemester">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--END MODAL EDIT