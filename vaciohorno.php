<?php
$conn = mysqli_connect('localhost','root','','vitromexti');
if(mysqli_connect_errno()){
    echo "Falló".mysqli_connect_error();
}
$conn->set_charset("utf8");
$select= "SELECT * FROM tiempovacio WHERE año = 2018";
$result = mysqli_query($conn,$select);
$metas =array();

while($des= mysqli_fetch_assoc($result)){
 $metas[]="['".$des['mes']."',". $des['metas_establecidas'].",".$des['metas_finales']."],";
}
$sql2 = "SELECT*FROM record";
    $results2 = $conn->query($sql2);
    
    if ($results2->num_rows > 0) {
      // output data of each row
      while($row2 = $results2->fetch_assoc()) {
       $dias= $row2["diasTranscurridos"];
       $record= $row2["record"];
      }
    } else {
      echo "0 results";
    } 
    

$sql = "SELECT tiempo FROM tiempotablas";
$results = $conn->query($sql);

if ($results->num_rows > 0) {
  // output data of each row
  while($row = $results->fetch_assoc()) {
   $tiempo= $row["tiempo"];
  }
} else {
  echo "0 results";
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistema de indicadores</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/estiloss.css">
  </head>
  <body>
  <header class="hero">
        <nav class="nav container">
            <h3 class="nav__logo">Sistema para la administración de indicadores</h3>
        </nav>  
  </header>
<!-- partial -->
    <div class="container-scroller"> <!-- Scroller -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">

                <div class="col-sm-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body mb-3">
                            <h5 class="card-title text-center">Record de accidentes</h5>
                            <div class="text-center border-md-0">
                                <h1>Días sin accindentes</h1>
                                <h1 class="text-dark font-weight-bold mb-md-3"><?php echo $dias; ?></h1>
                            </div>
                            <div class="text-center  border-md-0">
                                <h1>Record de días sin accidentes</h1>
                                <h1 class="text-dark font-weight-bold mb-md-3"><?php echo $record; ?></h1>
                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9  grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body mb-8">
                          <div id="chart_div3"></div>  
                      </div>
                    </div>
                </div><!-- col-sm-8  grid-margin stretch-card -->
                

            </div><!-- row -->
          </div><!--content-wrapper-->
          <br><br><br><br><br><br><br><br><br>
        </div><!-- Main Panel -->
      </div>
    </div> <!-- Scroller FIN -->

    <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Vitromex</span>
              </div>
            </div>
    </footer>
      


    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Meses', 'Meta', 'Actual'],
            <?php
            foreach($metas as $metas){
                echo $metas;
            }
            ?>

        //   ['Enero', 1000, 400],
        //   ['Febrero', 1170, 460],
        //   ['Marzo', 660, 1120],
        //   ['Abril', 1030, 540],
        //   ['Mayo', 660, 1120],
        //   ['Junio', 1030, 540],
        //   ['Julio', 660, 1120],
        //   ['Agosto', 1030, 540]

        ]);

        var options = {
          chart: {
            title: 'Tiempo de vacío del horno (hr/dia)',
            // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 400,
          colors: ['#F4C443', '#4AA516']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div3'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      <?php
         //}
        ?>
    </script>
    
    <script>
  setTimeout("location.href='consumogas.php?tiempo=<?php echo $tiempo;?>'",<?php echo $tiempo*1000;?>);
</script>
  </body>
</html>