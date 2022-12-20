<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Barang</span>
                    <span class="info-box-number"><?= $jbarang ?></span>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Marketing</span>
                    <span class="info-box-number"><?= $jmarketing ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Customer</span>
                    <span class="info-box-number"><?= $jcustomer ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Suplayer</span>
                    <span class="info-box-number"><?= $jsuplayer ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-7 text-center">
                           <b> Tren Barang Terjual Customer</b>
                        </div>
                        <div class="col-sm-5 text-center">
                           <b> Loyal Customer </b>
                        </div>                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="chart">
                                <br>
                                <canvas id="pieChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
foreach ($loyalcus as $jc) {
    $namacustomer[] = $jc->nama_customer;
    $jmlcustomer[] = $jc->jml;
}
foreach ($trenbarang as $jb) {
    $namabarang[] = substr($jb->nama_barang,0,10).'...';
    $jmlbarang[] = $jb->jml;
}
?>
<script>
    $(function () {
        var areaChartData = {
            labels: <?php echo json_encode($namabarang); ?>,
            datasets: [
                {
                    label: 'Barang',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: <?php echo json_encode($jmlbarang); ?>
                }
            ]
        };
        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var barChartData = jQuery.extend(true, {}, areaChartData);
        var temp0 = areaChartData.datasets[0];
        barChartData.datasets[0] = temp0;
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        };
        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });
        // var loyalcustomer = {
        //     labels: <?php echo json_encode($namacustomer); ?>,
        //     datasets: [
        //         {
        //             data: <?php echo json_encode($jmlcustomer); ?>,
        //             backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
        //         }
        //     ]
        // };
        
        // var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        // var pieData = loyalcustomer;
        // var pieOptions = {
        //     maintainAspectRatio: false,
        //     responsive: true
        // };
        // var pieChart = new Chart(pieChartCanvas, {
        //     type: 'pie',
        //     data: pieData,
        //     options: pieOptions
        // });
    });

    $(function () {
        // var areaChartData = {
        //     labels: <?php echo json_encode($namabarang); ?>,
        //     datasets: [
        //         {
        //             label: 'Barang',
        //             backgroundColor: 'rgba(60,141,188,0.9)',
        //             borderColor: 'rgba(60,141,188,0.8)',
        //             pointRadius: false,
        //             pointColor: '#3b8bba',
        //             pointStrokeColor: 'rgba(60,141,188,1)',
        //             pointHighlightFill: '#fff',
        //             pointHighlightStroke: 'rgba(60,141,188,1)',
        //             data: <?php echo json_encode($jmlbarang); ?>
        //         }
        //     ]
        // };
        // var barChartCanvas = $('#barChart').get(0).getContext('2d');
        // var barChartData = jQuery.extend(true, {}, areaChartData);
        // var temp0 = areaChartData.datasets[0];
        // barChartData.datasets[0] = temp0;
        // var barChartOptions = {
        //     responsive: true,
        //     maintainAspectRatio: false,
        //     datasetFill: false
        // };
        // var barChart = new Chart(barChartCanvas, {
        //     type: 'bar',
        //     data: barChartData,
        //     options: barChartOptions
        // });
        var loyalcustomer = {
            labels: <?php echo json_encode($namacustomer); ?>,
            datasets: [
                {
                    data: <?php echo json_encode($jmlcustomer); ?>,
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
                }
            ]
        };
        
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieData = loyalcustomer;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true
        };
        var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });
    });
</script>