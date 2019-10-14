<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
// include all files //
include_once '../../DAL/Database.php';
$database = new Database();
$db = $database->getConnection();


if(isset($_POST['submit']))
{
    $mail=$_POST['email'];
    $query = "SELECT * FROM radnik WHERE email = :mail";
    $stmt = $db->prepare($query);
    $stmt->execute(array(":mail" => $mail));
    $res= $stmt->fetch(PDO::FETCH_ASSOC);
    #print_r($res);

    #$msg = "Your Password is :'".$otp."'";
    $headers='From:andjellah@icloud.com';
    $to=$res['email'];
    $subject='Remind password';
    //$m = mail($to,$subject,$msg,$headers);
    
    
    if($mail == $realemail){
        
        $sql = "UPDATE admin SET password ='$otp' WHERE email='$mail'";
        $m = mail($to,$subject,$msg,$headers);
        if($m)
        {
            echo'Check your inbox in mail';
        }
        else
        {
            echo'mail is not send';
        }
        // echo $a = "hhh";
        //else
        //{
        //echo'You entered mail id is not present';
        
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

    <title>Forgotten password</title>
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
    <form method="post" label = "Molimo unesite svoj email" >
      <input type="email" id="email" class="fadeIn second" name="email" placeholder="E-mail"><br><span class="error"></span>
      <input type="submit" id="btn" name="submit" class="fadeIn fourth" value="Posalji email">
    </form>
     <div id="formFooter">
      <a class="underlineHover" href="index.html">Vracanje na pocetnu stranu</a>
    </div>
