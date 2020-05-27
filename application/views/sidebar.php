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
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i><span> Jumlah Tangkapan Ikan </span><span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo site_url('JumlahIkan');?>"> Per Kecamatan</a></li>
                                    <li><a href="<?php echo site_url('JumlahAlatTangkap');?>"> Pesan Alat Tangkap</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email"></i><span> SMS Gateway </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo site_url("Sms");?>"> Sms</a></li>
                                    <li><a href="<?php echo site_url("Inbox");?>"> Pesan Masuk</a></li>
                                    <li><a href="<?php echo site_url("Sent");?>"> Pesan Terkirim</a></li>
                                    <li><a href="<?php echo site_url("SentFailed");?>"> Pesan Gagal</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-arc"></i><span> Peramalan </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo site_url('Peramalan');?>"> Kecamatan</a></li>
                                    <li><a href="<?php echo site_url("PeramalanAlatTangkap");?>"> Alat Tangkap</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->
            </div>
            <!-- Left Sidebar End -->