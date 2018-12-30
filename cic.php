<?php
$cname=$upstat='';
  session_start();
    if(!isset($_SESSION['logstat4rera']) && $_SESSION['logstat4rera'] != md5("truelylogined")){
        header("Location:index.php");
    }
  
  $_SESSION['lpn'] = $_SERVER['PHP_SELF'];
  require 'connectdb.php';
  $hi = new codb();
  $con = $hi->connect();
  $username= $_SESSION['ssiduserstatename'];
  $uid = $_SESSION['ssiduserstateuid'];
  
  if(isset($_POST['Uploaddetail'])){     
     $cname = $hi->rec($con,$hi->scanxss($_POST['cname']));
     $fcimage = "media/uploaded/category-images/".rand(100,1000).rand(1,100).basename($_FILES['cimage']['name']);
     $tmp_name = $_FILES['cimage']['tmp_name'];
     $check = getimagesize($tmp_name); 
     if($check !== false){
         if(move_uploaded_file($tmp_name,$fcimage)){
             $sql = "INSERT INTO igcat(uid,cname,cimage) VALUES('$uid','$cname','$fcimage')";
            if($hi->query($con,$sql)){
                header("Location:viewallc.php");
                echo "<script>window.location.replace('viewallc.php');</script>";
            }else{
                unlink($fcimage);
                $upstat = "SORRY DB PROBLEM <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'>";
            } 
         }
     }else{
         $upstat = "sorry not an image file try another <img src='media/site-own/error.png' alt='' style='width:10px; height:10px;'> .. Thank you"; 
     }
  }
?>
<!doctype html>
<html>
    <head>
        <title>ADD AN IMAGE CATEGORY</title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href="css/image.css" type="text/css">
        <script type="text/javascript">
            function ver(){
                var noti = document.getElementById("stat");
                var txt = document.ccre.cname.value;
                if(txt.length >0){
                   return true; 
                }
               return false; 
            }
        </script>
    </head>
    <body>
          <div id="loginbox">
                <form name="ccre" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return ver()" enctype="multipart/form-data">
                    <div id='formtitle'>CREATE CATEGORY FOR IMAGES</div>
                    
                    <br>
                    <br>
                    <br>
             
                    <label for="cname">CATEGORY NAME: </label>
                    <input type="text" name='cname' placeholder='Enter Category name' value="<?php echo $cname?>" required>
                    
                    <br>
                    <br>
                    <br>
                    <label for="cimage">CATEGORY IMAGE: </label>
                    <input type="file" name="cimage">
                    
                    <br>
                    <br>
                    <br>
                    <span class='stat'><?php echo $upstat;?></span>
                    <input type="submit" name="Uploaddetail" value="CREATE">
                </form>
          </div>
    </body>
</html>
