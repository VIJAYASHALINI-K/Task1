<?php
    include "session.php";
    /*
    *header($header)
    *@param string $header - url path to page
    *@return void //nothing will be returned
    */
    if(!isset($_SESSION['id'])){
        header("Location:http://localhost/login.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        *{
            background-color:lightsteelblue;
            text-align:center;
            margin:20 auto;
        }
        .container{
            margin:10px;
        }
        #logout{
            font-size:20px;
            background-color:azure;
            border-radius:5px;
        }
    </style>
</head>

<body>    
    <?php
        $Message= $_GET['Message'];
        echo '<br>';
        echo '<span style="padding:2px;font-size: 20px;">'.$Message.'</span>';
        error_log("debug.log");      
    ?>
    <div class="container">
        <h1>Welcome</h1>
        <a href="logout.php"> Log Out</a>
    </div>
    
     
</body>
</html>