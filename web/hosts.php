<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="@dyl_up">

    <title>File Miner - Hosts</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <div class="container">
        <a class="navbar-brand" href="./index.html">File Miner</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Hosts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./settings.php">Settings</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section>
        <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-2">
            <div class="p-5">
            </div>
          </div>
          <div class="col-lg-6 order-lg-1">
            <div class="p-5">
              <br/>
              <h2 class="display-4">Hosts</h2>
              <?php 
                $servername = "localhost";
                $username = "fm";
                $password = "Password123!";
                $dbname = "file_miner";

                // create connection to MySQL
                $connection = new mysqli($servername, $username, $password, $dbname);

                // check connection
                if ($connection->connect_error) {
                  die("connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM hosts;";
                $qRes = $connection->query($sql);

                
                // print a table from the data from MySQL
                // each row will include host ID, IP, and number of recovered files
                if ($qRes->num_rows > 0) {

                  echo "<table border='1'>";
                  echo "<tr>";
                  echo "<th>Host ID</th>";
                  echo "<th>IP Address</th>";
                  echo "<th>Files</th>";
                  echo "<tr>";

                  while ($row = $qRes->fetch_assoc()) {
                    $hostID = $row["id"];
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . long2ip($row["ip"]) . "</td>";
                    // get the number of files for the host
                    $sql = "SELECT * FROM files WHERE id='$hostID';";
                    $q2res = $connection->query($sql);
                    if ($q2res->num_rows == 0) {
                      $num = 0;
                    }
                    else {
                      $num = $q2res->num_rows;
                    }
                    echo "<td>" . "<a href=./files.php?id=" . $row["id"] . ">". $num . "</a>" . "</td>";
                    echo "</tr>";
                  }
                }
                echo "</table>";
                $connection->close();
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-black">
      <div class="container">
        <p class="m-0 text-center text-white small">CSC-842</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
