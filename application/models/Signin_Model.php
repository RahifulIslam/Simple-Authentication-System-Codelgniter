<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signin_Model extends CI_Model
{
    public function index($email, $password)
    {
        // Retrieve the user record from the database based on the provided email
        $query = $this->db->get_where('tblusers', array('Email' => $email));
        $user = $query->row();

        // Check if the user exists
        if ($user) {
            // Verify the password
            if (password_verify($password, $user->Password)) {
                // Password is correct, return the user object
                return $user;
            } else {
                // Password is incorrect
                return false;
            }
        } else {
            // User with the provided email doesn't exist
            return false;
        }
    }

    public function get_user_by_email($email)
    {
        // Retrieve the user record from the database based on the provided email
        $query = $this->db->get_where('tblusers', array('Email' => $email));
        return $query->row();
    }

    public function store_reset_token($user_id, $token)
    {
        // Store the reset token in the database for the specified user
        $data = array(
            'user_id' => $user_id,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('password_resets', $data);
    }

    public function verify_reset_token($token)
    {
        // Check if the reset token exists and is not expired
        $query = $this->db->get_where('password_resets', array('token' => $token));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function delete_reset_token($token)
    {
        // Delete the reset token from the database
        $this->db->where('token', $token);
        $this->db->delete('password_resets');
    }

}
