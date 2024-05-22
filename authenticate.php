<?php
include "session.php";
$emailAddress=$_POST['emailAddress'];
$password=$_POST['password'];
$sessionId=password_hash($emailAddress,PASSWORD_DEFAULT);
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
/*
*password_verify($password,$hash)
*@param string $password
*@param string $hash
*@return bool; -true password match and false password not match
*/
$emailAddressExists=0;
foreach($user as $key=>$value){ 
    if(array_key_exists($emailAddress,$value)){
        $emailAddressExists=1;
        $passwordPresentInUser=password_verify($password,$value[$emailAddress]);
    }    
}
if(($emailAddressExists && $passwordPresentInUser)&&($emailAddressExists!=0 && $passwordPresentInUser!=0)){
    $_SESSION['id']=(!isset($_SESSION['id']))?$sessionId:$_SESSION['id'];
    header("Location:http://localhost/dashboard.php?Message=".urlencode("Login Successfull"));    
    exit();
}
else if(!($emailAddressExists) && !($passwordPresentInUser)){
    header("Location:http://localhost/login.php?Message=".urlencode("You are new User. Register Now"));
    exit();
}
else if($emailAddressExists && !($passwordPresentInUser)){
    header("Location:http://localhost/login.php?Message=".urlencode("Incorrect login details"));
    exit();
}
else{
    header("Location:http://localhost/login.php?Message=".urlencode("Incorrect login details"));
    exit();
}
error_log("debug.log");     