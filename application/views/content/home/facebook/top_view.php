<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title fa fa-facebook-square">  Top 5</h3>
        <div class="box-tools pull-right">
            <span class="label label-primary"><?php echo $type; ?></span>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php
            if ($top->num_rows() > 0) {
                $i = 0;
                foreach ($top->result_array() as $row) {
                    echo "<li class='item'>";
                    echo "<div class='product-img'>";
                    echo "<img src='" . $row["pg_image"] . "' alt='Product Image'>";
                    echo "</div>";
                    echo "<div class='product-info'>";
                    echo "<a href='" . FACEBOOK . $row["pg_id"] . "' class='product-title' target='_blank'>" . $row["pg_name"]
                    . "<div class='fa fa-thumbs-up pull-right'> " . number_format($row['pg_likes'], 0, '.', ',') . " </div></a>";
                    echo "<span class='product-description'>";
                    $location = $row["pg_location"];
                    if ($location== "NULL")
                        $location = "No Description";
                    echo "<div class='fa fa-map-marker'> " . $location . " </div>";
                    echo "</span>";
                    echo "</div>";
                    echo "</li>";
                }
            }else {
                echo "<i><b>NO RESULT</b></i>";
            }
            ?>


            <!--            <li class='item'>
                            <div class='product-img'>
                                <img src='dist/img/default-50x50.gif' alt='Product Image'>
                            </div>
                            <div class='product-info'>
                                <a href='' class='product-title'>Samsung TV <div class='fa fa-thumbs-up pull-right'> 360 </div></a>
                                <span class='product-description'>
                                    
                                    <div class='fa fa-map-marker'> Jakarta Pusat, Indonesia </div>
                                </span>
                            </div>
                        </li>-->
            <!-- /.item -->

        </ul>
    </div><!-- /.box-body -->

</div>