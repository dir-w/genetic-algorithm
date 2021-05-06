<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-4">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="<?= base_url('assets/img/logo/Somad.jpg') ?>" width="75px" height="75px" class="img-fluid mb-2" alt="Responsive image">
                                    <hr>
                                    <h2 >Login-<b class="text-danger mb-4">SiPR</b></h1>
                                    <p><font style="font-size: 12px">
                                    Sistem Informasi Penggunaan Ruangan</font></p>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form class="user mt-4" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <font style="font-size: 12px">Copyright &#64; <?= date('Y') ?>  
                                    </font>
                                    <font style="font-size: 12px" color="#B22222">SiPR</font> <font style="font-size: 12px" color="#808080">by.</font> <font style="font-size: 12px" color="#00FF00">dir/w |</font> <font style="font-size: 12px" color="#808080">V. 1.0,00</font>
                                    <!-- <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div> 