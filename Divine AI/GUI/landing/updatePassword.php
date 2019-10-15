<?php 
 session_start();
include_once '../../DAL/Database.php';
$database = new Database();
$db = $database->getConnection();

$pass=$_POST['password'];

$ssemail = $_SESSION['email'];

$sstoken = $_SESSION['token'];
$query1="UPDATE radnik SET lozinka =:pass WHERE email = '".$ssemail."'"; 

 		$stmt1 = $db->prepare($query1);
    	$stmt1->execute(array(":pass" => $pass)); 
    	$r = $stmt1->rowCount;
    	echo $r;
    	if ($stmt1){
    	$query2="UPDATE token SET status = 1 WHERE token=:token";  
 		$stmt2 = $db->prepare($query2);
    	$stmt2->execute(array(":token" => $sstoken));	  
 		echo "Lozinka je promenjena <a href='login.php'> Vrati se na pocetnu </a>"; 
    	}
    	if(!$stmt2)echo "Greska";  
?>