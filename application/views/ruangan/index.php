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
                        <th>Lantai</th>

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
                            <select class="form-control" name="type" id="type" required>
                                <option value="">-- Selected --</option>
                                <?php foreach($typer as $tr):?>
                                    <option value="<?= $tr['idt']; ?>"><?= $tr['nama_type']; ?></option>
                                <?php endforeach;?>
                            </select>
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
                            <select class="form-control" name="lantai" id="lantai">
                                <option value="">-- Selected --</option>
                                <?php
                                for ($i = 1; $i < 10; $i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                                ?>
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
<div class="modal fade" id="ModalHapusRuangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusRuanganModalLabel">WARNING MASTER RUANGAN</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <input type="hidden" name="kode" id="kode" value="" readonly="" visible>
                    <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="namar" id="namar" required="required" readonly="" visible></p>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                    <button class="btn_hapus btn btn-danger" id="btn_hapusruangan">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--END MODAL HAPUS-->


<!-- modal edit data -->
<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditRuangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EditRuanganModalLabel">EDIT MASTER RUANGAN</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="range">Kode</label>                    -->
                            <input type="text" class="form-control" name="rkode" id="rkode" required="required" readonly="" >
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ID Ruangan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="idru" name="idru" placeholder="ID Ruangan">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaru" name="namaru" placeholder="Nama Ruanagn">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Kapasitas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kapasitasru" name="kapasitasru" placeholder="Kapasitas Ruangan">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="typeru" id="typeru" required>
                                    <option value="">-- Selected --</option>
                                    <?php foreach($typer as $tr):?>
                                        <option value="<?= $tr['idt']; ?>"><?= $tr['nama_type']; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Jenis</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="jenis_ruanganru" id="jenis_ruanganru" required>
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
                                <select class="form-control" name="lantairu" id="lantairu">
                                    <option value="">-- Selected --</option>
                                    <?php
                                    for ($i = 1; $i < 10; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>



                    </div>             

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_edit btn btn-danger" id="btn_editruangan">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->

