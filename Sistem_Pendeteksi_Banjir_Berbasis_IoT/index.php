<!doctype html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- Required meta tags -->
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/highcharts.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetch("grafik.php").then(data => data.json()).then(res => {
        const id = res.id;
        const ultra = res.ultra;
        const flow = res.flow;

        var myChart = Highcharts.chart('grafik', {
          chart: {
            type: 'line',
            height: (11 / 16 * 100) + '%'
          },
          title: {
            text: 'Ultrasonik Sensor'
          },
          xAxis: {
            categories: id
          },
          yAxis: {
            title: {
              text: 'Ketinggian (cm)'
            }
          },
          colors: ["red"],
          series: [{
            name: 'Ultrasonik',
            data: ultra
          }]
        });

        var myChart = Highcharts.chart('grafik2', {
          chart: {
            type: 'line',
            height: (11 / 16 * 100) + '%'
          },
          title: {
            text: 'Waterflow Sensor'
          },
          xAxis: {
            categories: id
          },
          yAxis: {
            title: {
              text: 'Debit Air (Liter/jam)'
            }
          },
          colors: ["black"],
          series: [{
            name: 'Flow Air',
            data: flow
          }]
        });
      }).catch(error => {
        console.log(error);
      });
    });
  </script>
  <title>Sistem Pendeteksi Banjir Berbasis IoT</title>
</head>

<body>
  <?php
  include "conn.php";
  $sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData";
  ?>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <!-- <img src="/docs/4.4/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
        PT. Cipta Citra Kodena
      </a>
    </div>
  </nav>

  <div class="container mt-3">
  <div class="row">
    <div class="col-sm-12">
    <h2 class="text-center my-4">Prototype Sistem Pendeteksi Banjir Berbasis IoT</h2>
    </div>
    <div class="col-sm-6">
    <div class="card shadow">
      <div class="card-body">
        <div id="grafik"></div>
      </div>
    </div>
    </div>
    <div class="col-sm-6">
    <div class="card shadow">
      <div class="card-body">
        <div id="grafik2"></div>
      </div>
    </div>
    </div>
  </div>

    <div class="card shadow mt-4">
      <div class="card-body">
        <table class="table" id="sensorTable">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Ultrasonik</th>
              <th scope="col">FLow Air</th>
              <th scope="col">Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result = $conn->query($sql)) {
              while ($row = $result->fetch_assoc()) {
            ?>
            
            <?php
                if ($row ["value1"] >= 150 || $row ["value2"] >= 150 ) {
                    echo "<tr class = 'warning'>";
                } else {
                    echo "<tr>";
                }
            ?>
                  <td> <?= $row["id"] ?> </td>
                  <td> <?= $row["value1"] ?> </td>
                  <td> <?= $row["value2"] ?> </td>
                  <td> <?= $row["reading_time"] ?> </td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#sensorTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        "order": [[0, "desc"]]
      });
    });
    // setTimeout(function() {
    //   location.reload();
    // }, 2000);
  </script>
</body>

</html>