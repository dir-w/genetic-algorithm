        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <!-- <div class="sidebar-brand-icon rotate-n-15"> -->
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-microchip"></i>
                        <!-- <img src="<?= base_url('assets/'); ?>img/logo/somad.jpg" class="img-fluid" alt="Responsive image" width="40px" height="40px"> -->
                        
                    </div>
                    <div class="sidebar-brand-text mx-3">SiPR</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider">


                <!-- QUERY MENU -->
                <?php 
                $role_id = $this->session->userdata('role_id');
                $queryMenu = "SELECT `user_menu`.`id`, `menu`
                FROM `user_menu` JOIN `user_access_menu`
                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                WHERE `user_access_menu`.`role_id` = $role_id
                ORDER BY `user_access_menu`.`menu_id` ASC
                ";
                $menu = $this->db->query($queryMenu)->result_array();
                ?>
                
                


                <!-- LOOPING MENU -->
                
            <!-- <div class="sidebar-heading">
                <?= $m['menu']; ?>
            </div> -->
            <?php foreach ($menu as $m) : ?>
                <li class="nav-item">
                   
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#<?= $m['menu']; ?>" aria-expanded="true" aria-controls="collapseTwo">
                        <!-- <i class="fas fa-database"></i> -->
                        <span><?= $m['menu']; ?></span> 
                    </a>
                    
                    <div id="<?= $m['menu']; ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">


                        <!-- SIAPKAN SUB-MENU SESUAI MENU -->
                        <?php 
                        $menuId = $m['id'];
                        $querySubMenu = "SELECT *
                        FROM `user_sub_menu` JOIN `user_menu` 
                        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                        WHERE `user_sub_menu`.`menu_id` = $menuId
                        AND `user_sub_menu`.`is_active` = 1
                        ";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>
                        
                        <?php foreach ($subMenu as $sm) : ?>

                            <?php if ($title == $sm['title']) : ?>
                                
                                <a class="collapse-item">
                                <?php endif; ?>
                                <a class="collapse-item" href="<?= base_url($sm['url']); ?>"><?= $sm['title']; ?></a>
                            <?php endforeach; ?>              
                            




                            
                        <?php endforeach; ?>
                        
                    </div>
                </div>
                <hr class="sidebar-divider mt-3">
            </li>      


            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
                </li>


                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End  of Sidebar --> 