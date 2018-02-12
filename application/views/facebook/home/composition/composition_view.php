<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Post Composition</h3>
        <div class="box-tools pull-right">
            <span class="label label-primary"><?php echo $type;?></span>
<!--            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="chart-responsive" id="commented_chart">
                    <iframe class="dashboard_analysis" src="<?php echo base_url('/facebook/home_composition/'.$type); ?>"></iframe>
                </div><!-- ./chart-responsive -->
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.box-body -->

</div><!-- /.box -->