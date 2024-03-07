<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary models and libraries
        $this->load->model('Profile_Model');
    }

    public function index()
    {
        if ($this->session->userdata('uid')) {
            $uid = $this->session->userdata('uid');
            // Load user data based on uid
            $user_data = $this->Profile_Model->get_user_data($uid);

            // Pass user data to profile view
            $data['user_data'] = $user_data;
            $this->load->view('profile', $data);
        } else {
            // If uid doesn't exist in the session, redirect to signin page
            redirect('signin');
        }
    }

    public function change_password()
    {
        if ($this->session->userdata('uid')) {
            $this->load->view('change_password');
        } else {
            // If uid doesn't exist in the session, redirect to signin page
            redirect('signin');
        }
    }

    public function update_password()
    {
        if ($this->session->userdata('uid')) {
            $uid = $this->session->userdata('uid');
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');

            // Check if the old password matches the one in the database
            if ($this->Profile_Model->verify_password($uid, $old_password)) {
                // Update the password
                if ($this->Profile_Model->update_password($uid, $new_password)) {
                    // Password updated successfully, redirect to profile page
                    redirect('profile');
                } else {
                    // Password update failed
                    echo "Password update failed.";
                }
            } else {
                // Old password doesn't match
                echo "Old password is incorrect.";
            }
        } else {
            // If uid doesn't exist in the session, redirect to signin page
            redirect('signin');
        }
    }
}
