<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab"><?php echo $title; ?> Settings</a></li>
        </ul>

        <div class="tab-content">
            <?php echo $status; ?>
            <form class="form-horizontal" action="<?php echo base_url('/article/edit_article/'.$url.'/1') ?>" method="post">
                <input type="hidden" name="data_id" value="<?php echo $article_id;?>" />
                <div class="form-group">
                    <label for="inputBio" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="user_id" id="inputUserID">
                            <?php
                            if ($user_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($user_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($user_id == "") {
                                            echo '<option value="1" selected="selected">-- Name --</option>';
                                        } else {
                                            echo '<option value="' . $user_id . '" selected="selected">-- Name --</option>';
//                                            echo '<option value="' . $user_id . '" selected="selected">' . $name . '</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['user_id'] . '">' . $row['name'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCategory" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="category_id" id="inputCategory">
                            <?php
                            if ($category_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($category_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($category_id == "") {
                                            echo '<option value="1" selected="selected">-- Category --</option>';
                                        } else {
                                            echo '<option value="' . $category_id . '" selected="selected">-- Category --</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['category_id'] . '">' . $row['name'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputTitle" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputTitle" name="titles" value="<?php echo $titles;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSummary" class="col-sm-2 control-label">Summary</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="inputSummary" name="summary"><?php echo $summary;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputContent" class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="10" id="inputContent" name="content"><?php echo $content;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPublished" class="col-sm-2 control-label">Published</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="is_published" id="inputPublished">
                            <?php
                            if ($is_published == "") {
                                echo '<option value="no" selected="selected">-- Published --</option>';
                            } else {
                                echo '<option value="' . $is_published . '" selected="selected">' . $is_published . '</option>';
                            }
                            ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputScheduled" class="col-sm-2 control-label">Scheduled</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="is_scheduled" id="inputScheduled">
                            <?php
                            if ($is_scheduled == "") {
                                echo '<option value="no" selected="selected">-- Scheduled --</option>';
                            } else {
                                echo '<option value="' . $is_scheduled . '" selected="selected">' . $is_scheduled . '</option>';
                            }
                            ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPromoted" class="col-sm-2 control-label">Promoted</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="is_promoted" id="inputPromoted">
                            <?php
                            if ($is_promoted == "") {
                                echo '<option value="no" selected="selected">-- Promoted --</option>';
                            } else {
                                echo '<option value="' . $is_promoted . '" selected="selected">' . $is_promoted . '</option>';
                            }
                            ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPP" class="col-sm-2 control-label">Thumbnail</label>
                    <div class="col-sm-10">
                        <input type="file" id="inputPP" name="thumbnail">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-danger" onclick="window.history.go(-1); return false;">
                            <i class="fa "></i> Back
                        </button>
                        <button type="submit" class="btn btn-primary">Edit</button>

                    </div>
                </div>
            </form>
            <!--</div>-->

        </div>

    </div>
</div>