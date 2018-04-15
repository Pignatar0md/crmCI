<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Pruebas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('Login_model');
        $this->load->model('Cliente_model');
    }

    public function index()
    {
        // $test = 1 + 1;
        // $nom = "uno mas uno";
        // $res_ok = 2;
        // echo $this->unit->run($test, $res_ok, $nom);
        $test_data['username'] = "admin";
        $test_data['password'] = "asdasd123";
        $test_name = "login model function";
        $result = $this->Login_model->login($test_data);
        $test_data = null;
        $expected_result = TRUE;
        echo $this->unit->run($result, $expected_result, $test_name);
        //Login-----^
        $test_data['tel1'] = "4556060";
        $test_data['agcod'] = "49";
        $test_data['fecha_registracion'] = "01/04/2018 - 03/04/2018";
        $test_name = "get_clients model function";
        $result = $this->Cliente_model->obtener_clientes_por($test_data);
        $expected_result = 'is_array';
        echo $this->unit->run($result, $expected_result, $test_name);
        //Obtener clientes-----^
        $test_data['csv'] = TRUE;
        $test_name = "get_clients_to_csv model function";
        $result = $this->Cliente_model->obtener_clientes_por($test_data);
        $expected_result = 'is_object';
        echo $this->unit->run($result, $expected_result, $test_name);
        //Obtener clientes para csv-----^
        $test_name = "creates csv function";
        $result = $this->Cliente_model->obtener_clientes_por($test_data);
        $res = $this->Cliente_model->obtener_clientes_para_csv($result);
        //var_dump($res);
        $test_data = null;
        $my_file = fopen("/var/www/html/crm/application/download/csv_result.csv", "r");
        $result = null;
        if(!feof($my_file))
        {
            $result = fgets($my_file);
        }
        fclose($my_file);
        $result = is_string($result);
        $expected_result = 'is_string';
        echo $this->unit->run($result, $expected_result, $test_name);
        //Crea archivo csv-----^
    }
}
