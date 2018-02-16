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
                    $this->load->view('content/edit/edit_user');
                } else if ($value == "level") {
                    $this->load->view('content/tables/table_level');
                } else if ($value == "add_level") {
                    $this->load->view('content/add/add_level');
                } else if ($value == "edit_level") {
                    $this->load->view('content/edit/edit_level');
                } else if ($value == "tag") {
                    $this->load->view('content/tables/table_tag');
                } else if ($value == "add_tag") {
                    $this->load->view('content/add/add_tag');
                } else if ($value == "edit_tag") {
                    $this->load->view('content/edit/edit_tag');
                } else if ($value == "category") {
                    $this->load->view('content/tables/table_category');
                } else if ($value == "add_category") {
                    $this->load->view('content/add/add_category');
                } else if ($value == "edit_category") {
                    $this->load->view('content/edit/edit_category');
                } else if ($value == "operational") {
                    $this->load->view('content/tables/table_operational');
                } else if ($value == "add_operational") {
                    $this->load->view('content/add/add_operational');
                } else if ($value == "edit_operational") {
                    $this->load->view('content/edit/edit_operational');
                } else if ($value == "payment") {
                    $this->load->view('content/tables/table_payment');
                } else if ($value == "add_payment") {
                    $this->load->view('content/add/add_payment');
                } else if ($value == "edit_payment") {
                    $this->load->view('content/edit/edit_payment');
                } else if ($value == "lawyer") {
                    $this->load->view('content/tables/table_lawyer');
                } else if ($value == "add_lawyer") {
                    $this->load->view('content/add/add_lawyer');
                } else if ($value == "edit_lawyer") {
                    $this->load->view('content/edit/edit_lawyer');
                } else if ($value == "log") {
                    $this->load->view('content/tables/table_log');
                } else if ($value == "add_log") {
                    $this->load->view('content/add/add_log');
                } else if ($value == "edit_log") {
                    $this->load->view('content/edit/edit_log');
                } else if ($value == "campaign") {
                    $this->load->view('content/tables/table_campaign');
                } else if ($value == "add_campaign") {
                    $this->load->view('content/add/add_campaign');
                } else if ($value == "edit_campaign") {
                    $this->load->view('content/edit/edit_campaign');
                } else if ($value == "report") {
                    $this->load->view('content/tables/table_report');
                } else if ($value == "add_report") {
                    $this->load->view('content/add/add_report');
                } else if ($value == "edit_report") {
                    $this->load->view('content/edit/edit_report');
                } else if ($value == "donation") {
                    $this->load->view('content/tables/table_donation');
                } else if ($value == "add_donation") {
                    $this->load->view('content/add/add_donation');
                } else if ($value == "edit_donation") {
                    $this->load->view('content/edit/edit_donation');
                }
                ?>
            </div>
        </div>
    </section>
</div>
