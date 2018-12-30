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
<?php
    if(isset($_POST['addimage'])){
       foreach($_FILES['iimage']['error'] as $key => $value){
           if($value == UPLOAD_ERR_OK){
                $tmp_name = $_FILES['iimage']['tmp_name'][$key];  
                $check= getimagesize($tmp_name);
                $fpath = "media/uploaded/category-content-images/".rand(100,10000).basename($_FILES['iimage']['name'][$key]); 
                $file_size = $_FILES['iimage']['size'][$key];
                $file_type = $_FILES['iimage']['type'][$key];
                $fname =$hi->rec($con,$hi->scanxss($_POST['iname'][$key]));
                $scecid =$hi->rec($con,$hi->scanxss($_POST['cid'])); 
                $okstata=$okstat=2;
                if($check !== false){
                   if(move_uploaded_file($tmp_name,$fpath)){
                      $sqlq = "INSERT INTO iglist(cid,uid,fpath,fname,fsize,ftype) VALUES('$scecid','$uid','$fpath','$fname','$file_size','$file_type')"; 
                      if($hi->query($con,$sqlq)){
                          $okstat = 1;
                      }
                   }else{
                       $okstata = 0;
                       $msg = " ".$_POST['iname'][$key]." ";
                       echo "<script>alert('SERVER HAS ISSUE WITH UPLOADING OF FILE SORRY DUDE..IMAGE NAMED: $named ');</script>"; 
                   } 
                }else{
                    $okstata = 0;
                    $msg = " ".$_POST['iname'][$key]." ";
                     echo "<script>alert('IMAGE NAMED: $named is not an image');</script>"; 
                }
                
           }else{
               $okstata = 0;
               $named = $_POST['iname'][$key];
               echo "<script>alert('IMAGE NAMED: $named not uploaded due to server error');</script>";
           } 
       }
       if($okstat ==1 && $okstata !=0){
          header("Location:viewallc.php"); 
       }else if($okstat ==1 && $okstata ==0){
            echo "<script>alert('Sorry not all the file made it');</script>";
       } 
    }
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en"> 
        <title>ADD IMAGE TO A CATEGORY</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href="css/image.css" type="text/css">
        <script type="text/javascript" src='javascript/jquery.js'></script>
        <script type="text/javascript" src='javascript/image.js'></script>
    </head>
    <body id='vacb'>
        <div id="loginbox" style="height: 90%;">
        <div id='formtitle'>SELECT ANY CATEGORY TO ADD IMAGE TO.</div>
        <br>
        <marquee style='background: rgba(20,20,20,.5); color: red;'>PLEASE SELECT A CATEGORY TO UPLOAD THE PIX TO.</marquee>
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
         ?>     <br>
              <br>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
            
                <div style="background: rgba(50,50,10,.7); color:red;text-align: center;">
                    <?php
                        $res = mysqli_fetch_assoc($hi->query($con,"SELECT * FROM igcat WHERE cid='".$_POST['cid']."'"));
                        echo $res['cname']."  SELECTED";
                    ?>
                </div>
                
                <input type="hidden" name="cid" value="<?php echo $uscid;?>">
                <marquee style='background: rgba(10,10,10,.5);'><span style="color: red; ">Q.NOTICE: </span>Don't Forget to put image name for and only click add more if you wnat to add more</marquee>
                <br> 
                <div class="add-more">
                    <br>
                     <label for="iname">IMAGE NAME: </label>
                     <input type="text" name="iname[]" placeholder="ENTER IMAGE NAME" required>
                     <br>
                     <br>
                     <label for="iimage">SELECT IMAGE: </label>
                     <input type="file" name="iimage[]">
                     <br>
                     <br>
                </div>
                <br>  
                <input type="button" name="ADD MORE" value="ADD MORE BOX" onclick="addm()">
                <br>
                <br>
                <br>
                <br>
                <input type="submit" name="addimage" value="UPLOAD IMAGE NOW">
            </form>
         <?php
            }
         ?>
        </div>
    </body>
</html>