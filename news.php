<?php include('admin/includes/dbconnect.php'); ?>

<!--News Start-->
<div class="container my-3 py-3">
    <div class="shadow-lg p-3 mb-4 bg-body rounded">


        <div class="row">
            <div class="col-sm-12">
                <div class="ml-4">
                    <h2>ข่าวประชาสัมพันธ์ </h2>
                    <div class="underline ml-auto mb-4"></div>
                </div>

                <?php
                $Title = 'วิทยาลัยเทคนิคตราด';
                $sql = "select*from hotnew order by id  desc Limit 0,4";
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);
                $i = 0;
                while ($rs = mysqli_fetch_array($result)) {
                    $i++;
                    $id1[$i] = $rs['id'];
                    $date1[$i] = $rs['date'];
                    $head1[$i] = $rs['head'];
                    $detail1[$i] = $rs['detail'];
                    $namepic[$i] = $rs['namepic'];
                    $namedoc[$i] = $rs['namedoc'];
                    $hotcount1[$i] = $rs['hotcount'];
                }

                echo '<div class="row">';
                for ($i = 1; $i <= $num; $i++) {
                    echo "
                <div class='col-sm-3 mt-1 mb-2'>
                    <div class='card rounded-bottom shadow'>
                        <div class='view overlay'>
                            <img class='card-img-top' src='admin/upload/hotnew_images/$namepic[$i]'>
                            <a href='hotnews.php?id=$id1[$i]' target='_blank'>
                                <div class='mask rgba-white-slight'></div>
                            </a>
                        </div>

                        <div class='card-body'>
                            <h6 class='card-title'>$head1[$i]</h6>
                            <p class='card-text'></p>
                            <a href='hotnews.php?id=$id1[$i]' target='_blank' class='btn btn-success btn-sm'><h6>รายละเอียด</h6>
                            
                            <div class='mask rgba-white-slight'></div>
                            </a>
                        </div>
                        <div class=' card-footer rounded-bottom bg-primary text-white text-center'>
                            <ul class='list-unstyled list-inline font-small'>
                                <li class='list-inline-item pr-1 white-text'><i class='far fa-clock fa-xs pr-1'></i>$date1[$i]</li>
                                <li class='list-inline-item pr-1 white-text xs-text' style='font-size: 13px;'><i class='fas fa-user-friends fa-sm mr-1'></i>$hotcount1[$i]</li>
                            </ul>
                    </div>
                    </div>
                </div>";
                }
                echo '</div><hr>';
                if ($i > 4) {
                    echo "
                    <span align=right><a href='hotnewslist.php' target='_blank'>
                    <img src='images/comments.jpg' border=0 />..อ่านข่าวทั้งหมด...</a></span>";
                }
                ?>
            </div>

        </div>
    </div>
</div>
<!--News End-->