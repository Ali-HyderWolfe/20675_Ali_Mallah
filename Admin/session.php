<?php 
        

       session_start();
       unset($_SESSION['data']);
       session_destroy();
       header('location:../index.php?msg=logout Successfully');

 ?>