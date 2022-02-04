<?php session_start(); ?>
<?php include("includes/dbconnect.php"); ?>

<?php
if (isset($_POST['login_btn'])) {
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email_login' AND password='$password_login' ";
    $query_run = mysqli_query($con, $query);

    if (mysqli_fetch_array($query_run)) {
        $_SESSION['username'] = $email_login;
        header("Location: index.php");
        
    } else {
        $_SESSION['status'] = "กรุณาป้อนข้อมูล อีเมลล์หรือรหัสผ่าน ใหม่ครับ";
        header("Location: login.php");
    }
}
?>

<?php
    if(isset($_POST['logout_btn'])){
        session_destroy();
        session_destroy(); //destroy the session
        unset($_SESSION['username']);
        header("Location: login.php");
    }
?>

