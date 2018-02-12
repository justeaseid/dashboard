<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title fa fa-instagram">  Top 5</h3>
        <div class="box-tools pull-right">
            <span class="label label-primary"><?php echo $type; ?></span>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php
            if ($itop->num_rows() > 0) {
                $i = 0;
                foreach ($itop->result_array() as $row) {
                    echo "<li class='item'>";
                    echo "<div class='product-img'>";
                    echo "<img src='" . $row["pg_image"] . "' alt='Product Image'>";
                    echo "</div>";
                    echo "<div class='product-info'>";
                    echo "<a href='" . INSTAGRAM . $row["pg_username"] . "' class='product-title' target='_blank'>" . $row["pg_username"]
                    . "<div class='fa fa-users pull-right'> " . number_format($row['pg_followers'], 0, '.', ',') . " </div></a>";
                    echo "<span class='product-description'>";
                    $location = "NULL";
                    if ($location == "NULL")
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

        </ul>
    </div><!-- /.box-body -->

</div>