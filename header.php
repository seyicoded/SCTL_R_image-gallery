<?php
session_start();
    if(!isset($_SESSION['logstat4rera']) && $_SESSION['logstat4rera'] != md5("truelylogined")){
        header("Location:index.php");
    }       
?>

<!doctype html>
<html>
<head>
    <title>HEADER</title>
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Lang" content="en">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <script type="text/javascript" src="javascript/jquery.js"></script>
    <script type="text/javascript" src="javascript/header.js"></script>
</head>
<body>
    <div id='nav-box'>
        <span id='menu' id='x'>My PROFILE</span> 
        <span id="hide" id='x' class="profpop">
            <div id='x' class="chhc"><a id='x' target="loadera"> VIEW-PROF.</a></div>
            <div  id='x'  class="chhc"><a id='x' target="loadera">EDIT-PROF.</a></div>
        </span>
        
        <span id='menu'><a href="cic.php" target="loadera">Create Image Category</a></span>
        
        <span id='menu'><a href="additoc.php" target="loadera">Add Image to Own Category</a></span>
        <span id="hide2">
            <div></div>
        </span>
        
        <span id='menu'><a href="eic.php" target="loadera">EDIT CATEGORY</a></span>
        
        <span id='menu'><a href="viewallc.php" target="loadera">VIEW ALL IMAGES</a></span>
        
        <span id='menu' style="float: right;"><a href="logout.php" target="body">LOG-OUT</a></span>
    </div>
</body>
</html>