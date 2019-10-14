
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

<!-- Datatable CSS -->
<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

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
<h3>Otvorene pozicije</h3>
<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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

<!-- Table -->
<table id='taskovi' class='display dataTable'>

  <thead>
    <tr>
      <th>ID Zadatka</th>
      <th>ID Radnog mesta</th>
      <th>Naziv Radnog Mesta</th>
      <th>Naziv Zadatka</th>
      <th>Opis</th>
    </tr>
  </thead>

</table>

<script type="text/javascript">
$(document).ready(function(){
   $('#taskovi').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
        'url': 'ajaxresponse.php'
      },
      'columns': [
         { data: 'id_task' },
         { data: 'id_radno_mesto' },
         { data: 'naziv_radnog_mesta' },
         { data: 'naziv' },
         { data: 'opis' },
      ]
   });
});
</script>

</div>

</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
<span>Copyright &copy; Andjela Todorovic 2019</span>
</div>
</div>
</footer>
<!-- End of Footer -->
