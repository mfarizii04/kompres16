            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <!-- Sidenav Menu Heading (Core)-->
                            <div class="sidenav-menu-heading">Utama</div>

                            <!-- DASHBOARD -->
                            <a class="nav-link <?php if(($page=="") || ($page=="dashboard")){ echo "active"; } ?>" href="<?= base_url("admin/dashboard") ?>">
                                <!-- <div class="nav-link-icon"><i data-feather="home"></i></div> -->
                                <div class="nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <!-- INFRASTRUKTUR SERVER -->
                            <div class="sidenav-menu-heading">Infrastruktur</div>
                            <a class="nav-link <?php if(($page=="add-server") || ($page=="server") || ($page=="import-server")){ echo "show"; } else { echo "collapsed"; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseServer" aria-expanded="false" aria-controls="collapseServer">
                                <div class="nav-link-icon"><i data-feather="server"></i></div>
                                Server
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php if(($page=="add-server") || ($page=="server") || ($page=="import-server")){ echo "show"; } ?>" id="collapseServer" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link <?php if($page=="add-server"){ echo "active"; } ?>" href="<?= base_url("admin/server/add") ?>">Tambah Baru</a>
                                    <a class="nav-link <?php if($page=="server"){ echo "active"; } ?>" href="<?= base_url("admin/server") ?>">Daftar Server</a>
                                    <a class="nav-link <?php if($page=="import-server"){ echo "active"; } ?>" href="<?= base_url("admin/server/import") ?>">Import dari Excel</a>
                                </nav>
                            </div>

                            <!-- AKUN SERVER -->
                            <a class="nav-link <?php if(($page=="add-akun") || ($page=="akun") || ($page=="import-akun")){ echo "show"; } else { echo "collapsed"; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAkun" aria-expanded="false" aria-controls="collapseAkun">
                                <div class="nav-link-icon"><i data-feather="user"></i></div>
                                Kredensial Server
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php if(($page=="add-akun") || ($page=="akun") || ($page=="import-akun")){ echo "show"; } ?>" id="collapseAkun" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link <?php if($page=="add-akun"){ echo "active"; } ?>" href="<?= base_url("admin/akun/add") ?>">Tambah Baru</a>
                                    <a class="nav-link <?php if($page=="akun"){ echo "active"; } ?>" href="<?= base_url("admin/akun") ?>">Daftar Kredensial Server</a>
                                    <a class="nav-link <?php if($page=="import-akun"){ echo "active"; } ?>" href="<?= base_url("admin/akun/import") ?>">Import dari Excel</a>
                                </nav>
                            </div>

                            <!-- DATA MASTER -->
                            <div class="sidenav-menu-heading">Data Master</div>

                            <!-- SISTEM OPERASI -->
                            <a class="nav-link <?php if(($page=="add-os") || ($page=="os") || ($page=="import-os")){ echo "show"; } else { echo "collapsed"; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseOS" aria-expanded="false" aria-controls="collapseOS">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Sistem Operasi
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php if(($page=="add-os") || ($page=="os") || ($page=="import-os")){ echo "show"; } ?>" id="collapseOS" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link <?php if($page=="add-os"){ echo "active"; } ?>" href="<?= base_url("admin/os/add") ?>">Tambah Baru</a>
                                    <a class="nav-link <?php if($page=="os"){ echo "active"; } ?>" href="<?= base_url("admin/os") ?>">Daftar Sistem Operasi</a>
                                    <a class="nav-link <?php if($page=="import-os"){ echo "active"; } ?>" href="<?= base_url("admin/os/import") ?>">Import dari Excel</a>
                                </nav>
                            </div>

                            <!-- DATABASE -->
                            <a class="nav-link <?php if(($page=="add-db") || ($page=="db") || ($page=="import-db")){ echo "show"; } else { echo "collapsed"; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDB" aria-expanded="false" aria-controls="collapseDB">
                                <div class="nav-link-icon"><i data-feather="database"></i></div>
                                Database
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php if(($page=="add-db") || ($page=="db") || ($page=="import-db")){ echo "show"; } ?>" id="collapseDB" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link <?php if($page=="add-db"){ echo "active"; } ?>" href="<?= base_url("admin/database/add") ?>">Tambah Baru</a>
                                    <a class="nav-link <?php if($page=="db"){ echo "active"; } ?>" href="<?= base_url("admin/database") ?>">Daftar Database</a>
                                    <a class="nav-link <?php if($page=="import-db"){ echo "active"; } ?>" href="<?= base_url("admin/database/import") ?>">Import dari Excel</a>
                                </nav>
                            </div>

                            <!-- APLIKASI -->
                            <a class="nav-link <?php if(($page=="add-app") || ($page=="app") || ($page=="import-app")){ echo "show"; } else { echo "collapsed"; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAplikasi" aria-expanded="false" aria-controls="collapseAplikasi">
                                <div class="nav-link-icon"><i class="fas fa-desktop"></i></div>
                                Aplikasi
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php if(($page=="add-app") || ($page=="app") || ($page=="import-app")){ echo "show"; } ?>" id="collapseAplikasi" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link <?php if($page=="add-app"){ echo "active"; } ?>" href="<?= base_url("admin/aplikasi/add") ?>">Tambah Baru</a>
                                    <a class="nav-link <?php if($page=="app"){ echo "active"; } ?>" href="<?= base_url("admin/aplikasi") ?>">Daftar Aplikasi</a>
                                    <a class="nav-link <?php if($page=="import-app"){ echo "active"; } ?>" href="<?= base_url("admin/aplikasi/import") ?>">Import dari Excel</a>
                                </nav>
                            </div>

                            <!-- Layanan -->
                            <div class="sidenav-menu-heading">Layanan</div>
                            <a class="nav-link <?php if($page=="lapor"){ echo "active"; } ?>" href="<?= base_url("admin/lapor") ?>">
                                <div class="nav-link-icon"><i data-feather="message-circle"></i></div>
                                Lapor Mas Atmin
                            </a>

                            <!-- Akun Inventarizz. -->
                            <div class="sidenav-menu-heading">Akun</div>
                            <a class="nav-link <?php if(($page=="add-user") || ($page=="users") || ($page=="import-users")){ echo "show"; } else { echo "collapsed"; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAccounts" aria-expanded="false" aria-controls="collapseAccounts">
                                <div class="nav-link-icon"><i data-feather="users"></i></div>
                                Manajemen Akun
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php if(($page=="add-user") || ($page=="users") || ($page=="import-users")){ echo "show"; } ?>" id="collapseAccounts" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link <?php if($page=="add-user"){ echo "active"; } ?>" href="<?= base_url("admin/users/add") ?>">Tambah Baru</a>
                                    <a class="nav-link <?php if($page=="users"){ echo "active"; } ?>" href="<?= base_url("admin/users") ?>">Daftar Akun</a>
                                    <a class="nav-link <?php if($page=="import-users"){ echo "active"; } ?>" href="<?= base_url("admin/users/import") ?>">Import dari Excel</a>
                                </nav>
                            </div>

                            <!-- Log -->
                            <div class="sidenav-menu-heading">Audit</div>
                            <a class="nav-link <?php if($page=="log"){ echo "active"; } ?>" href="<?= base_url("admin/log") ?>">
                                <div class="nav-link-icon"><i class="fas fa-history"></i></div>
                                Log Aktivitas
                            </a>

                            <!-- Sidenav Heading (Systems)-->
                            <div class="sidenav-menu-heading">Sistem</div>

                            <!-- Sistem-->

                            <!-- PROFILE -->
                            <a class="nav-link <?php if($page=="profile"){ echo "active"; } ?>" href="<?= base_url("auth/admin/profile") ?>">
                                <div class="nav-link-icon"><i data-feather="user"></i></div>
                                Profil
                            </a>

                            <!-- LOGOUT -->
                            <a class="nav-link" href="javascript:void(0)" onClick="return logOut()">
                                <div class="nav-link-icon"><i data-feather="log-out"></i></div>
                                Keluar
                            </a>
                        </div>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle"><i class="fas fa-sign-in-alt"></i>&nbsp; Login sebagai : </div>
                            <div class="sidenav-footer-title"><strong><?php if(strlen($this->session->userdata("admin")) >= 20){ echo substr($this->session->userdata("admin"), 0, 20) . "..."; } else { echo $this->session->userdata("admin"); } ?></strong></div>
                        </div>
                    </div>
                </nav>
            </div>