<?php
    error_reporting(-1);
    ini_set('display_errors', 'On');
    set_error_handler("var_dump");
session_start();
// include all files //
include_once '../../DAL/Database.php';
$database = new Database();
$db = $database->getConnection();


if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $query = "SELECT * FROM radnik WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->execute(array(":email" => $email));
    $res= $stmt->fetch(PDO::FETCH_ASSOC);
    #print_r($res);
    $count = $stmt->rowCount();
    
    if($count == 1 && !empty($res)){
        
        $to=$res['email'];
        $token=rand();
        
        $query1 = "INSERT INTO token (token,email) VALUES (:token, :email)";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute(array(":token" => $token,":email" => $email));
        $count1 = $stmt1->rowCount();
        
        
        $subject='Password Recovery';
        $from  = 'andjellah@icloud.com';
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = '<html><body>';
        $message .= '<span style="color:Red;font-size:18px;"> Resetujte lozinku</span> ';
        $message .= '<table rules="all" border=1 style="border-color: green;" cellpadding="10" align="center">';
        $message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($res['email']) . "</td></tr>";
        $message .= "<tr><td><strong>Token:</strong> </td><td>" . "$token'" . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        $m=mail($to,$subject,$message,$headers);
        var_dump($m);
        if($m)
        {
            $msg='Check your mail inbox for Reset password ';
        }
        else
        {
            $msg='Email not found please signup now!!';
        }
    }
    else
    {
        $msg='Invalid Email';
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
