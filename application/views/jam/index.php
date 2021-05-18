



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="j1" class="h3 mb-4 text-primary"><?= $title; ?></h1>

    <div class="card">
        <div class="card-header">
           <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newJamModal">Tambah</a>


       </div>
       <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table id="jamTable" class="table table-bordeless table-hover" width="100%"cellspacing="0">
            <!-- <table id="empTable" class="display"> -->
                <thead class="thead-light">
                  <tr> 
                    <th width="10px">No</th>
                    <th>Range Jam</th>
                        <!-- <th>SKS</th>
                            <th>Sesi</th>  -->


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
<div class="modal fade" id="newJamModal" tabindex="-1" role="dialog" aria-labelledby="newJamModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="newMenuModalLabel">Add Jam</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form action="<?= base_url('data/jam'); ?>" method="post">
                <div class="modal-body">
                    <label class="form-label">Range Jam</label>
                    <div class="row">

                        <div class="col">
                            <!-- SELECT / COMBO BOX -->
                            <div class="form-group">

                                <input type="time" name="range_jam1" id="range_jam1"  class="form-control" onkeyup="Waktumasuk();" />
                            </div>
                        </div>
                        <div class="col-1">
                            -
                        </div>
                        <div class="col">
                            <div class="form-group">

                             <input type="time" name="range_jam2" id="range_jam2"  class="form-control" onkeyup="Waktumasuk();" />
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



<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="hapusjamModalLabel">WARNING</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <input type="hidden" name="kode" id="textkode" value="" readonly="">
                    <div class="alert alert-warning"><p>Are you sure you want to delete?</p></div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                    <button class="btn_hapus btn btn-danger" id="btn_hapus">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--END MODAL HAPUS-->

<!--MODAL EDIT-->

<!-- modal edit data -->

<div class="modal fade bs-example-modal-lg modal-edit" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="EditjamModalLabel">EDIT</h5>
                    
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- <label for="range">Kode</label>                    -->
                            <input type="hidden" class="form-control" name="kode" id="kode" required="required" readonly="" >
                        </div>

                        <div class="form-group">
                            <label for="range">Range Jam</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="range_jamm" id="range_jamm" required="required">
                                </div>
                                -
                                <div class="col">
                                    <input type="text" class="form-control" name="range_jammm" id="range_jammm" required="required">
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button class="btn_edit btn btn-danger" id="btn_edit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->
