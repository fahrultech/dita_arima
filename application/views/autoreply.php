<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>setInterval('autoRefresh()', 10000);</script>
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
                                    <h4 class="page-title">AutoReply </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Arima</a>
                                        </li>
                                        <li class="active">
                                            AutoReply
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                  <table class="table table-bordered table-striped table-condensed" id="mytable">
				                   <thead>
					                 <tr>
						               <th width="80px">No</th>
						               <th>Nama Desa</th>
						              <th width="200px">Action</th>
					                </tr>
				                  </thead>
			                      </table>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>
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
        <script>
         $.ajax({
             url : "AutoReply/getInbox",
             type : "GET",
             dataType : "JSON",
             success : function(data){
                 console.log(data)
             }
         })
         function autoRefresh()
{
   window.location.reload();
}
        </script>
    </body>
</html>