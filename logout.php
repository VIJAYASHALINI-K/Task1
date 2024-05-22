<?php
   include "session.php";
   error_log("debug.log");     
   if(isset($_SESSION['id'])){
      session_unset();
      session_destroy();
      header("Location:http://localhost/login.php");
      exit();
   }
   
