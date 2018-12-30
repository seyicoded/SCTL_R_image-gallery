<?php
  session_start();
  require "connectdb.php";
  $hi=new codb();
  $con = $hi->connect();
  
  if(isset($_POST['verifyusername'])){
      $tu = $hi->rec($con,$hi->scanxss($_POST['message']));
      $tu = strtolower($tu);
      if(strlen($tu) >3 && strlen($tu) <31){
         $snd['lstatus']="true"; 
         $num = mysqli_num_rows($hi->query($con,"SELECT * FROM igusers WHERE username='$tu'"));
         if($num > 0){
           $snd['estatus']="false";  
         }else{
             $snd['estatus']="true";
         }
      }else{
         $snd['lstatus']="false"; 
      }
      
      echo json_encode($snd);
  }
?>
