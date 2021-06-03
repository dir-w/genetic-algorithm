<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
            <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newMapelModal">Add</a>


        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="matkulTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="10px">No</th>
                        <th>Kelompok</th>
                        <th>Kode MatKul</th>
                        <th>Nama</th>
                        <th>Type</th>
                        <th>Jenis</th>
                        <th>Semester</th>

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
                <h5 class="modal-title text-danger" id="newMapelModalLabel">ADD MASTER MATAKULIAH</h5>
                
            </div>
            <form action="<?= base_url('data/matkul'); ?>" method="post">
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Kelompok</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kel" name="kel" placeholder="Kelompok Matakuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Kode Matakuliah</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kodemk" name="kodemk" placeholder="Kode Matakuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama Matakuliah</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kel" name="kel" placeholder="Nama Matakuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Type</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="typemk" name="typemk" placeholder="Kelompok Mata Kuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Jenis</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jenismk" name="jenismk" placeholder="Jenis Matakuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Semester</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="smk" name="smk" placeholder="Semester">
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


