<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Signin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary models and libraries
        $this->load->model('Signin_Model');
        $this->load->library('email');
    }
    public function index()
    {
        //Validation for login form
        $this->form_validation->set_rules('emailid', 'Email id', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $email = $this->input->post('emailid');
            $password = $this->input->post('password');

            $validate = $this->Signin_Model->index($email, $password);
            if ($validate) {
                // print_r($validate);
                $this->session->set_userdata('uid', $validate->id);
                $this->session->set_userdata('fname', $validate->FirstName);
                // var_dump($validate->id);
                // var_dump($this->session->userdata('uid'));
                redirect('profile');
            } else {
                $this->session->set_flashdata('error', 'Invalid login details.Please try again.');
                redirect('signin');
            }
        } else {
            $this->load->view('signin');
        }
    }

    public function forgot_password()
    {
        $this->load->view('forgot_password'); // Load the view for the forgot password form
    }

    public function send_reset_link()
    {
        // Retrieve email from form submission
        $email = $this->input->post('email');

        // Retrieve user record based on email
        $user = $this->Signin_Model->get_user_by_email($email);

        // Check if user exists
        if ($user) {
            // Generate and store reset token
            $token = bin2hex(random_bytes(16)); // Generate a random token
            $this->Signin_Model->store_reset_token($user->id, $token);

            // Construct reset link
            $reset_link = site_url('signin/reset_password?token=' . $token); // Adjust this URL as needed
            var_dump($reset_link);

            // if ($reset_link) {

            //     // exit();
            //     $this->session->set_flashdata('success', 'Successfully generate reset link.');
            // } else {
            //     $this->session->set_flashdata('error', 'Failed to failed to generate reset link.');
            // }
            //     // Email sent successfully
            //     $this->session->set_flashdata('success', 'Password reset link sent to your email.');
            // } else {
            //     // Email sending failed
            //     $this->session->set_flashdata('error', 'Failed to send password reset link.');
            // }
            // Configure email
            // $this->email->from('rahiful@technobd.com', 'Simple Authentication');
            // $this->email->to($email);
            // $this->email->subject('Password Reset');
            // $this->email->message('Click the following link to reset your password: ' . $reset_link);

            // // Send email
            // if ($this->email->send()) {
            //     // Email sent successfully
            //     $this->session->set_flashdata('success', 'Password reset link sent to your email.');
            // } else {
            //     // Email sending failed
            //     $this->session->set_flashdata('error', 'Failed to send password reset link.');
            // }
        } else {
            // User not found
            $this->session->set_flashdata('error', 'User with this email does not exist.');
        }

        // Redirect back to the forgot password form
        // redirect('signin/forgot_password');
    }

    public function reset_password()
    {
        $token = $this->input->get('token');
        // var_dump($token);

        if ($token) {
            // Check if reset token exists and is valid
            $reset_info = $this->Signin_Model->verify_reset_token($token);
            // print_r($reset_info);

            if ($reset_info) {
                // Reset token is valid, load the password reset form
                $this->load->view('reset_password');
            } else {
                // Invalid or expired reset token
                $this->session->set_flashdata('error', 'Invalid or expired reset token.');
                redirect('signin/forgot_password');
            }
        } else {
            // Token not provided
            $this->session->set_flashdata('error', 'Reset token not provided.');
            redirect('signin/forgot_password');
        }
    }

    public function update_password()
    {
        // Retrieve token and new password from form submission
        $token = $this->input->post('token');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        // Verify if passwords match
        if ($new_password != $confirm_password) {
            $this->session->set_flashdata('error', 'Passwords do not match.');
            redirect('signin/reset_password?token=' . $token);
        }

        // Verify reset token
        $reset_info = $this->Signin_Model->verify_reset_token($token);

        if ($reset_info) {
            // Reset token is valid, hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password in database
            $this->db->where('id', $reset_info->user_id);
            $this->db->update('tblusers', array('Password' => $hashed_password));

            // Delete reset token
            $this->Signin_Model->delete_reset_token($token);

            // Redirect to login page with success message
            $this->session->set_flashdata('success', 'Password updated successfully. You can now login with your new password.');
            redirect('signin');
        } else {
            // Invalid or expired reset token
            $this->session->set_flashdata('error', 'Invalid or expired reset token.');
            redirect('signin/forgot_password');
        }
    }





}