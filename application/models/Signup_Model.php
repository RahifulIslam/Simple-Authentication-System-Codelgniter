<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup_Model extends CI_Model
{
    public function index($fname, $lname, $emailid, $password)
    {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'FirstName' => $fname,
            'LastName' => $lname,
            'Email' => $emailid,
            'Password' => $hashed_password // Use the hashed password
        );
        $query = $this->db->insert('tblusers', $data);
        if ($query) {
            $this->session->set_flashdata('success', 'Registration successfull, Now you can login.');
            redirect('signup');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('signup');
        }
    }
}