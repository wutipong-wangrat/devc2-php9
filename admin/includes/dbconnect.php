<?php 
    $host = "localhost";
    $user="root";
    $password="";
    $dbconnect="cirdb";

    $con=mysqli_connect("$host","$user","$password","$dbconnect");
    mysqli_set_charset($con,"utf8");
    //$conn=mysqli_connect("localhost","root","","cirdb");
?>