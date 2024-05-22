<?php
    include "session.php";
    /*
    *isset($variable)
    *@param mixed $var - variable of string or int or bool
    *@param mixed ..$vars)
    *@return bool
    */
    if(isset($_SESSION['id'])){
        header("Location:http://localhost/dashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        *{
            text-align:center;
            background-color:rgb(34,9,44);
        }
        .container{
            margin:0 auto;
            max-width:800px;
            max-height:auto;
            color:white;
        }
        fieldset{
            margin:20px;
            padding:2px;
            background-color: rgb(34,34,34);
        }
        legend{
            font-size:28px;
        }
        label{
            margin-top:10px;
            padding:2px;
            font-size:24px;
            background-color:rgb(34,34,34);
        }
        input{
            margin-top:10px;
            padding:5px;
            font-size:16px;
            background-color:azure;
        }
        span{
            background-color:rgb(34,34,34);
            font-size:18px;
        }
        #register{
            padding:5px;
            font-size:24px;
            background-color:teal;
            border-radius:5px;
        }
        a{
            font-size:28px;
            text-decoration:none;
            background-color:rgb(34,34,34);
            font-weight:bold;
            color:rgb(190, 49, 68)
        } 
        input :focus{
            background-color:white;
        }      
    </style>
    <script>       
        $(document).ready(function() {
            $("#username").on( "blur", function() {
                var usernamePattern = /^[a-zA-Z]+$/;
                var username = $('#username').val();
                if (username.match(usernamePattern) && (username.length >= 3 && username.length <= 8)){
                    $('#usernameValidation').text('validated').css('color','green');
                }
                else if(username.length < 3 || username.length > 8){   
                    $('#usernameValidation').text('Enter username with minimum length of 3 and maximum length of 8').css('color','red');
                }
                else if(!(username.match(usernamePattern))){                
                    $('#usernameValidation').text('Please enter letters only!').css('color','red');
                }
                else{

                    $('#usernameValidation').text('Please enter letters only!').css('color','red');
                }
            });
        }); 
        $(document).ready(function() {
            $('#emailAddress').on("blur",function(){                
                var emailAddress = $('#emailAddress').val();
                var emailAddressPattern =  /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(emailAddress.match(emailAddressPattern) && emailAddress.length != 0) {
                    $('#emailAddressValidation').text('validated').css('color','green');
                }
                else{               
                    $('#emailAddressValidation').text('Please enter valid email address').css('color','red');      
                }
            });
        });
        
        $(document).ready(function(){
            $("#password").on('blur',function(){
                var password = $('#password').val();                
                var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*_])(?=.{6,12}$)/;
                if(password.match(passwordPattern) && (password.length>=8)){               
                    $('#passwordValidation').text('validated').css('color','green'); 
                    
                }
                else{
                    $('#passwordValidation').text('Please enter valid password').css('color','red');
                }
            });
        });
        
         $(document).ready(function(){
             $('#repeatPassword').on('keyup',function(){
                 if($('#password').val() == $('#repeatPassword').val()){
                     $('#repeatPasswordHint').text('validated').css('color','green');
                 }
                else{
                    $('#repeatPasswordHint').text('Match the password typed above').css('color','red');
                   
                }
             });
         });
    </script>
</head>
<body>
    <div class="container" >
        <form method="POST" action="">
            <fieldset>
                <legend >Registration</legend>
                <label for="username">Username</label><br>
                <input type="text" id="username" name="username"><br><span id="usernameValidation"></span><br><br>
                <label for="emailAddress">Email Address</label><br>
                <input type="email" id="emailAddress" name="emailAddress" required><br><span id="emailAddressValidation"></span><br><br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br><span id="passwordValidation"></span><br>
                <span>(password must contain lowercase,uppercase,number and special character)</span><br><br>
                <label for="repeatPassword">Repeat password</label><br>
                <input type="password" id="repeatPassword" name="repeatPassword" required><br>
                <span id="repeatPasswordHint"></span><br><br>
                <input type="submit" value="Register" id="register"><br><br>
                <label>Have an account?</label><a href="/login.php">Login</a>
            </fieldset>
        </form>
    </div>
    
    <?php    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST['username'];
        $emailAddress=$_POST['emailAddress'];
        $password=$_POST['password'];
        /*
        password_hash($password,$algo)
        *@param string $password  - contains number(s),upperCaseLetter(s),lowerCaseLetter(s) and specialCharacter(s)
        *@param string $algo - as PASSWORD_DEFAULT used
        *@param array $options
        *@return string; - as 60 characters
        */
        $passwordEncrypted=password_hash($password, PASSWORD_DEFAULT);
        /*
        file_get_contents($filename)
        *@param string $file_name
        *@return string|false; - if file present file contents returned else false returned
        */
        /*
        json_decode($json,$associative)
        *@param string $json - json string
        *@param bool $associative - as true denotes associative array, false denotes not an associative array
        *@return object|null; - json encoded values are returned as object and not encoded as null
        */
        $user=json_decode(file_get_contents("user.json"),true);  
         /*
        *array_key_exists($data,$array)
        *@param mixed $value - as value want to search in array 
        *@param array $array
        *@return bool;
        */  
        $emailAddressExists=false;
        foreach($user as $key=>$value){ 
            if(array_key_exists($emailAddress,$value)){
                $emailAddressExists=true;
            }        
        }
        if($emailAddressExists){           
            echo '<span style="padding:5px;font-size: 20px;color:white;">'."You are already registerd. Try to login<br>".'</span>';
        }
        else{
            if(file_get_contents("user.json")==""){
                /*
                *array(mixed)
                *@param int|string $key
                *@param mixed $value
                *@return array
                */
                $registerUser=array($emailAddress=>$passwordEncrypted);
                $registerNewUser = array($registerUser);
                /*
                *json_encode($array)
                *@param mixed $value
                *@return string|false - string as JSON object
                */
                /*
                *file_put_contents($filename,$data,$flags)
                *@param string $filename
                *@param mixed $data - as string,array
                *@param int $flag - FILE_APPEND used
                *@return int|false - if success int returned by number of bytes written to the file else false as file written failure
                */
                file_put_contents("user.json", json_encode($registerNewUser,JSON_PRETTY_PRINT),FILE_APPEND);
                
                echo '<span style="padding:5px;font-size: 20px;color:white;">'."You are registered Successfully.".'</span>';
                // header("Location:http://localhost/login.php?Message=".urlencode("You are registered Successfully as First User."));
                return json_encode(['success'=>true,'message'=>'user created successfully']);
         
            }
            else{
                $registerUser=array($emailAddress=>$passwordEncrypted);
                /*
                array_push($array,$value)
                *@param array $array
                *@param mixed $value- as string, array
                *@return array; added contents at end of the array
                */ 
                array_push($user,$registerUser);
                /*
                *json_encode($array)
                *@param mixed $value
                *@return string|false - string as JSON object
                */
                /*
                *file_put_contents($filename,$data,$flags)
                *@param string $filename
                *@param mixed $data - as string,array
                *@param int $flag - FILE_APPEND used
                *@return int|false - if success int returned by number of bytes written to the file else false as file written failure
                */
                file_put_contents("user.json", json_encode($user,JSON_PRETTY_PRINT));
                /*
                *header($header)
                *@param string $header - url path to page
                *@return void //nothing will be returned
                */
                /*
                *urlencode($string)
                *@param string $string - string contents passed to next page
                *@return string
                */
                echo '<span style="padding:5px;font-size: 20px;color:white;">'."You are registered Successfully.".'</span>';
                // header("Location:http://localhost/login.php?Message=".urlencode("You are registered Successfully."));
                // exit();
                return json_encode(['success'=>true,'message'=>'user created successfully']);
           }
        }
    }
    ?>
    <?php    
        // $Message = $_GET['Message'];
        // echo $Message; 
        error_log("debug.log");    
    ?>
</body>
</html>
