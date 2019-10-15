 <?php 
 session_start();
include_once '../../DAL/Database.php';
$database = new Database();
$db = $database->getConnection();

 if(isset($_POST['submit']))
{
    $token=$_POST['token'];
    $_SESSION['token'] = $token;

    $query="SELECT email FROM token WHERE token=:token AND status=0"; 
	$stmt = $db->prepare($query);
    $stmt->execute(array(":token" => $token));
    $count = $stmt->rowCount();
        	
  if ($count > 0)
  {
  		if(!isset($_POST['password'])){  

 		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) $email=$row['email']; 
 		 $pass=$_POST['password'];
 
 		 echo $email;
 		 $_SESSION['email'] = $email;

 		echo '<form method="post" action="updatePassword.php">  
 		Unesite novu lozinku:<input type="password" class="fadeIn second" name="password" id="password">  
 		<input type="submit" class="fadeIn fourth" value="Promeni lozinku">  
 		</form>  '
 		;}
 		
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

    <title>Token</title>
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
    <form method="post" label = "Molimo unesite token" >
      <input type="number" id="token" class="fadeIn second" name="token" placeholder="Token"><br><span class="error"></span>
      <input type="submit" id="btn" name="submit" class="fadeIn fourth" value="Validiraj token">
    </form>
     <div id="formFooter">
      <a class="underlineHover" href="index.html">Vracanje na pocetnu stranu</a>
    </div>
</div>
</div>
</body>
</html>