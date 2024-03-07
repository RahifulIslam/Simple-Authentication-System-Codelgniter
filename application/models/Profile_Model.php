<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_Model extends CI_Model
{
    public function get_user_data($uid)
    {
        // Fetch user data from the database based on UID
        $query = $this->db->get_where('tblusers', array('id' => $uid));
        return $query->row();
    }

    public function verify_password($uid, $password)
    {
        // Fetch hashed password from the database based on UID
        $query = $this->db->get_where('tblusers', array('id' => $uid));
        $user = $query->row();

        // Verify the provided password with the hashed password
        if ($user) {
            return password_verify($password, $user->Password);
        }

        return false;
    }

    public function update_password($uid, $new_password)
    {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $data = array(
            'Password' => $hashed_password
        );
        $this->db->where('id', $uid);
        return $this->db->update('tblusers', $data);
    }
}
