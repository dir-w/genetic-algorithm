



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


<!-- Modal detail -->
<div class="modal fade" id="detailAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="detailAnggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="newMenuModalLabel">Detail Anggota</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form action="<?= base_url('data/addjam'); ?>" method="post">
                <div class="modal-body">

                	<div class="row">

                		<!-- <div class="card"> -->
                           <div class="row no-gutters">
                               <div class="col-md-4">
                                   <img src="<?= base_url('assets/img/foto/') . $user['image']; ?>" class="card-img">
                               </div>
                               <div class="col-md-8">
                                   <div class="card-body">
                                       <h5 class="card-title"><?= $user['name']; ?></h5>
                                       <p class="card-text"><?= $user['email']; ?></p>
                                       <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                                   </div>
                               </div>
                           </div>
                           <!-- </div> -->

                       </div>





                   </div>
                   <div class="modal-footer">
                    <button type="button" class="btn btn btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button href="" class="btn btn btn btn-outline-primary">Print</button>
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
                <h5 class="modal-title text-danger" id="hapusjamModalLabel">Hapus</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="test" name="kode" id="textkode" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau memhapus barang ini?</p></div>
                                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!--END MODAL HAPUS-->


        