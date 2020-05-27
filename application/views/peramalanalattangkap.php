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
                                    <h4 class="page-title">Peramalan Per AlatTangkap </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Arima</a>
                                        </li>
                                        <li class="active">
                                            <a href="#">Peramalan </a>
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                  <div class="row">
                                    <div class="col-lg-4">
                                      <label for="" class="control-label">Jenis Ikan</label>
                                      <select name="jenisikan" id="" class="form-control">
                                            <option value="0">--Pilih Jenis Ikan --</option>
                                        <?php foreach($jenisikan as $ji){
                                           ?><option value="<?php echo $ji->IDIkan; ?>"><?php echo $ji->NamaIkan; ?></option>
                                        <?php
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="col-lg-4">
                                      <label for="" class="control-label">Alat Tangkap</label>
                                      <select name="alattangkap" id="" class="form-control">
                                             <option value="0">--Pilih Alat Tangkap --</option>
                                      <?php foreach($alattangkap as $at){
                                           ?><option value="<?php echo $at->IDAlatTangkap; ?>"><?php echo $at->NamaAlatTangkap; ?></option>
                                        <?php
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div style="margin-top:2%" class="col-lg-2">
                                      <button onClick="getData()" class="btn btn-success" type="button">Pilih</button>
                                    </div>
                                  </div>
                                  <!-- <div style="margin-top:20px" class="row">
                                    <h3>Data Training</h3>
                                    <div class="col-lg-4">
                                        <label for="" class="control-label">Awal</label>
                                        <select name="awal" id="" class="form-control">
                                                <option value="0">--Pilih Tahun Awal --</option>
                                                <option value="2014">2014</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="" class="control-label">Akhir</label>
                                        <select name="akhir" id="" class="form-control">
                                                <option value="0">--Pilih Tahun Akhir --</option>
                                                <option value="2014">2014</option>
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                        </select>
                                    </div>
                                  </div> -->
                                  
                                  <div class="row">
                                    <div class="col-lg-12">
                                       <h3 style="margin-top:30px" class="text-center dlabel">All Data</h3>   
                                       <div id="kurva-all">
                                              
                                       </div>
                                    </div>
                                  </div>
                                  <div class="row m-t-6">
                                    <div class="col-lg-6 col-md-6">
                                       <h4 class="header-title m-t-3 text-center dlabel">ACF Plot</h4>
                                       <div id="acf" class="ct-chart ct-golden-section">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                       <h4 class="header-title m-t-3 text-center dlabel">PACF Plot</h4>
                                       <div id="pacf" class="ct-chart ct-golden-section">
                                       </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                       <h3 class="m-t-3 text-center dlabel">SARIMA Uji Prediksi</h3>
                                       <div id="prediksi" class="ct-chart ct-golden-section">
                                         
                                       </div>
                                    </div>
                                  </div>
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
        <!-- Google Charts js -->
	    <script src="<?php echo base_url('assets/js/googlechart.js')?>"></script>
        <script src="<?php echo base_url('assets/chartist/js/chartist.min.js');?>"></script>
        <script src="<?php echo base_url('assets/chartist/js/chartist-plugin-tooltip.min.js');?>"></script>
        <!-- Init -->
        <script>
          let idikan;
          let idkecamatan;
          let tahunawal;
          let tahunakhir;
          let chartData = [];
          const bulan = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nop","Des"];
          document.querySelector('[name="alattangkap"]').addEventListener('change', function(){
              idalattangkap = this.value;
              console.log(idalattangkap);
          });
          document.querySelector('[name="jenisikan"]').addEventListener('change', function(){
              idikan = this.value;
              console.log(idikan);
          });
          let getData = () => {
                data = {
                    "jenisikan" : idikan,
                    "alattangkap" : idalattangkap,
                }

                $.ajax({
                    "url" : "<?php echo site_url('PeramalanAlatTangkap/getdata'); ?>",
                    "type" : "POST",
                    "data" : data,
                    "dataType" : "JSON",
                    "success" : function(data){
                        if(data[0].length === 0){
                            $('#kurva-all').empty();
                            $('#prediksi').empty();
                            $('#acf').empty();
                            $('#pacf').empty();
                            document.querySelectorAll('.dlabel').forEach(item => {
                                item.style.display = "none";
                            })
                            document.getElementById('kurva-all').innerHTML = '<h2 class="text-center">Data Kosong Atau Tidak Mencukupi</h2>';
                        }else{

                        document.querySelectorAll('.dlabel').forEach(item => {
                            item.style.display = "block";
                        })
                        $('#kurva-all').empty();
                        chartData = [];
                        chartDataPrediksi = [];
                        chartACF = [];
                        chartPACF = [];
                        numOfLags = [];
                        let prediksi = [];
                        chartData.push(["Bulan Tahun", "Jumlah" ]);
                        console.log(data);
                        data[0].forEach(item => {
                           let tempData = [];
                           tempData.push(`${bulan[parseInt(item.Bulan)-1]} - ${item.Tahun}`);
                           tempData.push(parseFloat(item.JumlahTangkapan));
                           chartData.push(tempData);
                        })
                        for(let i=12;i<data[5].length;i++){
                           let tempData = [];
                           tempData.push(`${bulan[parseInt(data[5][i].Bulan)-1]} - ${data[5][i].Tahun}`);
                           tempData.push(parseFloat(data[5][i].JumlahTangkapan));
                           chartDataPrediksi.push(tempData);
                        }
                        let n = 1;
                        data[1].forEach(item => {
                            chartACF.push(parseFloat(item));
                            numOfLags.push(n);
                            n++;
                        });
                        data[3].forEach(item => {
                            chartPACF.push(parseFloat(item));
                        });
                        var datai = {
                            labels: numOfLags,
                            series: [chartACF]
                        };
                        let dataj = {
                            labels: numOfLags,
                            series: [chartPACF]
                        }
                        prediksi.push(["Bulan Tahun","Real","Prediksi"]);
                        chartDataPrediksi.forEach((item,index) => {
                            if(index > 0 && index<data[2].length){
                                let tmp = [];
                            tmp.push(item[0])
                            tmp.push(item[1])
                            tmp.push(data[2][index][1]);
                            prediksi.push(tmp)
                            }
                            
                        })
                        console.log(prediksi)
                        google.setOnLoadCallback(function() {createLineChart($('#kurva-all')[0], chartData, 'Jumlah Tangkapan Ikan', ['#4bd396'])});
                        google.setOnLoadCallback(function() {createLineChart($('#prediksi')[0], prediksi, 'Prediksi Tangkapan Ikan', ['#4bd396','#ff0000'])});
                        new Chartist.Bar('#acf',datai , options);
                        new Chartist.Bar('#pacf',dataj , options);
                        //google.setOnLoadCallback(function() {createColumnChart($('#acf')[0], chartACF, 'Plot ACF', ['#4bd396', '#f5707a', '#3ac9d6'])});
                    }
                 }
                })
          }
          google.charts.load('current', {packages: ['corechart']});
    
          function createLineChart(selector, data, axislabel, colors) {
                var options = {
                fontName: 'Hind Madurai',
                height: 260,
                //curveType: 'function',
                fontSize: 14,
                chartArea: {
                    left: '10%',
                    width: '90%',
                    bottom : '20%',
                    height: 160
                },
                pointSize: 4,
                tooltip: {
                    textStyle: {
                        fontName: 'Hind Madurai',
                        fontSize: 14
                    },
                    format : 'none'
                },
                vAxis: {
                    title: axislabel,
                    titleTextStyle: {
                        fontSize: 14,
                        italic: false
                    },
                    gridlines:{
                        color: '#f5f5f5',
                        count: 10
                    },
                    minValue: 0,
                    format: 'decimal'
                },
                hAxis :{
                    textStyle : {
                        fontSize : 10
                    },
                    slantedText : true,
                    slantedTextAngle : 70
                },
                legend: {
                    position: 'top',
                    alignment: 'center',
                    textStyle: {
                        fontSize: 14
                    }
                },
                lineWidth: 3,
                colors: colors
            };

                var google_chart_data = google.visualization.arrayToDataTable(data);
                var line_chart = new google.visualization.LineChart(selector);
                line_chart.draw(google_chart_data, options);
                return line_chart;
            }
            function createColumnChart(selector, data, axislabel, colors) {
                var options = {
                    fontName: 'Hind Madurai',
                    height: 400,
                    fontSize: 13,
                    showArea: true,
                    chartArea: {
                        left: '5%',
                        width: '90%',
                        height: 350
                    },
                    tooltip: {
                        textStyle: {
                            fontName: 'Hind Madurai',
                            fontSize: 14
                        }
                    },
                    vAxis: {
                        title: axislabel,
                        titleTextStyle: {
                            fontSize: 14,
                            italic: false
                        },
                        gridlines:{
                            color: '#f5f5f5',
                            count: 10
                        },
                        minValue: 0
                    },
                    legend: {
                        position: 'top',
                        alignment: 'center',
                        textStyle: {
                            fontSize: 13
                        }
                    },
                    colors: colors
                };

                var google_chart_data = google.visualization.arrayToDataTable(data);
                var column_chart = new google.visualization.ColumnChart(selector);
                column_chart.draw(google_chart_data, options);
                return column_chart;
            }

            var options = {
                high: 1,
                low: -1,
                axisX: {
                    labelInterpolationFnc: function(value, index) {
                    return index % 2 === 0 ? value : null;
                    },
                    fontSize : 6
                },
                plugins: [
                    Chartist.plugins.tooltip()
                ]
            };
            $(window).on('resize', function(){
                createLineChart($('#kurva-all')[0], chartData, 'Jumlah Tangkapan Ikan', ['#4bd396'])
            })
        </script>
    </body>
</html>