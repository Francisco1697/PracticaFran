<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Error404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function error_404() {
        $this->output->set_status_header('404');
        $this->load->view('404_view');
    }
}
