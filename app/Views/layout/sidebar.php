 <aside class="main-sidebar sidebar-light-danger elevation-4">
     <!-- Brand Logo -->
     <a href="<?= base_url('/') ?>" class="brand-link bg-danger" style="height: 70px; display: flex; align-items: center; justify-content: center; padding: 0;">
         <div style="display: flex; flex-direction: column; align-items: center;">
             <img src="<?= base_url('assets/img/logokargo.jpg') ?>"
                 alt="Logo Kargo"
                 class="brand-image elevation-3"
                 style="max-height: 35px; width: auto; margin: 0; border-radius: 5px;">
             <span class="brand-text font-weight-bold"
                 style="color: white; font-size: 1rem; margin-top: 3px;">
                 SI - CARGO
             </span>
         </div>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- SidebarSearch Form -->
         <div class="form-inline mt-3">
             <div class="input-group">
                 <input class="form-control form-control-sidebar"
                     type="search"
                     placeholder="Cari Menu"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <?php if (in_groups('Petugas')) : ?>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/dashboard" class="nav-link">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Dashboard
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">Master</li>

                     <li class="nav-item">
                         <a href="<?php base_url() ?>/konsumen" class="nav-link">
                             <i class="nav-icon fas fa-user"></i>
                             <p>
                                 Konsumen
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/kota" class="nav-link">
                             <i class="nav-icon fas fa-city"></i>
                             <p>
                                 Kota
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="<?php base_url() ?>/tarif" class="nav-link">
                             <i class="nav-icon fas fa-money-bill"></i>
                             <p>
                                 Tarif
                             </p>
                         </a>
                     </li>


                     <li class="nav-item">
                         <a href="<?php base_url() ?>/user" class="nav-link">
                             <i class="nav-icon fas fa-user"></i>
                             <p>
                                 Data User
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">Trasaksi</li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/pengiriman" class="nav-link">
                             <i class="nav-icon fas fa-truck"></i>
                             <p>
                                 Pengiriman
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">Laporan</li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/laporan-pelanggan" class="nav-link">
                             <i class="nav-icon fas fa-chart-bar"></i>
                             <p>
                                 Laporan Konsumen
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/laporan-kota" class="nav-link <?= (current_url() == base_url('laporan-kota')) ? 'active' : '' ?>
                         <?= (current_url() == base_url('laporan-kota/add')) ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-chart-bar"></i>
                             <p>
                                 Laporan Kota
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/laporan-tarif" class="nav-link <?= (current_url() == base_url('laporan-tarif')) ? 'active' : '' ?>
                         <?= (current_url() == base_url('/laporan-tarif')) ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-chart-bar"></i>
                             <p>
                                 Laporan Tarif
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/laporan-pengiriman" class="nav-link <?= (current_url() == base_url('laporan-pengiriman')) ? 'active' : '' ?>
                         <?= (current_url() == base_url('laporan-pengiriman/add')) ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-chart-bar"></i>
                             <p>
                                 Laporan Pengiriman
                             </p>
                         </a>
                     </li>



                 <?php endif; ?>
                 <?php if (in_groups('Kepala Kantor')) : ?>
                     <li class="nav-header">Laporan</li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/laporan-pelanggan" class="nav-link">
                             <i class="nav-icon fas fa-chart-bar"></i>
                             <p>
                                 Laporan Konsumen
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/laporan-kota" class="nav-link <?= (current_url() == base_url('laporan-kota')) ? 'active' : '' ?>
                         <?= (current_url() == base_url('laporan-kota/add')) ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-chart-bar"></i>
                             <p>
                                 Laporan Kota
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/laporan-tarif" class="nav-link <?= (current_url() == base_url('laporan-tarif')) ? 'active' : '' ?>
                         <?= (current_url() == base_url('/laporan-tarif')) ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-chart-bar"></i>
                             <p>
                                 Laporan Tarif
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?php base_url() ?>/laporan-pengiriman" class="nav-link <?= (current_url() == base_url('laporan-pengiriman')) ? 'active' : '' ?>
                         <?= (current_url() == base_url('laporan-pengiriman/add')) ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-chart-bar"></i>
                             <p>
                                 Laporan Pengiriman
                             </p>
                         </a>
                     </li>
                 <?php endif; ?>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>