<?php
  $cname=$upstat=$cimagee=$cnamee=$cname1=$cimage1='';
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
  
  if(isset($_POST['change'])){
      $file= $_FILES['cimagee']['name'];
      $cname1 = $hi->rec($con,$hi->scanxss($_POST['cnamee']));
      $cide1 = $hi->rec($con,$hi->scanxss($_POST['cide']));
      $numr = strlen($file);
      
                              
      if($numr > 0){
        $fcimage = "media/uploaded/category-images/".rand(100,1000).rand(1,100).basename($_FILES['cimagee']['name']);  
        $tmp_name = $_FILES['cimagee']['tmp_name'];
        $check = getimagesize($tmp_name);
        if($check !== false){
            $datarr = $hi->query($con,"SELECT * FROM igcat WHERE uid='$uid' AND cid='$cide1'");
            $resrr = mysqli_fetch_assoc($datarr);
            $cimagerr = $resrr['cimage'];
            
            
            if(move_uploaded_file($tmp_name,$fcimage)){
            unlink($cimagerr);
            
                $sqlc ="UPDATE igcat SET cname='$cname1',cimage='$fcimage' WHERE uid='$uid' AND cid='$cide1'";
                if($hi->query($con,$sqlc)){
                     header("Location:viewallc.php"); 
                  }else{
                      $msg = "SERVER say's:Sorry db error";
                      echo "<script>alert('$msg');</script>";
                  }    
            }else{
                $msg = "SERVER say's:can't upload no effect made";
                echo "<script>alert('$msg');</script>";
            }
            
        }else{
           $msg = "SERVER say's:sorry but the file just Uploaded is not an image";
              echo "<script>alert('$msg');</script>"; 
        }
      }else{
          $sqlc = "UPDATE igcat SET cname='$cname1' WHERE uid='$uid' AND cid='$cide1'";
          if($hi->query($con,$sqlc)){
             header("Location:viewallc.php"); 
          }else{
              $msg = "SERVER say's:Sorry db error";
              echo "<script>alert('$msg');</script>";
          }
      }
      
  }
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href="css/image.css" type="text/css">
    </head>
    <body>
        <div id="loginbox" style="height: 90%;">
            <div id='formtitle'>EDIT IMAGE CATEGORY</div> 
            <br clear="all">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <select name="cid" id='sel'>
                     <?php
                        $sql = "SELECT * FROM igcat WHERE uid='$uid' ORDER BY cid DESC";
                        $data = $hi->query($con,$sql);
                        $num = mysqli_num_rows($data);
                        for($i=0;$i<$num;$i++){
                            $res = mysqli_fetch_assoc($data);
                            $scid = $res['cid'];
                            $scname = $res['cname'];
                            echo "<option value='$scid'>$scname</option>";
                        }
                     ?>
                </select>
                <input type="submit" name="selected" value="SELECT">
            </form>
            <?php
                if(isset($_POST['selected'])){
                    $uscid = $hi->rec($con,$hi->scanxss($_POST['cid']));
                    $sql1 = "SELECT * FROM igcat WHERE uid='$uid' AND cid='$uscid'";
                    $data1 = $hi->query($con,$sql1);
                    $res1 = mysqli_fetch_assoc($data1);
                    $cname1 = $res1['cname'];
                    $cimage1 = $res1['cimage'];
                    ?>
                   <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                   <marquee style='background: rgba(10,10,10,.5);'><span style="color: red; ">Q.NOTICE: </span>If you don't want to change the image just leave it and only change the category name</marquee>
                        <br>
                        <br>
                        <label for='cnamee'>CATEGORY-NAME:</label>
                        <input type="text" name="cnamee" placeholder='Enter c-name' value="<?php echo $cname1;?>" required>
                        <br>
                        <br>
                        OLD IMAGE: <img id='cat-single-image' style="width: 30%" src='<?php echo $cimage1;?>' alt='$cname'>
                        <br>
                        <br>
                        <label>NEW IMAGE: </label>
                        <input type="file" name="cimagee">
                        <input type="hidden" name="cide" value="<?php echo $uscid;?>">
                        <br>
                        <br>
                        <br>
                        <input type="submit" name="change" value="CHANGE">
                   </form> 
            <?php   
                }
            ?>
        </div>
    </body>
</html>
