<?php include("security.php"); ?>
<?php include("includes/dbconnect.php"); ?>
<?php include("includes/thaidate.php"); ?>

<?php
if (isset($_POST['news_save'])) {
    $head = $_POST['head'];
    $detail = $_POST['detail'];
    $namepic = $_FILES["hotnew_image"]['name'];
    $namedoc = $_FILES['hotnew_doc']['name'];
    if (file_exists("upload/hotnew_images/" . $_FILES["hotnew_image"]["name"])) {
        $store = $_FILES["hotnew_image"]["name"];
        $_SESSION['status'] = "กรุณาเพิ่มรูปภาพ'.$store.' ";
        echo "กรุณาเพิ่มรูปภาพ";
        header('Location: news1.php');
    } else {
        $design = "ผู้ดูแลระบบ-วท.ตราด";
        $hotcount = 0;
        $query = "INSERT INTO hotnew(head,detail,date,namepic,namedoc,hotcount,design) 
            VALUES('$head','$detail','$date','$namepic','$namedoc','$hotcount','$design')";
        $result = mysqli_query($con, $query);

        if ($result) {
            move_uploaded_file($_FILES["hotnew_image"]["tmp_name"], "upload/hotnew_images/" . $_FILES["hotnew_image"]["name"]);
            move_uploaded_file($_FILES["hotnew_doc"]["tmp_name"], "upload/hotnew_docs/" . $_FILES["hotnew_doc"]["name"]);
            $_SESSION['success'] = "เพิ่มข่าวสารเรียบร้อยแล้ว";
            echo "เพิ่มข่าวสารเรียบร้อยแล้ว";
            header('Location: news1.php');
        } else {
            $_SESSION['success'] = "เพิ่มข่าวสารยังไม่เรียบร้อยแล้ว";
            echo "เพิ่มข่าวสารยังไม่เรียบร้อยแล้ว";
            header('Location: news1.php');
        }
    }
}
?>

<?php
if (isset($_POST['news_update'])) {
    $id =  $_POST['updateting_id'];
    $head =  $_POST['edit_head'];
    $detail =  $_POST['edit_detail'];
    $namepic =  $_FILES['hotnew_image']['name'];

    if ($namepic <> "") {
        if ($namepic != "") {
            $query = "UPDATE hotnew SET head='$head',detail='$detail',namepic='$namepic' WHERE id='$id' ";
            $result = mysqli_query($con, $query);
            move_uploaded_file($_FILES["hotnew_image"]["tmp_name"], "upload/hotnew_images/" . $_FILES["hotnew_image"]["name"]);
            $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อยแล้ว";
            header('Location: news1.php');
        }
    } elseif ($namepic == "") {
        $query = "UPDATE hotnew SET head='$head',detail='$detail' WHERE id='$id' ";
        $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อยแล้ว";
        $result = mysqli_query($con, $query);
        header('Location: news1.php');
    } else {
        $_SESSION['status'] = "แก้ไขข้อมูลไม่เรียบร้อยแล้ว";
        header('refresh:0; url=news1.php');
    }
}
?>