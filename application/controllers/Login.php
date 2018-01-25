<?php
defined('BASEPATH') OR exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Login_model');
    }

    public function index()
    {// Show login page
        $data['header'] = $this->load->view('clientes_header_view');
			  $data['footer'] = $this->load->view('clientes_footer_view');
        $this->load->view('user_login_view', $data);
    }

    public function user_registration_show()
    {// Show registration page
        $this->load->view('registration_form');
    }

    public function new_user_registration()
    {// Validate and store registration data in database
        // Check validation for user input in SignUp form
        set_rules('username', 'Username', 'trim|required|xss_clean');
        set_rules('email_value', 'Email', 'trim|required|xss_clean');
        set_rules('password', 'Password', 'trim|required|xss_clean');

        if (run() == FALSE)
        {
            $this->load->view('registration_form');
        }
        else
        {
            $data = array(
              'user_name' => $this->input->post('username'),
              'user_email' => $this->input->post('email_value'),
              'user_password' => $this->input->post('password')
            );
            $result = $this->Login_model->registration_insert($data);

            if ($result == TRUE)
            {
                $data['message_display'] = 'Registration Successfully !';
                $this->load->view('user_login_view', $data);
            }
            else
            {
                $data['message_display'] = 'Username already exist!';
                $this->load->view('registration_form', $data);
            }
        }
    }

    public function user_login_process()
    {// Check for user login process
        $this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');

        $data['header'] = $this->load->view('clientes_header_view');
			  $data['footer'] = $this->load->view('clientes_footer_view');
        // if ($this->form_validation->run() == FALSE)
        // {
        //     if (isset($this->session->userdata['logged_in']))
        //     {
        //         $this->load->view('clientes_listado_view', $data);
        //     }
        //     else
        //     {
        //         $this->load->view('user_login_view', $data);
        //     }
        // }
        // else
        // {
             $data = array(
               'username' => $this->input->post('user'),
               'password' => $this->input->post('pass')
             );
             $result = $this->Login_model->login($data);

             if ($result == TRUE)
             {
                 $username = $this->input->post('user');
                 $result = $this->Login_model->read_user_information($username);

        //         if ($result != false)
        //         {
                     $session_data = array(
                       'user' => $result[0]->user_name
                     );
                     // Add user data in session
                     $this->session->set_userdata('logged_in', $session_data);
                     $this->load->view('clientes_listado_view', $data);
        //         }
             }
             else
             {
                 $data = array(
                   'error_message' => 'Usuario o clave inválida.'
                 );
                 $this->load->view('user_login_view', $data);
             }
      //  }
    }

    public function logout()
    {    // Logout from admin page. Removing session data
        $sess_array = array(
          'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('user_login_view', $data);
    }

}
?>
