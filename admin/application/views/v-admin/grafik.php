<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <div class="row">
                        <div class=" col-md-6 input-group input-group-sm" >
                            <label for="hp" class="col-sm-3 col-form-label">Grafik Omset</label>
                            <div class="col-sm-4">
                                <select class=" form-control form-control-sm" id="tahun_omset" name="tahun_omset">
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                        </div>                        
                        <div class=" col-md-6 input-group input-group-sm" >
                            <label for="hp" class="col-sm-3 col-form-label">Grafik Income</label>
                            <div class="col-sm-4">
                                <select class=" form-control form-control-sm" id="tahun_income" name="tahun_income">
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                        </div>                         
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart1">
                                <canvas id="barChart1" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        var areaChartData = {
            labels: <?php echo json_encode($bulan_omset); ?>,
            datasets: [
                {
                    label: 'Omset',
                    backgroundColor: 'rgba(227,200,0,1)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: <?php echo json_encode($omset); ?>
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



        var areaChartData1 = {
            labels: <?php echo json_encode($bulan_omset); ?>,
            datasets: [
                {
                    label: 'Laba',
                    backgroundColor: 'rgba(96, 169, 23, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: <?php echo json_encode($income); ?>
                }
            ]
        };

        var barChartCanvas1 = $('#barChart1').get(0).getContext('2d');
        var barChartData1 = jQuery.extend(true, {}, areaChartData1);
        var temp1 = areaChartData1.datasets[0];
        barChartData1.datasets[0] = temp1;
        var barChartOptions1 = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        };
        var barChart1 = new Chart(barChartCanvas1, {
            type: 'bar',
            data: barChartData1,
            options: barChartOptions1
        });


    });
</script>