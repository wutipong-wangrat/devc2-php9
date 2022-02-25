<?php include('admin/includes/dbconnect.php'); ?>

<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>
<?php include("includes/headertop.php"); ?>


<?php
$id = $_GET['id'];
$sql = "UPDATE hotnew SET hotcount=hotcount+1 WHERE id='$id'";
$result = mysqli_query($con, $sql);
?>


<div class="jumbotron jumbotron-fluid mt-5">
    <div class="container">
        <h2 class="text-secondary">วิทยาลัยเทคนิคตราด</h2>
        <h1>
            <p class="text-info">“ล้ำเลิศวิชาการ ชำนาญงานฝีมือ ยึดถือคุณธรรม”</p>
        </h1>
    </div>
</div>

<!--Card Start-->
<?php
$id = $_GET['id'];
$sql = "select*from hotnew where id='$id' ";
$result = mysqli_query($con, $sql);
$rs = mysqli_fetch_array($result);
$head = $rs['head'];
$detail = $rs['detail'];
$date = $rs['date'];
$namedoc = $rs['namedoc'];
$namepic = $rs['namepic'];
$hotcount = $rs['hotcount'];
$design = $rs['design'];
?>
<!--Schetdual Start-->
<div class="container mt-2 mb-5" style="padding-top:10px">

    <div class="row">
        <div class="col-md-12">
            <!-- Card -->
            <div class="card shadow">
                <div class="card-body d-flex flex-row ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="images/vec.png" class="rounded-circle mr-3" width="100px" alt="avatar">
                            </div>
                            <div class="col-md-8">
                                <h4 class="card-title blue-text mt-3 ml-2 "><?php echo $head; ?></h4>
                                <p class="card-text"><i class="far fa-clock pr-2"></i>
                                    <?php
                                    echo " 
                                            $date
                                            เขียนโดย 
                                            <b>$design</b>
                                             &nbsp;|&nbsp;ผู้เข้าชม $hotcount<br>";
                                    echo "เอกสารดาวน์โหลด : <a href='admin/upload/hotnew_docs/$namedoc'>แนบไฟล์</a>";
                                    ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <?php
                echo "
                    <div class='card-body card-body-cascade'>
                        <h5 class='font-weight-bold indigo-text py-2 text-success'>วิทยาลัยเทคนิคตราด</h5>
                        <p class='card-text'>$detail</p>
                    </div>";
                ?>

                <?php
                if ($namepic != "") {
                    echo "<hr>";
                    echo "<div class='view view-cascade overlay'>";
                    echo "<center><img src='admin/upload/hotnew_images/$rs[namepic]' width=50%> </center>";
                    echo "<a href='admin/upload/hotnew_images/$namepic'>";
                    echo "<div class='mask rgba-white-slight'></div></a>";
                    echo "</div>";
                }
                ?>

            </div>
            <!-- Card -->
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>