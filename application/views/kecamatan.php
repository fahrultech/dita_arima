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
                                    <h4 class="page-title">Kecamatan </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Arima</a>
                                        </li>
                                        <li class="active">
                                            Kecamatan
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                  <button onClick="tambahKecamatan()" type="button" class="btn btn-sm btn-success waves-effect w-md waves-light m-b-5">
                                    <i class="mdi mdi-plus-circle-outline"></i>Tambah
                                  </button>
                                  <table class="table table-bordered table-striped table-condensed" id="mytable">
				                   <thead>
					                 <tr>
						               <th width="80px">No</th>
						               <th>Nama Kecamatan</th>
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
        <div id="modalKecamatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                                                </div>
                                                <div class="modal-body form">
                                                <form action="" class="form-horizontal">
                                                    <div class="form-group">
                                                        <input type="text" name="idkecamatan" hidden>
                                                        <label class="control-label col-md-3" for="">Nama Kecamatan</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="namakecamatan">
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                    <button onClick="save()" type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                                </div>
                                            
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
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
        <script type="text/javascript">
            let table, save_method;
            let url;
            save = () => {
                if(save_method == 'add'){
                    url = 'Kecamatan/tambahKecamatan'
                }else{
                    url = 'Kecamatan/updateKecamatan'
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('form').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        if(data.status){
                            $('#modalKecamatan').modal('hide');
                            table.ajax.reload();
                        }
                    }
                })
            }
            tambahKecamatan = () => {
               save_method = 'add';
               $('.modal-title').text('Tambah Kecamatan');
               $('form')[0].reset();
               
               $('#modalKecamatan').modal('show');         
               $('input[name="namakecamatan"]').focus();
            }
            editKecamatan = (id) => {
                save_method = 'edit';
                $('form')[0].reset();
                $.ajax({
                    url : `Kecamatan/editKecamatan/${id}`,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data){
                        $('[name="idkecamatan"]').val(data.IDKecamatan);
                        $('[name="namakecamatan"]').val(data.NamaKecamatan);
                        $('#modalKecamatan').modal('show');
                    }
                })
            }
            hapusKecamatan = (id) => {
                if(confirm("Apakah Anda Yakin Akan Menghapus Data Ini")){
                    $.ajax({
                    url : `Kecamatan/hapusKecamatan/${id}`,
                    type: "POST",
                    dataType: "JSON",
                    success : function(data){
                        if(data.status){
                            table.ajax.reload();
                        }
                    }
                  })
                }
            }
            $(document).ready(function(){
                table = $('#mytable').DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order" : [],
                    "ajax" :{
                        "url" : "<?php echo site_url('Kecamatan/ajax_list');?>",
                        "type" : "POST"
                    },
                    "columnDefs": [{
                        "targets": [ -1 ],
                        "orderable": false
                    },],
                });
            });		
		</script>
    </body>
</html>