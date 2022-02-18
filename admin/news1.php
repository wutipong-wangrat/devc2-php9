<?php include("security.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/topbar.php"); ?>

<?php include("includes/dbconnect.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-warning">ข่าวประชาสัมพันธ์ 1</h1>
        <h4 class="text-success">นายมาร์ก | ผู้พัฒนาเว็บไซต์</h4>
    </div>
    <!-- Content Row -->

    <div class="card shadow">
        <div class="card-header">
            <h6 class="card-title">Add News - ช่าวสาร &nbsp;
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminNews" data-whatever="@mdo">ข่าวประชาสัมพันธ์</button>
            </h6>
        </div>


        <div class="card-body">

            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2  class="bg-danger text-white">' . $_SESSION['status'] . '</h2>';
                unset($_SESSION['status']);
            }
            ?>

            <div class="table-responsive">
                <?php
                $perpage = 4;
                if (isset($_GET['page']) & !empty($_GET['page'])) {
                    $curpage = $_GET['page'];
                } else {
                    $curpage = 1;
                }
                $start = ($curpage * $perpage) - $perpage;
                $PageSql = "SELECT * FROM  hotnew ";
                $pageres = mysqli_query($con, $PageSql);
                $totalres = mysqli_num_rows($pageres);

                $endpage = ceil($totalres / $perpage);
                $startpage = 1;
                $nextpage = $curpage + 1;
                $previouspage = $curpage - 1;

                $query = "SELECT * FROM hotnew ORDER by id DESC LIMIT $start, $perpage";
                $res = mysqli_query($con, $query);
                ?>

                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">หัวข้อ</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">วันเวลา</th>
                            <th>แก้ไข</th>
                            <th>ลบข่าว</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($res)) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $row['head']; ?></php>
                                </td>
                                <td><?php echo $row['detail']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td>
                                    <form action="news_edit.php" method="post">
                                        <input type="hidden" name="news_edit_id" value="<?php echo $row['id'] ?>">
                                        <button type="submit" name="news_editbtn" class="btn btn-success">แก้ไข</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="news_code.php" method="post">
                                        <input type="hidden" name="delete_image" value="<?php echo $row['namepic'] ?>">
                                        <input type="hidden" name="delete_doc" value="<?php echo $row['namedoc'] ?>">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                                        <button type="submit" name="news_deletebtn" class="btn btn-danger">ลบ</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if ($curpage != $startpage) { ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">First</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($curpage >= 2) { ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
                        <?php } ?>
                        <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
                        <?php if ($curpage != $endpage) { ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Last</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>

            </div>
        </div>

    </div>

    <div class="modal fade" id="addAdminNews" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ข่าวประชาสัมพันธ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="news_code.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-form-label">หัวข้อข่าว</label>
                            <textarea name="head" class="form-control" required placeholder="เพิ่ม-หัวข้อข่าว"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">รายละเอียดข่าว:</label>
                            <textarea rows="4" cols="50" name="detail" required class="form-control" placeholder="เพิ่ม-รายละเอียดข่าว"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">รายละเอียดข่าว: เช่น *.jpg,png</label>
                            <input type="file" name="hotnew_image" required class="form-control-file" placeholder="เพิ่ม-รูปภาพ">
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">แนบไฟล์: เช่น *.pdf,doc,xls,ppt,ra</label>
                            <input type="file" name="hotnew_doc" class="form-control-file" placeholder="แนบไฟล์">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="news_save" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include("includes/footer.php"); ?>
<?php include("includes/logoutmodal.php"); ?>
<?php include("includes/script.php"); ?>