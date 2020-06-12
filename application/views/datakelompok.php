<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Data Kelompok Nelayan </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="#">Arima</a>
                                </li>
                                <li class="active">
                                    Kelompok Nelayan
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <form action="" class="form-horizontal">
                               <div class="form-group">
                                  <label for="" class="control-label col-md-1">Nama</label>
                                  <div class="col-md-4">
                                    <input type="text" value="<?php echo $nelayan->NamaKelompok; ?>" name="nama" class="form-control">
                                  </div>
                               </div>
                               <div class="form-group">
                                  <label for="" class="control-label col-md-1">Username</label>
                                  <div class="col-md-4">
                                    <input type="text" value="<?php echo $nelayan->username; ?>" name="nama" class="form-control">
                                  </div>
                               </div>
                               <div class="form-group">
                                  <label for="" class="control-label col-md-1">Kecamatan</label>
                                  <div class="col-md-4">
                                    <select name="kecamatan" id="" class="form-control">
                                       <?php foreach($kecamatan as $k){
                                           ?>
                                           <option <?php if($nelayan->IDKecamatan == $k->IDKecamatan){echo 'selected="selected"';}?> value="<?php echo $k->IDKecamatan;?>"><?php echo $k->NamaKecamatan;?></option>
                                           <?php
                                       }
                                       ?>
                                    </select>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <label for="" class="control-label col-md-1">Desa</label>
                                  <div class="col-md-4">
                                    <select name="desa" id="" class="form-control">
                                       <?php foreach($desa as $d){
                                           ?>
                                           <option <?php if($nelayan->IDDesa == $d->IDDesa){echo 'selected="selected"';}?> value="<?php echo $d->IDDesa;?>"><?php echo $d->NamaDesa;?></option>
                                           <?php
                                       }
                                       ?>
                                    </select>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <label for="" class="control-label col-md-1">No HP</label>
                                  <div class="col-md-4">
                                    <input type="text" value="<?php echo $nelayan->NoHP; ?>" name="nama" class="form-control">
                                  </div>
                               </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <a href="javascript:void(0);" class="right-bar-toggle">
                    <i class="mdi mdi-close-circle-outline"></i>
                </a>
                <h4 class="">Settings</h4>
                <div class="setting-list nicescroll">
                    <div class="row m-t-20">
                        <div class="col-xs-8">
                            <h5 class="m-0">Notifications</h5>
                            <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                        </div>
                        <div class="col-xs-4 text-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
                        </div>
                    </div>

                    <div class="row m-t-20">
                        <div class="col-xs-8">
                            <h5 class="m-0">API Access</h5>
                            <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                        </div>
                        <div class="col-xs-4 text-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
                        </div>
                    </div>

                    <div class="row m-t-20">
                        <div class="col-xs-8">
                            <h5 class="m-0">Auto Updates</h5>
                            <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                        </div>
                        <div class="col-xs-4 text-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
                        </div>
                    </div>

                    <div class="row m-t-20">
                        <div class="col-xs-8">
                            <h5 class="m-0">Online Status</h5>
                            <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                        </div>
                        <div class="col-xs-4 text-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Right-bar -->
        </div>
        <!-- END wrapper -->
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/detect.js')?>"></script>
        <script src="<?php echo base_url('assets/js/fastclick.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.blockUI.js')?>"></script>
        <script src="<?php echo base_url('assets/js/waves.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js')?>"></script>
        <script src="<?php echo base_url('assets/switchery/switchery.min.js')?>"></script>
		<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
		<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

        <!-- App js -->
        <script src="<?php echo base_url('assets/js/jquery.core.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.app.js')?>"></script>
        
    </body>
</html>