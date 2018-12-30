<?php
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
?>
<!doctype html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Lang" content="en"> 
        <title>SELECT AN IMAGE CATEGORY</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href="css/image.css" type="text/css">
    </head>
    <body id='vacb'>
          <div id='formtitle'>SELECT ANY CATEGORY</div>
          <marquee style='background: rgba(20,20,20,.5); color: red;'>THE CATEGORYS BELOW ARE FROM DIFFERENT USERS AND POSSES THE USERS'-PIX</marquee>
          <br clear="all">
          <div>
            <?php
                $sql = "SELECT * FROM igcat INNER JOIN igusers ON igcat.uid=igusers.uid ORDER BY igcat.cid DESC";
                $data = $hi->query($con,$sql);
                $num = mysqli_num_rows($data);
                for($i=0;$i<$num;$i++){
                    $res = mysqli_fetch_assoc($data);
                    $username = $res['username'];
                    $cname = $res['cname'];
                    $cimage = $res['cimage'];
                    $cid = $res['cid'];
                    
                    echo "<div class='cat-single-box'>";
                    
                    echo "category by: <span id='cat-single-username'>$username</span>";
                    echo "<div><a href='viewalli.php?ici=$cid'><img id='cat-single-image' src='$cimage' alt='$cname'></a></div>";
                    echo "<div id='cat-single-name'><a href='viewalli.php?ici=$cid'>$cname</a></div>";
                    
                    echo "</div>";
                }
            ?>
          </div>
    </body>
</html>
