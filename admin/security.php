<?php session_start()?>

<?php 
if(!$_SESSION['auth_user']){
    header("Location: ../user/login.php");
}
?>