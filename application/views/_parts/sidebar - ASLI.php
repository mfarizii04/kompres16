            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <!-- Sidenav Menu Heading (Core)-->
                            <div class="sidenav-menu-heading">Core</div>
                            <!-- Sidenav Accordion (Dashboard)-->
                            <a class="nav-link <?php if(($page=="") || ($page=="dashboard")){ echo "active"; } ?>" href="<?= base_url("dashboard") ?>">
                                <div class="nav-link-icon"><i data-feather="home"></i></div>
                                Dashboard
                            </a>
                            <!-- Server -->
                            <div class="sidenav-menu-heading">Server</div>
                            <a class="nav-link <?php if($page=="server"){ echo "active"; } ?>" href="<?= base_url("server") ?>">
                                <div class="nav-link-icon"><i data-feather="server"></i></div>
                                Server
                            </a>
                            <a class="nav-link <?php if($page=="akun"){ echo "active"; } ?>" href="<?= base_url("akun") ?>">
                                <div class="nav-link-icon"><i data-feather="user"></i></div>
                                Akun Server
                            </a>
                            <!-- Data Master -->
                            <div class="sidenav-menu-heading">Data Master</div>
                            <a class="nav-link <?php if($page=="os"){ echo "active"; } ?>" href="<?= base_url("os") ?>">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Sistem Operasi
                            </a>
                            <a class="nav-link <?php if($page=="db"){ echo "active"; } ?>" href="<?= base_url("db") ?>">
                                <div class="nav-link-icon"><i data-feather="database"></i></div>
                                Database
                            </a>
                            <!-- Laporan -->
                            <div class="sidenav-menu-heading">Layanan</div>
                            <a class="nav-link <?php if(($page=="add-lapor") || ($page=="lapor")){ echo "show"; } else { echo "collapsed"; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAkun" aria-expanded="false" aria-controls="collapseAkun">
                                <div class="nav-link-icon"><i data-feather="message-circle"></i></div>
                                Lapor Mas Atmin
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php if(($page=="add-lapor") || ($page=="lapor")){ echo "show"; } ?>" id="collapseAkun" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link <?php if($page=="add-lapor"){ echo "active"; } ?>" href="<?= base_url("lapor/add") ?>">Laporan Baru</a>
                                    <a class="nav-link <?php if($page=="lapor"){ echo "active"; } ?>" href="<?= base_url("lapor") ?>">Daftar Laporan</a>
                                </nav>
                            </div>
                            <!-- Systems-->
                            <div class="sidenav-menu-heading">Systems</div>
                            <a class="nav-link <?php if($page=="profile"){ echo "active"; } ?>" href="<?= base_url("auth/profile") ?>">
                                <div class="nav-link-icon"><i data-feather="user"></i></div>
                                Profile
                            </a>
                            <a class="nav-link" href="javascript:void(0)" onClick="return logOut()">
                                <div class="nav-link-icon"><i data-feather="log-out"></i></div>
                                Log-Out
                            </a>
                        </div>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle"><i class="fas fa-sign-in-alt"></i>&nbsp; Login sebagai:</div>
                            <div class="sidenav-footer-title"><?php if(strlen($this->session->userdata("viewer")) >= 20){ echo substr($this->session->userdata("viewer"), 0, 20) . "..."; } else { echo $this->session->userdata("viewer"); } ?></div>
                        </div>
                    </div>
                </nav>
            </div>