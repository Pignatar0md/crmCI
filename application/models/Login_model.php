<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login($data)
    {// Read data using username and password
      $this->db->where('user_name', $data['username']);
      $this->db->where('user_password', $data['password']);
      $query = $this->db->get('user_login');

        if ($query->num_rows() == 1)
        {
            return true;
        } else {
            return false;
        }
    }

    public function read_user_information($username)
    {// Read data from database to show data in admin page
        $this->db->where('user_name', $username);
        $query = $this->db->get('user_login');

        if ($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    // Insert registration data in database
    // public function registration_insert($data)
    // {// Query to check whether username already exist or not
    //     $condition = "user_name =" . "'" . $data['user_name'] . "'";
    //     $this->db->select('*');
    //     $this->db->from('user_login');
    //     $this->db->where($condition);
    //     $this->db->limit(1);
    //     $query = $this->db->get();
    //
    //     if ($query->num_rows() == 0)
    //     {// Query to insert data in database
    //         $this->db->insert('user_login', $data);
    //
    //         if ($this->db->affected_rows() > 0)
    //         {
    //             return true;
    //         }
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // }
}
?>
