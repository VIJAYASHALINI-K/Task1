<?php
   include "session.php";
   if(isset($_SESSION['id'])){
        header("Location:http://localhost/dashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *{
            text-align:center;
            background-color:rgb(7, 15, 43);
        }
        .container{
            margin:0 auto;
            max-width:800px;
            max-height:auto;
            color:white;
        }
        fieldset{
            margin:40px;
            padding:20px;
            background-color: rgb(27, 26, 26);
        }
        legend{
            font-size:28px;
        }

        label{
            margin-top:10px;
            padding:5px;
            font-size:24px;
            background-color:rgb(27, 26, 26);
        }
        input{
            margin-top:10px;
            padding:5px;
            font-size:16px;
            background-color:azure;
        }
        #logIn{
            padding:5px;
            font-size:24px;
            background-color:lightsteelblue;
            border-radius:5px;
        }
        a{
            font-size:28px;
            text-decoration:none;
            background-color:rgb(27, 26, 26);
            font-weight:bold;
            color:rgb(10, 190, 210);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <form method="POST" action="/authenticate.php">
            <fieldset>
                <legend>Log In</legend>   
                <label for="emailAddress">Email Address</label><br>
                <input type="email" id="emailAddress" name="emailAddress" required><br><br>
                <label for="password">Password</label><br>
                <input type="password" for="password" name="password" required><br><br>
                <input type="submit" value="Log In"  id="logIn"><br><br>
                <label>Don't have an account? </label><a href="/index.php">Register Now</a><br><br>
            </fieldset>
        </form>
    </div>
    <?php
        $Message = $_GET['Message'];
        echo '<span style="padding:5px;font-size: 20px;color:white;">'.$Message.'</span>';
        error_log("debug.log");      
    ?>
</body>
</html>