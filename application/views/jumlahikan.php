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
                                    <h4 class="page-title">Jumlah Tangkapan Ikan </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Arima</a>
                                        </li>
                                        <li class="active">
                                            Jumlah Tangkapan Ikan
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="card-box">
                               <div class="form-horizontal">
                                 <div class="form-group">
                                    <label for="" class="col-md-1 control-label">Bulan</label>
                                    <div class="col-md-2">
                                       <select name="bulan" id="bulan" class="form-control">
                                         <option value="1">Januari</option>
                                         <option value="2">Februari</option>
                                         <option value="3">Maret</option>
                                         <option value="4">April</option>
                                         <option value="5">Mei</option>
                                         <option value="6">Juni</option>
                                         <option value="7">Juli</option>
                                         <option value="8">Agustus</option>
                                         <option value="9">September</option>
                                         <option value="10">Oktober</option>
                                         <option value="11">Nopember</option>
                                         <option value="12">Desember</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="" class="col-md-1 control-label">Tahun</label>
                                    <div class="col-md-2">
                                       <select name="tahun" id="tahun" class="form-control">
                                         <option value="2014">2014</option>
                                         <option value="2015">2015</option>
                                         <option value="2016">2016</option>
                                         <option value="2017">2017</option>
                                         <option value="2018">2018</option>
                                         <option value="2019">2019</option>
                                         <option value="2020">2020</option>
                                       </select>
                                    </div>
                                    <button onclick="getData()" class="btn btn-primary">Lihat Jumlah</button>
                                 </div>
                               </div>
                               <table class="table table-responsive table-bordered table-condensed">
                                 <thead>
                                   <tr>
                                      <th>No</th>
                                      <th>Nama Ikan</th>
                                      <?php foreach($kecamatan as $kec){
                                        if($kec->IDKecamatan === '4'){?>
                                          <th>Sumawe</th>
                                        <?php
                                        } 
                                        else{
                                           ?>
                                           <th><?php echo $kec->NamaKecamatan;?></th>
                                           <?php
                                        }
                                    }?>
                                   </tr>
                                 </thead>
                                 <tbody></tbody>
                               </table>
                               <div class="notif"></div>
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

        <!-- App js -->
        <script src="<?php echo base_url('assets/js/jquery.core.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.app.js')?>"></script>
        <script>
          $('table').hide();
          getData = () => {
              const bulan = document.querySelector('[name="bulan"]').value;
              const tahun = document.querySelector('[name="tahun"]').value;
              let dataTangkapan = [];
              let tuna=[];
              let cakalang=[];
              let tongkol=[];
              $.ajax({
                  url : "jumlahikan/getData",
                  type : "POST",
                  dataType : "JSON",
                  data :{"bulan" : bulan, "tahun":tahun},
                  success : function(data){
                    
                    if(data.length === 0){
                        $('table').hide();
                        $('tbody').empty();
                        $('.notif').empty();
                        $('.notif').show();
                        $('.notif').append('<h3 style="text-align:center">Tidak Ada Data</h3>');
                    }else{
                        $('table').show();
                        $('.notif').hide();
                        data.forEach(item => {
                       if(item.IDIkan == 1){
                           tuna.push(item.JumlahTangkapanIkan);
                       }else if(item.IDIkan == 3){
                           cakalang.push(item.JumlahTangkapanIkan);
                       }else{
                           tongkol.push(item.JumlahTangkapanIkan);
                       }
                    })
                    dataTangkapan = [tuna, cakalang, tongkol]
                    $('tbody').empty();
                    html = `<tr>
                                   <td>1</td>
                                   <td>Tuna</td>
                                   <td>${tuna[0]}</td>
                                   <td>${tuna[1]}</td>
                                   <td>${tuna[2]}</td>
                                   <td>${tuna[3]}</td>
                                   <td>${tuna[4]}</td>
                                   <td>${tuna[5]}</td>
                                </tr>`;
                   html += `<tr>
                                   <td>2</td>
                                   <td>Cakalang</td> 
                                   <td>${cakalang[0]}</td>
                                   <td>${cakalang[1]}</td>
                                   <td>${cakalang[2]}</td>
                                   <td>${cakalang[3]}</td>
                                   <td>${cakalang[4]}</td>
                                   <td>${cakalang[5]}</td>
                            </tr>`;
                   html += `<tr>
                                   <td>3</td>
                                   <td>Tongkol</td>
                                   <td>${tongkol[0]}</td>
                                   <td>${tongkol[1]}</td>
                                   <td>${tongkol[2]}</td>
                                   <td>${tongkol[3]}</td>
                                   <td>${tongkol[4]}</td>
                                   <td>${tongkol[5]}</td>
                                </tr>`;
                                $('tbody').append(html);
                    }
                    
                  }
                  
              })
          }
        </script>
    </body>
</html>