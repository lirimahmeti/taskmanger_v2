<div>
    
    
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawBasic);

            function drawBasic() {


                var jsonData = JSON.parse(@json($data));
                var data = google.visualization.arrayToDataTable(jsonData);

                var options = {
                    title: 'Punet e perfunduara sot',
                    chartArea: {width: '50%'},
                    hAxis: {
                    title: 'Totali punve',
                    minValue: 0
                    },
                    vAxis: {
                    title: 'Puntori'
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

                chart.draw(data, options);
                }
    </script>
    <div class="shadow my-4">
        <div id="chart_div"></div>
    </div>
</div>