

<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$kuotapenerimaan;?></h3>

              <p>Kuota Penerimaan</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('prodi'); ?>" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       <!-- ./col -->

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$totalpendaftar;?></h3>

              <p>Pendaftar</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('pendaftar'); ?>" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$totalterima;?></h3>

              <p>Diterima</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('penerimaan'); ?>" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


    <div class="row">
      <div class="col-md-12">
        <!-- Donut chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Peminatan Per Program Studi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id ="mygraph"></div>
            </div>
            <!-- /.box-body-->
          </div>
        </div>
</div>




<!-- jQuery 3 -->
<script src="<?php echo base_url('public/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('public/bower_components/fastclick/lib/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('public/dist/js/adminlte.min.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('public/dist/js/demo.js');?>"></script>
<!-- FLOT CHARTS -->
<script src="<?php echo base_url('public/bower_components/Flot/jquery.flot.js');?>"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url('public/bower_components/Flot/jquery.flot.resize.js');?>"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url('public/bower_components/Flot/jquery.flot.pie.js');?>"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo base_url('public/bower_components/Flot/jquery.flot.categories.js');?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('public/bower_components/chart.js/Chart.js');?>"></script>
<!-- highcharts -->
<script src="<?php echo base_url('public/chart/highcharts.js');?>"></script>
<!-- page script -->
<script>

/* GRAFIK PEMINATAN PER PRODI */
 var chart; 
        $(document).ready(function() {
              chart = new Highcharts.Chart(
              {
                  
                 chart: {
                    renderTo: 'mygraph',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                 },   
                 title: {
                    text: 'Peminatan Per Program Studi '
                 },
                 tooltip: {
                    formatter: function() {
                        return '<b>'+
                        this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' % ';
                    }
                 },
                 
                
                 plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: 'green',
                            formatter: function() 
                            {
                                return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.percentage, 2) +' % ';
                            }
                        }
                    }
                 },
       
                    series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                    <?php
                        foreach($list as $row) {
                          $prodiname = $row->namaprodi;
                          $peminat = $row->peminat;
                          ?>
                            [ 
                                '<?php echo $prodiname ?>', <?php echo $peminat; ?>
                            ],
                            <?php
                        }
                        ?>
             
                    ]
                }]
              });
        }); 
</script>