<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($value == "user") {
                    $this->load->view('content/tables/table_user');
                } else if ($value == "add_user") {
                    $this->load->view('content/add/add_user');
                } else if ($value == "edit_user") {
                    $this->load->view('content/edit/eidt_user');
                }
                ?>
            </div>
        </div>
    </section>
</div>