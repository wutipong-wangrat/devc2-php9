<?php include("security.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/topbar.php"); ?>

<?php include("includes/dbconnect.php"); ?>


<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight-bold text-primary">Admin Edit News</h5>
        </div>
        <div class="card-body">
        <?php
            if (isset($_POST['news_editbtn'])) {
                $id = $_POST['news_edit_id'];
                $query = "SELECT * FROM hotnew WHERE id='$id' ";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);
            }
            ?>
        
            <form action="news_code.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="updateting_id" value="<?php echo $row['id']; ?>">

                <div class="form-group">
                    <label>หัวข้อข่าว</label>
                    <textarea name="edit_head" cols="20" rows="2" class="form-control"><?php echo $row['head']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>รายละเอียด</label>
                    <textarea rows="4" cols="50" name="edit_detail" class="form-control"><?php echo $row['detail'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Edit Upload Image</label>
                    <img src="upload/hotnew_images/<?php echo $row['namepic']; ?>" width="100px;" class="img-rounded">
                    <input type="hidden" name="hotnew_image" value="<?php echo $row["namepic"]; ?>">
                    <input type="file" name="hotnew_image" class="form-control">
                </div>
                <a href="news1.php" class="btn btn-danger">CANCEL</a>
                <button type="submit" name="news_update" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>

</div>


<?php include("includes/footer.php"); ?>
<?php include("includes/logoutmodal.php"); ?>
<?php include("includes/script.php"); ?>