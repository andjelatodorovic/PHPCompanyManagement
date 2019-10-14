<?php 
session_start();
// include all files //
include_once '../../BL/Redirect.php';
include_once '../../DAL/Database.php';
include_once '../../BL/Profile.php';
include_once '../../BL/WorkPlace.php';
//------------------//
$perm = new Redirect(); 
$perm->redirectAdmin();

$database = new Database();
$db = $database->getConnection();

$work = new WorkPlace($db);
$profile = new Profile($db);

$profile->id_radnik = $_SESSION['user'];

$profile->readProfile();

$stmtwork = $work->sumWork();
$row = $stmtwork->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['logout'])) {
  $perm->logoutUser();
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Izvestaji</title>

  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/dash-bs.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/color.css">

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/4f38721301.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

   <!-- sidebar include  -->
   <?php include_once '../../INCLUDES/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          

          <!-- Topbar Search -->
        <h3>Mesečni i godišnji izveštaji </h3>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

           

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $profile->ime . " " . $profile->prezime ?></span>
                <img class="img-profile rounded-circle" src="<?php echo $profile->slika ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../user/profile.php?id_radnik=<?php echo $profile->id_radnik ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pregled</h1>
           
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Iznos isplaćen zaposlenima (Mesečno)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                      echo $profile->sumPaidWorkers();
                       ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Neisplaćen iznos i dugovanja </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                      echo $profile->sumUnpaidWorkers();
                       ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Broj zaposlenih</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $profile->employees(); ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Broj radnih mesta </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                  echo $row['Mesta'];
                       ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>
          </div>

            
          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Neisplaćeni radnici</h6>
                </div>
                
                <!-- table Body -->
               <table class="table table-hover" id="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ime</th>
      <th scope="col">Plata</th>
      <th scope="col">Profil</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $i = 0; 
      $stmt = $profile->unpaidTable();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {      
    $i++;           
      ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $row['ime'] . " " . $row['prezime'] ?></td>
      <td><?php echo $row['plata'] ?></td>
      <td><button class="btn btn-secondary"><a class="text-white" href="../user/profile.php?id_radnik=<?php echo $row['id_radnik'] ?>">Poseti profil</a></button> </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Izveštaj zarada</h6>
                  
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div id="mypie">
                    <!-- statistics pie -->
                  </div>
                </div>
              </div>
            </div>
          </div>
                <div class = "row">
                    <button class="btn btn-secondary" onclick="printPage()">  Odstampaj ovu stranicu</button>
     <br> ⠀⠀ </br>
            <button class="btn btn-secondary" onclick="exportTableToExcel('table')"> Preuzmi tabelu kao XLS</button>
    </div>


    <script>
    function printPage() {
    window.print();
    }


    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    filename = filename?filename+'.xls':'excel_data.xls';
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
                            type: dataType
                            });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
    </script>
        

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Anđela Todorović 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Odjavite se</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Kliknite na dugme Odjavi se ako zelite da se odjavite.</div>
        <div class="modal-footer">
          <form method="post">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" value="Logout" name="logout">
        </form>
          
        </div>
      </div>
    </div>
  </div>
    <!-- ucitava statistiku -->
    <!-- pita -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Status plate', 'Count'],
          ['Isplaćene',     <?php echo $profile->paidWorkers();  ?>],
          ['Neisplaćene',    <?php echo $profile->unpaidWorkers();  ?>]
        ]);
      
        var options = {
          legend: 'bottom',
          width: '600',
          height: '300',
          backgroundColor: 'none',
          chartArea:{right:300,top:0,width:'60%',height:'70%'},
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('mypie'));
        chart.draw(data, options);
      }
</script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



</body>

</html>
