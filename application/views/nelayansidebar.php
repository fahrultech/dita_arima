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
                                <a href="<?php echo site_url('DataKelompok'); ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Nelayan Kelompok </span></a>
                            </li> 
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-arc"></i><span> Peramalan </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo site_url('PeramalanNelayan/kecamatan');?>"> Kecamatan</a></li>
                                    <li><a href="<?php echo site_url("PeramalanNelayan/alattangkap");?>"> Alat Tangkap</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="<?php echo site_url('nelayandashboard/logout');?>" class="waves-effect"><i class="mdi mdi-logout"></i><span> Logout </span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->
            </div>
            <!-- Left Sidebar End -->