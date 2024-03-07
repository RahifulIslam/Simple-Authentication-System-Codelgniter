<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function index() {
        // Destroy session data
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('fname');
        // Redirect to login page
        redirect('signin');
    }
}
