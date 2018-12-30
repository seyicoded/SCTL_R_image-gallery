<?php
    $username=$password=$loginstat='';
  session_start();
  require "connectdb.php";
  $hi=new codb();
  $con = $hi->connect();
  
  if(isset($_POST['submitlogin'])){
      $username = $hi->rec($con,$hi->scanxss($_POST['username']));
      $username = strtolower($username);
      $password = $hi->rec($con,$hi->scanxss($_POST['password']));
      $pass = md5($password);
      $sql = "SELECT * FROM igusers WHERE username='$username' AND password='$pass'";
      $res = $hi->query($con,$sql);
      $numv = mysqli_num_rows($res);                                     
      if($numv > 0){
         $ress = mysqli_fetch_assoc($res);
         $_SESSION['logstat4rera']= md5("truelylogined");
         $_SESSION['ssiduserstatename']= $ress['username']; 
         $_SESSION['ssiduserstateuid'] = $ress['uid'];
         header("Location:homepage.php");
         echo "<script>window.location.replace('homepage.php');</script>";
      }else{
          $loginstat="SORRY WE CAN'T FIND YOUR ACCOUNT <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'> PLEASE
          X-CHECK THE INFO. ABOVE";
      }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>                                    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en"> 
<meta name="viewport" content="width=device-width,initial-scale=1.0">   
<title>Login-Page</title>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
     <img id='image-logo' src="media/site-own/logo.png" alt="image-logo">
     <div id="loginbox">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
             <div id='formtitle'>LOGIN-PAGE</div>
             <br>
             <br>
             <br>
             
             <label for="username">Enter Username: </label>
             <input type="text" name="username" placeholder='Enter Username' value="<?php echo $username;?>" required>
             
             <br>
             <br>
             <br>
             
             <label for="password">Enter Password: </label>
             <input type="password" name="password" placeholder='Enter password' value="<?php echo $password;?>" required>
             
             <br>
             <br>
             <br>
             <span><?php echo $loginstat;?></span>
             <input type="submit" name="submitlogin" value="LOGIN">
             <br>
             Don't Have an account <a href="reg.php" style="text-decoration: none; color: blue;">click here</a> to Create/Register one NOW&hearts;!!!
        </form>
     </div>
     <iframe framespacing="0" border="0" frameborder="0" src="footer.html"></iframe>
</body>
</html>

