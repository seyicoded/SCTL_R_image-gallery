<?php
session_start();
    if(!isset($_SESSION['logstat4rera']) && $_SESSION['logstat4rera'] != md5("truelylogined")){
        header("Location:index.php");
    }        
?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>WELCOME <?php echo $_SESSION['ssiduserstatename'];?> TO THIS IMAGE GALLERY &hearts; ENJOY&hearts;&hearts;</title> 
        <link rel='stylesheet' href="css/homepage.css" type="text/css">
    </head>
    <body name="body">
        <img id='image-logo' src="media/site-own/logo.png" alt="image-logo"> 
        <iframe id='header' framespacing="0" border="0" frameborder="0" src="header.php" target="loadera"></iframe>
         <?php 
         if(isset($_SESSION['lpn'])){
             $lpn = $_SESSION['lpn'];
         }else{
             $lpn ="viewallc.php";
         }
         ?>
        <iframe name="loadera" id='content' framespacing="0" border="0" frameborder="0" src="<?php echo $lpn;?>"></iframe>
        
        <iframe id='footer' framespacing="0" border="0" frameborder="0" src="footer.html"></iframe>
    </body>
</html>
