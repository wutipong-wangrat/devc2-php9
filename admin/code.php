<?php include("includes/dbconnect.php");?>

<?php 
if(isset($_POST['login_btn'])){
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query="SELECT * from users WHERE email='$email_login' AND password='$password_login' ";
    $query_run=mysqli_query($conn,$query);

    if(mysqli_fetch_array($query_run)){
        echo"OK";
    }
    else{
        echo"NO";
    }
}
?>