<?php
   require "connectdb.php";
   $hi=new codb();
   $con = $hi->connect();
   /*
   * DB name = ig;
   * tables----------
   * igusers(uid,username,password,repassword,email)
   * igcat(cid,uid,cname,cimage)
   * iglist(iid,cid,uid,fpath,fname,fsize,ftype)
   * 
   * sessions ------
   *  logstat4rera= md5("truelylogined");
   *   ssiduserstatename = username;
   *   ssiduserstateuid = uid;
   * more later
   */
   $sql="ALTER TABLE igcat ADD COLUMN cimage BLOB NOT NULL
   ";
   if(mysqli_query($con,$sql)){
      echo "Done"; 
   }else{
       echo mysqli_error($con);
       
   }
?>
