<?php
  class  codb{
      public function connect(){
          $server = "localhost";
          $username= "root";
          $password = "seyi_coded";
          $con = mysqli_connect($server,$username,$password) OR die("Errorcan't connect");
          mysqli_select_db($con,"ig");
          return $con;
      }
      public function query($con,$sql){
          $res = mysqli_query($con,$sql);
          return $res;
      }
      public function mquery($con,$sql){
          $res = mysqli_multi_query($con,$sql);
          return $res;
      }
      public function scanxss($data){
          $res = trim($data);
          $res = strip_tags($data);
          $res = htmlspecialchars($data);
          return $res;
      }
      public function rec($con,$sql){
          $res = mysqli_real_escape_string($con,$sql);
          return $res;
      }
  }
?>
