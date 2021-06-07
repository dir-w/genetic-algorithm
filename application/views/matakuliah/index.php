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
                        <th width="7px">No</th>
                        <th width="8px">Kelompok</th>
                        <th>Kode MatKul</th>
                        <th>Nama</th>
                        <th>Type</th>
                        <th>Jenis</th>
                        <th width="5px">Semester</th>
                        <th>Prodi</th>
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
                            <select class="form-control" name="kel" id="kel" required>
                                <option value="">-- Selected --</option>
                                <?php foreach($kelom as $kp):?>
                                  <option value="<?= $kp['idk']; ?>"><?= $kp['nama_kelompok_mk']; ?></option>
                              <?php endforeach;?>
                          </select>
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
                        <input type="text" class="form-control" id="namamk" name="namamk" placeholder="Nama Matakuliah">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Type</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="typemk" id="typemk" required>
                            <option value="">-- Selected --</option>
                            <?php foreach($typ as $tp):?>
                              <option value="<?= $tp['idtpel']; ?>"><?= $tp['keterangan']; ?></option>
                          <?php endforeach;?>
                      </select>
                  </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Jenis</label>
                <div class="col-sm-8">
                    <select class="form-control" name="jenismk" id="jenismk" required>
                        <option value="">-- Selected --</option>
                        <?php foreach($jen as $jn):?>
                            <option value="<?= $jn['idjmk']; ?>"><?= $jn['nama_jenismk']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Semester</label>
                <div class="col-sm-8">
                    <select class="form-control" name="smk" id="smk" required>
                        <option value="">-- Selected --</option>
                        <?php foreach($smes as $sm):?>
                            <option value="<?= $sm['kode']; ?>"><?= $sm['tipe_semester']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Prodi</label>
                <div class="col-sm-8">
                    <select class="form-control" name="prod" id="prod" required>
                        <option value="">-- Selected --</option>
                        <?php foreach($prod as $pr):?>
                            <option value="<?= $pr['kode']; ?>"><?= $pr['nama_prodi']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Jumlah Jam</label>
                <div class="col-sm-8">
                 <select class="form-control" name="jj" id="jj">
                    <option value="">-- Selected --</option>
                    <?php
                    for ($i = 1; $i < 11; $i++){
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
<div class="modal fade" id="ModalHapusMatKul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusMatKulModalLabel">WARNING MASTER MATAKULIAH</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <input type="hidden" name="kode" id="kode" value="" readonly="" visible>
                    <div class="alert alert-warning"><p>Are you sure you want to delete?<input type="text" class="form-control" name="namamkk" id="namamkk" required="required" readonly="" visible></p>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                    <button class="btn_hapus btn btn-danger" id="btn_hapusmatkul">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--END MODAL HAPUS-->

<!-- modal edit data -->
<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEditMatkul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EditMatkulModalLabel">EDIT MASTER MATAKULIAH</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="range">Kode</label>                    -->
                            <input type="text" class="form-control" name="kodemkkk1" id="kodemkkk1" required="required" readonly="" >
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Kelompok</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="kelmkkk" id="kelmkkk" required>
                                    <option value="">-- Selected --</option>
                                    <?php foreach($kelom as $kp):?>
                                      <option value="<?= $kp['idk']; ?>"><?= $kp['idk']; ?><?= $kp['nama_kelompok_mk']; ?></option>
                                  <?php endforeach;?>
                              </select>
                          </div>
                      </div>

                      <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Kode Matakuliah</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kodemkkk" name="kodemkkk" placeholder="Kode Matakuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Nama Matakuliah</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="namamkkk" name="namamkkk" placeholder="Nama Matakuliah">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Type</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="typemkk" id="typemkk" required>
                                <option value="">-- Selected --</option>
                                <?php foreach($typ as $tp):?>
                                  <option value="<?= $tp['idtpel']; ?>"><?= $tp['keterangan']; ?></option>
                              <?php endforeach;?>
                          </select>
                      </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Jenis</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="jenismkk" id="jenismkk" required>
                            <option value="">-- Selected --</option>
                            <?php foreach($jen as $jn):?>
                                <option value="<?= $jn['idjmk']; ?>"><?= $jn['nama_jenismk']; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Semester</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="smkk" id="smkk" required>
                            <option value="">-- Selected --</option>
                            <?php foreach($smes as $sm):?>
                                <option value="<?= $sm['kode']; ?>"><?= $sm['tipe_semester']; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Prodi</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="prodi" id="prodi" required>
                            <option value="">-- Selected --</option>
                            <?php foreach($prod as $pr):?>
                                <option value="<?= $pr['kode']; ?>"><?= $pr['nama_prodi']; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Jumlah Jam</label>
                    <div class="col-sm-8">
                     <select class="form-control" name="jjmkk" id="jjmkk">
                        <option value="">-- Selected --</option>
                        <?php
                        for ($i = 1; $i < 11; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>


        </div>             

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
            <button class="btn_edit btn btn-danger" id="btn_editmatkul">Save</button>
        </div>
    </form>
</div>
</div>
</div>
</div>
<!--END MODAL EDIT-->


