<?php
    $username=$password=$repassword=$email=$regstat='';
    $usernamestat=$passwordstat=$repasswordstat=$emailstat= '';
  session_start();
  require "connectdb.php";
  $hi=new codb();
  $con = $hi->connect();
  if(isset($_POST['submitreg'])){
     $username = $hi->rec($con,$hi->scanxss($_POST['username']));
     $username = strtolower($username);
     $password = $hi->rec($con,$hi->scanxss($_POST['password'])); 
     $repassword = $hi->rec($con,$hi->scanxss($_POST['repassword'])); 
     $email = $hi->rec($con,$hi->scanxss($_POST['email'])); 
     
     $num = mysqli_num_rows($hi->query($con,"SELECT * FROM igusers WHERE username='$username'"));
     if($num != 0){
         $usernamestat="Server say's: username already exist <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'>";
         $regstat="Server say's:check info above <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'>";
     }else{
         if($password == $repassword){
             if(strlen($password) >7 && strlen($password) <33){
                 if(strlen($username) > 3 && strlen($username) <31){
                     $md5 = md5($password);
                     $sqll = "INSERT INTO igusers(username,password,repassword,email) VALUES('$username','$md5','$password','$email')";
                     if($hi->query($con,$sqll)){
                        $_SESSION['logstat4rera']= md5("truelylogined");
                        $_SESSION['ssiduserstatename']= $username;
                        
                        $resaz = mysqli_fetch_assoc($hi->query($con,"SELECT * FROM igusers WHERE username='$username' AND password='$md5'"));
                        $_SESSION['ssiduserstateuid'] = $resaz['uid'];
                        
                        header("Location:homepage.php");
                        echo "<script>window.location.replace('homepage.php');</script>";
                     }else{
                         $regstat = "DB ERROR <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'> try again later";
                     }
                     
                     
                 }else{
                    $usernamestat="Server say's: username is out of range <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'>"; 
                 }
             }else{
                $passwordstat= $repasswordstat="Server say's: password out of range <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'>";
             }
         }else{
             $passwordstat= $repasswordstat="Server say's: password don't match <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'>";
         }
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
<link rel="stylesheet" type="text/css" href="css/reg.css">
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/reg.js"></script>
</head>
<body>
     <img id='image-logo' src="media/site-own/logo.png" alt="image-logo">
     <div id="loginbox">
        <form name="reg" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return verifysubmit()">
             <div id='formtitle'>REGISTRATION-PAGE</div>
             <br>
             <marquee><b style="color: red;">Q.Notice</b>: Username Must be between 4-30 characters And Password Must be between 8-32 
             character.. Email is optional just put abc@d.com if you don't have any</marquee>
             <br>
             <br>
             
             <label for="username">Enter Username: </label>
             <input type="text" maxlength="30" onkeyup="veriusername(this.value)" name="username" placeholder="Enter Username" value="<?php echo $username;?>" required><span id='usernamestat'><?php echo $usernamestat;?></span>
             
            <br>
            <br>
            <br>
            
            <label for="password">Enter Password: </label>
            <input type="password" name="password" maxlength="32" onkeyup="veripas(this.value)" placeholder="Enter Password" value="<?php echo $password;?>" required><span id='passwordstat'><?php echo $passwordstat;?></span>
            
            <br>
            <br>
            <br>
            
            <label for="repassword">Re-Enter Passoword: </label>
            <input type="password" name="repassword" maxlength="32" onkeyup="verirepas(this.value)" placeholder="Re-Enter Password" value="<?php echo $repassword;?>" required><span id='repasswordstat'><?php echo $repasswordstat;?></span> 
            
            <br>
            <br>
            <br>
            
            <label for="email">Enter Email: </label>
            <input type="email" name="email" placeholder="Enter email" value="<?php echo $email;?>"><span id='emailstat'><?php echo $emailstat;?></span>
            
            <br>
            <br>
            <br>
            
            <span id='regstat'><?php echo $regstat;?></span>                                       
            <input type="submit" name="submitreg" value="Register" required>
            
            <br>
            If you Already Have an Account <a href="index.php" style="text-decoration: none; color: blue;">click here</a> To login now&hearts;!!!
            <br>
        </form>
     </div>
     <iframe framespacing="0" border="0" frameborder="0" src="footer.html"></iframe>
</body>
</html>

