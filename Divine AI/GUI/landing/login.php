<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
// include all files //
include_once '../../DAL/Database.php';
$database = new Database();
$db = $database->getConnection();
//var_dump($db);
$msg = "";
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $lozinka = trim($_POST['password']);
    if($email != "" && $lozinka != "") {
        try {
            $query = "SELECT * FROM radnik WHERE email = :email AND lozinka = :lozinka ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':lozinka', $lozinka);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if($count == 1 && !empty($row)) {
                $rola = $row['id_rola'];
                $username = $row['ime'];
                $id_radnik = $row['id_radnik'];
                if ($rola == 5) {
                    header("Location: ../admin/dash.php");
                    $_SESSION['admin'] = $username;
                    $_SESSION['user'] = $id_radnik;
                    exit();
                } elseif ($rola == 6) {
                    header("Location: ../user/profile.php?id_radnik=$id_radnik");
                    $_SESSION['user'] = $id_radnik;
                    exit();
                }
            }
                    else {
                    $msg = "Invalid username and password!";}
            }
        catch (PDOException $e) {
                echo "Error : ".$e->getMessage();
            }
        }
    else {
            $msg = "Both fields are required!";
        }
    }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/landing.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/4f38721301.js"></script>

    <title>Login Page!</title>
  </head>
  <body>
     <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
        <i class="fas fa-user-tie serviceic"></i>
    </div>

    <!-- Login Form -->
    <form method="post">
      <input type="email" id="email" class="fadeIn second" name="email" placeholder="E-mail"><br><span class="error"></span>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Lozinka"><br><span class="error"></span>
      <input type="submit" id="btn" name="submit" onclick="return loginValidation();" class="fadeIn fourth" value="Ulogujte se">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="index.html">Vracanje na pocetnu stranu</a>
    </div>
    <div id ="formFooter">
      <a class="underlineHover" href="../landing/forgotpassword.php">Zaboravljena lozinka?</a>
    </div>


  </div>
</div>


    <!-- Optional JavaScript -->
    <script src="../js/validation.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
