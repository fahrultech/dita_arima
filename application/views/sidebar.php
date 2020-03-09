<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        	<li class="menu-title">Menu</li>
                            <li class="">
                                <a href="<?php echo site_url('KelompokNelayan'); ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Nelayan Kelompok </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="<?php echo site_url('Kecamatan');?>" class="waves-effect"><i class="mdi mdi-layers"></i><span> Data Kecamatan </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="<?php echo site_url('Desa');?>" class="waves-effect"><i class="mdi mdi-layers"></i><span> Data Desa </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="<?php echo site_url('JenisIkan');?>" class="waves-effect"><i class="mdi mdi-layers"></i><span> Jenis Ikan </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="<?php echo site_url('AlatTangkap');?>" class="waves-effect"><i class="mdi mdi-layers"></i><span> Alat Tangkap </span></a>
                            </li>
                            <li class="">
                                <a href="<?php echo site_url('JumlahAlatTangkap');?>" class="waves-effect"><i class="mdi mdi-invert-colors"></i> <span> Jumlah Alat Tangkap </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="<?php echo site_url('JumlahIkan');?>" class="waves-effect"><i class="mdi mdi-layers"></i><span> Jumlah Ikan </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email"></i><span> SMS Gateway </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="email-inbox.html"> Pesan Masuk</a></li>
                                    <li><a href="email-read.html"> Pesan Terkirim</a></li>
                                    <li><a href="email-compose.html"> Pesan Gagal</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="<?php echo site_url('Peramalan');?>" class="waves-effect"><i class="mdi mdi-chart-arc"></i><span> Peramalan </span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->
            </div>
            <!-- Left Sidebar End -->