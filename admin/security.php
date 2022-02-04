<?php session_start()?>

<?php 
// include("./login.php");
if(!$_SESSION['username']){
    header("Location: login.php");
}
?>