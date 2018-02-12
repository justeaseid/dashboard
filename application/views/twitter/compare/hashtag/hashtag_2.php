<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Trends</h3>
        <div class="box-tools pull-right">
            <span class="label label-warning"><?php echo $type; ?></span>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php
            $count = count($hashtags2);
            if ($count > 0) {
                $i=0;
                foreach ($hashtags2 as $row) {
                    $word = $row["key"];
                    $counter = $row["value"];
                    echo "<li class='item'>";
                    echo "<div class=''>";
                    echo "<a href='" . TWITTER ."hashtag/". $word . "' class='product-title' target='_blank'>#" . $word
                    . "<div class='fa fa-twitter pull-right'> " . number_format($counter, 0, '.', ',') . " </div></a>";
                    echo "</div>";
                    echo "</li>";
                    if($i==5)
                        break;
                    $i++;
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