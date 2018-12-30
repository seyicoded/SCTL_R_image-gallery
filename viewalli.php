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
  
  if(isset($_GET['ici'])){
     $_SESSION['icises'] = $hi->rec($con,$hi->scanxss($_GET['ici'])); 
  }
  $cid = $hi->rec($con,$hi->scanxss($_SESSION['icises']));
  
  function showima($starnum){
      $hi = new codb();
      $con = $hi->connect();
      $cid = $hi->rec($con,$hi->scanxss($_SESSION['icises']));
      
      $starnum =$hi->rec($con,$hi->scanxss($starnum));
      $ress = $hi->query($con,"SELECT * FROM iglist WHERE cid='$cid' AND iid<='$starnum' ORDER BY iid DESC LIMIT 12");
      $num = mysqli_num_rows($ress); 
      for($i=0;$i<$num;$i++){
          $res = mysqli_fetch_assoc($ress);
          $fname = $res['fname'];
          $fpath = $res['fpath'];
          echo "<div id='gal-box' style='display:inline-block; margin-left:5%; margin-bottom:5%; box-shadow:3px 3px 5px 5px rgba(10,10,10,.6);'>";
          
          echo "<div><img id='gal-image' style='width:300px; height:200px;' src='$fpath' alt='$fname'></div>";
          echo "<div id='gal-text' style='text-align:center; text-shadow:2px 3px 3px rgba(10,10,10,.8);'>$fname</div>";
          
          echo "</div>";
      }
  }
?>
<!doctype html>
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <meta http-equiv="Lang" content="en"> 
        <title>IMAGE GALLERY</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href="css/image.css" type="text/css"> 
    </head>
    <body>
        <div id='formtitle'>
        <?php
            $rsql = mysqli_fetch_assoc($hi->query($con,"SELECT * FROM igcat INNER JOIN igusers ON igcat.uid=igusers.uid WHERE igcat.cid='$cid'"));    
            echo $rsql['cname']."<small style='float:right;'>by "."<i style='color:red;'>".$rsql['username']."</i></small>";
        ?></div>
        <br>
        <?php 
        if(isset($_GET['lpgnbg'])){
           $_SESSION['lgnmn'] = $_GET['lpgnbg']; 
        }
        $lklkl = isset($_GET['lpgnbg']) ? $_SESSION['lgnmn']:'';  
         
         $myphp = $_SERVER['PHP_SELF'];
            $ress = $hi->query($con,"SELECT * FROM iglist WHERE cid='$cid' ORDER BY iid DESC");
            $ddfd = mysqli_fetch_assoc($ress);
            $numd=$numddd=$ddfd['iid'];
            //$numddd = mysqli_num_rows($ress);
            if(!isset($_GET['lpgnbg'])){
               showima($numd);  
               $cnumd = $numddd-13;
               if($cnumd >= 1){
                   
                  echo "<a style='float:right; color:blue; text-decoration:none;' href='$myphp?lpgnbg=2'>NEXT PAGE</a>"; 
               } 
            }else if(isset($_GET['lpgnbg']) && $lklkl == 2){
                $mnumd = $numd - 12;
                showima($mnumd);
                $cnumd = $numddd-24;
                
                
                if($cnumd >= 1){                 
                    echo "<a style='float:right; color:blue; text-decoration:none;' href='$myphp?lpgnbg=3'>NEXT PAGE</a>"; 
                } echo "<a style='float:left; color:blue; text-decoration:none;' href='$myphp'>PREVIOUS PAGE</a>";
            }else if(isset($_GET['lpgnbg']) && $lklkl == 3){
                $mnumd = $numd - 24;
                showima($mnumd);
                $cnumd = $numddd-36;
                
                
                if($cnumd >= 1){                 
                    echo "<a style='float:right; color:blue; text-decoration:none;' href='$myphp?lpgnbg=4'>NEXT PAGE</a>"; 
                } echo "<a style='float:left; color:blue; text-decoration:none;' href='$myphp?lpgnbg=2'>PREVIOUS PAGE</a>";
            }
            else if(isset($_GET['lpgnbg']) && $lklkl == 4){
                $mnumd = $numd - 36;
                showima($mnumd);
                $cnumd = $numddd-48;
                
                
                if($cnumd >= 1){                 
                    echo "<a style='float:right; color:blue; text-decoration:none;' href='$myphp?lpgnbg=5'>NEXT PAGE</a>"; 
                } echo "<a style='float:left; color:blue; text-decoration:none;' href='$myphp?lpgnbg=3'>PREVIOUS PAGE</a>";
            }
            else if(isset($_GET['lpgnbg']) && $lklkl == 5){
                $mnumd = $numd - 48;
                showima($mnumd);
                $cnumd = $numddd-60;
                
                
                if($cnumd >= 1){                 
                    echo "<a style='float:right; color:blue; text-decoration:none;' href='$myphp?lpgnbg=6'>NEXT PAGE</a>"; 
                } echo "<a style='float:left; color:blue; text-decoration:none;' href='$myphp?lpgnbg=4'>PREVIOUS PAGE</a>";
            }
            else if(isset($_GET['lpgnbg']) && $lklkl == 6){
                $mnumd = $numd - 60;
                showima($mnumd);
                $cnumd = $numddd-72;
                
                
                if($cnumd >= 1){                 
                    echo "<a style='float:right; color:blue; text-decoration:none;' href='$myphp?lpgnbg=7'>NEXT PAGE</a>"; 
                } echo "<a style='float:left; color:blue; text-decoration:none;' href='$myphp?lpgnbg=5'>PREVIOUS PAGE</a>";
            }
        ?>
    </body>
</html>