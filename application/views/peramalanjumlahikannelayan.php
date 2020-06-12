<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
 .borderless, .borderless td, .borderless th{
     border: none;
 }
</style>
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
                            <h4 class="page-title">Peramalan PerKecamatan </h4>
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
                                    <option value="">--Pilih Jenis Ikan --</option>
                                <?php foreach($jenisikan as $ji){
                                    ?><option value="<?php echo $ji->IDIkan; ?>"><?php echo $ji->NamaIkan; ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="" class="control-label">Periode Prediksi</label>
                                <select name="periode" id="" class="form-control">
                                        <option value="">--Pilih Periode --</option>
                                        <option value="1">1 Bulan</option>
                                        <option value="2">2 Bulan</option>
                                        <option value="3">3 Bulan</option>
                                        <option value="4">4 Bulan</option>
                                        <option value="5">5 Bulan</option>
                                        <option value="6">6 Bulan</option>
                                        <option value="7">7 Bulan</option>
                                        <option value="8">8 Bulan</option>
                                        <option value="9">9 Bulan</option>
                                        <option value="10">10 Bulan</option>
                                        <option value="11">11 Bulan</option>
                                        <option value="12">12 Bulan</option>
                                </select>
                            </div>
                            <div style="margin-top:2%" class="col-lg-2">
                                <button onClick="getData()" class="btn btn-success" type="button">Pilih</button>
                            </div>
                            </div>
                            
                            <div style="margin-top:50px" class="row">
                            <div class="col-lg-12 col-md-12">
                                <h3 class="m-t-3 text-center dlabel">Prediksi Produksi Ikan</h3>
                                <div id="predict">
                                    
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                              <div class="alert alert-info">
                                 <p>Hasil Ramalan Produksi Ikan</p>
                                 <div class="isi">
                                    <table class="table borderless">
                                     <thead>
                                       <tr>
                                         <th>Bulan - Tahun</th>
                                         <th>Jumlah</th>
                                       </tr>
                                     </thead>
                                     <tbody></tbody>
                                    </table>
                                 </div>
                                 <div class="mape">
                                   <p>Nilai Error Mape : <span class="hasilmape"></span>%</p>
                                 </div>
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
          let idikan ="";
          let idkecamatan="";
          let periode="";
          let chartData = [];
          const bulan = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nop","Des"];
          document.querySelector('[name="jenisikan"]').addEventListener('change', function(){
              idikan = this.value;
          });
          document.querySelector('[name="periode"]').addEventListener('change', function(){
              periode = this.value;
          });
          let getData = () => {
                if(idikan === "" || periode === ""){
                    alert("Pilih Jenis Ikan Dan Periode Prediksi");
                }else{
                data = {
                    "jenisikan" : idikan,
                    "kecamatan" : <?php echo $kecamatan->IDKecamatan;?>,
                    "periode" : 12
                }
                $.ajax({
                    "url" : "<?php echo site_url('Peramalan/getdata'); ?>",
                    "type" : "POST",
                    "data" : data,
                    "dataType" : "JSON",
                    "success" : function(data){
                        const bulan = new Date().getMonth()+1;
                        document.querySelectorAll('.dlabel').forEach(item => {
                            item.style.display = "block";
                        })
                        $('#kurva-all').empty();
                        let predict = [];
                        predict.push(["Bulan Tahun","Prediksi"]);
                        console.log(parseInt(periode)+bulan)
                        let str = "";
                        for(let i=bulan;i<parseInt(periode)+bulan;i++){
                            let tmp = [];
                            str += `<tr>
                                         <td>${data[8][i][0]}</td>
                                         <td>${parseFloat(data[8][i][1]).toFixed(2)}</td>
                                    </tr>`
                            tmp.push(data[8][i][0]);
                            tmp.push(data[8][i][1]);
                            predict.push(tmp);
                        }
                        document.querySelector('.isi tbody').innerHTML = str;
                        document.querySelector('.hasilmape').innerHTML = data[9];
                        google.setOnLoadCallback(function() {createLineChart($('#predict')[0], predict, 'Prediksi Tangkapan Ikan', ['#4bd396'])});
                    }
                })
            }
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
            $(window).on('resize', function(){
                createLineChart($('#kurva-all')[0], chartData, 'Jumlah Tangkapan Ikan', ['#4bd396'])
            })
        </script>
    </body>
</html>