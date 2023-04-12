
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <?php $dataGet = fetch_array(query("SELECT nama, jk FROM petugas WHERE nip = '{$_SESSION['username']}'")); ?>
                <div class="image">
                <?php
                if ($dataGet['1'] == 'L') { 
                    echo '<img src="../asset/images/pria.png" width="48" height="48" alt="User" />';
                } else if ($dataGet['1'] == 'P') { 
                    echo '<img src="../asset/images/wanita.png" width="48" height="48" alt="User" />';
                }
                ?>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $dataGet['0']; ?></div>
                    <div class="email"><?php echo $_SESSION['username']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="profil.php" id="<?php echo $_SESSION['username']; ?>"><i class="material-icons">person</i>Ubah Password</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="login.php?action=logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="pasien.php">
                            <i class="material-icons">people</i>
                            <span>Data Pasien</span>
                        </a>
                    </li>
                    <li>
                        <a href="rekam-medik.php">
                            <i class="material-icons">layers</i>
                            <span>Rekam Medik</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - <?php echo date('Y'); ?>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

