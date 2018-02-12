<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title fa fa-instagram">  Trends</h3>
        <div class="box-tools pull-right">
            <span class="label label-success"><?php echo $type; ?></span>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php
            $count = count($ihashtags);
            if ($count > 0) {
                $i = 0;
                foreach ($ihashtags as $row) {
                    $word = $row["key"];
                    $counter = $row["value"];
                    echo "<li class='item'>";
                    echo "<div class=''>";
                    echo "<a href='" . IHASHTAG . $word . "' class='product-title' target='_blank'>#" . $word
                    . "<div class='fa fa-instagram pull-right'> " . number_format($counter, 0, '.', ',') . " </div></a>";
                    echo "</div>";
                    echo "</li>";
                    if ($i == 7)
                        break;
                    $i++;
                }
            }else {
                echo "<i><b>NO RESULT</b></i>";
            }
            ?>

        </ul>
    </div><!-- /.box-body -->

</div>