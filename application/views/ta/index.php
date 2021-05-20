<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="h1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
           <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newTAModal">Add</a>
       </div>
       <div class="card-body">
          <div class="table-responsive">
              <table id="taTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
                <!-- <table id="empTable" class="display"> -->
                    <thead class="thead-light">
                      <tr> 
                        <th width="10px">No</th>
                        <th>Tahun Akademik</th>

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
<div class="modal fade" id="newTAModal" tabindex="-1" role="dialog" aria-labelledby="newTAModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newMenuModalLabel">ADD MASTER TAHUN AJARAN</h5>
                
            </div>
            <form action="<?= base_url('data/takademik'); ?>" method="post">
                <div class="modal-body">
                    <label class="form-label">Tahun Ajaran</label>
                    <div class="row">

                        <div class="col">
                            <!-- SELECT / COMBO BOX -->
                            <div class="form-group">

                                <select id="ta1" name="ta1" class="form-control show-tick col-xs-4" required>
                                    <option value="">-- Select --</option>
                                    <?php
                                    for($i = 2010; $i < date("Y")+1; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-1">
                            -
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select id="ta2" name="ta2" class="form-control show-tick col-xs-4" required>
                                    <option value="">-- Select --</option>
                                    <?php
                                    for($i = 2010; $i < date("Y")+1; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                           </div>
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



