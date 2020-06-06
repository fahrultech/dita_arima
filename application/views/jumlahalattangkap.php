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
                                   
                                </select>
                            </div>
                            <button onclick="getData()" class="btn btn-primary">Lihat Jumlah</button>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Alat Tangkap</th>
                                <th>Tuna</th>
                                <th>Cakalang</th>
                                <th>Tongkol</th>
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
        const d = new Date();
        const n = d.getFullYear();
        let optYear;
        for(let i=2014;i<=n+1;i++){
            optYear += `<option value=${i}>${i}</option>`
        }
        document.querySelector('select[name="tahun"]').innerHTML = optYear;
        $('table').hide();
        getData = () => {
            const bulan = document.querySelector('[name="bulan"]').value;
            const tahun = document.querySelector('[name="tahun"]').value;
            var dataAlat = [];
            let idAlatTangkap =[];
            let namaAlatTangkap = [];
            let html='';
            let dit;
            $.ajax({
                url : "jumlahalattangkap/getData",
                type : "POST",
                dataType : "JSON",
                data :{"bulan" : bulan, "tahun":tahun},
                success : function(data){
                  $('table').show();
                  $('tbody').empty();
                  for(let i=0;i<data.length;i++){
                     idAlatTangkap.push(data[i].IDAlatTangkap);
                     namaAlatTangkap.push(data[i].NamaAlatTangkap);
                  }
                  namaAlatTangkap = [...new Set(namaAlatTangkap)]
                  idAlatTangkap = [...new Set(idAlatTangkap)]
                  for(let i=0;i<idAlatTangkap.length;i++){
                      let no=0;
                      dataAlat[i]=[]
                      for(let j=0;j<data.length;j++){
                          if(data[j].IDAlatTangkap === idAlatTangkap[i]){
                              dataAlat[i][no]=data[j].JumlahTangkapan
                              no++;
                          }
                      }
                  }
                  console.log(dataAlat)
                  let n=1;
                  for(let i=0;i<dataAlat.length;i++){
                      html += `<tr>
                                 <td>${n}</td>
                                 <td>${namaAlatTangkap[i]}</td>
                                 `
                                 for(let j=0;j<dataAlat[i].length;j++){
                                     html += `<td>${dataAlat[i][j]}</td>`
                                 }
                              html += `</tr>`;
                    n++;
                  }
                  $('tbody').append(html);
                }   
            });
        }
    </script>
</body>
</html>