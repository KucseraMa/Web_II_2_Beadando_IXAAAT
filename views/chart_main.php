<?php 
var_dump($viewData['data']);

foreach ($viewData['data']as $key => $value) {
   echo $telepules = $value['Telepules']. ',';
}

?>

<div class="chart">
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <?php  ?>
<script>
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Hosszú cső', 'Rövid cső', 'Görbe cső', 'Cső kulcs', 'Bakancs',],
      datasets: [{
        label: '# Anyag darab',
        data: [10, 10, 31, 3, 20],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
