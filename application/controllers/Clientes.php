<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/Argentina/Buenos_Aires');

class Clientes extends CI_Controller {

	public function __construct()
	{
		  parent::__construct();
		  $this->load->helper('form');
		  $this->load->model('Cliente_model');
		  $this->load->helper('pauses');
		  $this->load->helper('url');
			$this->load->helper('download');
	}

	public function index()// vista por defecto para supervisor de call
	{
			$data['header'] = $this->load->view('clientes_header_view');
			$data['footer'] = $this->load->view('clientes_footer_view');
			$this->load->view('clientes_listado_view', $data);
	}

	public function get_csv()// manda al navegador la solicitud de descarga del archivo csv
	{												 // el boton "Descargar .csv" llama este metodo
			if ($this->input->post("tel1"))
			{
					$data['tel1'] = $this->input->post("tel1");
			}
			if ($this->input->post("rango_fecha"))
			{
					$data['fecha_registracion'] = $this->input->post("rango_fecha");
			}
			if ($this->input->post("agente"))
			{
					$data['agcod'] = $this->input->post("agente");
			}
			$this->Cliente_model->obtener_clientes_para_csv($data);
		  force_download('/var/www/html/crm/application/download/csv_result.csv', NULL);
	}

	public function get_clientes_por()// trae clientes por tel, fecha de creacion o nro de agente
	{																	// el boton "buscar" llama este metodo
			if ($this->input->get("tel1"))
			{
					$data['tel1'] = $this->input->get("tel1");
			}
			if ($this->input->get("rango_fecha"))
			{
					$data['fecha_registracion'] = $this->input->get("rango_fecha");
			}
			if ($this->input->get("agente"))
	    {
					$data['agcod'] = $this->input->get("agente");
			}
			$datos['lista_clientes_por'] = $this->Cliente_model->obtener_clientes_por($data);
			echo json_encode($datos);
	}

	public function get_detalle_cliente()// trae datos para un solo cliente
	{																		 // el boton "+ info" llama este metodo
			$data['id'] = $this->input->get("id");
			$datos['lista_detalle_cliente'] = $this->Cliente_model->obtener_detalle_cliente($data['id']);
			echo json_encode($datos);
	}

	public function editar_cliente()// muestra el formulario de edicion con los datos del cliente a editar
	{																// el boton "editar" llama este metodo
			$data['id'] = $this->input->get("id");
			$data['cliente'] = $this->Cliente_model->obtener_detalle_cliente($data['id']);
			$this->load->view('clientes_header_view');
			$this->load->view('clientes_footer_view');
			$this->load->view('clientes_editar_view', $data);
	}

	public function alta_form()// llamado por wombat dialer
	{
			$data['sipext'] = $this->uri->segment(3);
			$agcod = $this->uri->segment(4);
			$data['uniqueid'] = $this->uri->segment(5);
			$data['numero'] = $this->uri->segment(6);
			$data['agcod'] = $agcod;
			$this->load->view('clientes_header_view');
			auto_pause($data['sipext']);
			$this->load->view('clientes_alta_view', $data);
			$this->load->view('clientes_footer_view');
	}

	public function save_form()// guarda o actualiza cliente
	{
			$data['nom'] = $this->input->post("nom");
			$data['direc'] = $this->input->post("direc");
			$data['localid'] = $this->input->post("localid");
			$data['codpostal'] = $this->input->post("codpostal");
			$data['pcia'] = $this->input->post("pcia");
			$data['tel1'] = $this->input->post("tel1");
			$data['tel2'] = $this->input->post("tel2");
			$data['tel3'] = $this->input->post("tel3");
			$data['email'] = $this->input->post("email");
			$data['agcod'] = $this->input->post("agcod");
			$data['selReg'] = $this->input->post("selReg");
			$data['selPub'] = $this->input->post("selPub");
			$data['obsC'] = $this->input->post("obsC");
			$data['selCalif'] = $this->input->post("selCalif");
			$data['sipext'] = $this->input->post("sipext");
			$data['uniqueid'] = $this->input->post("uniqueid");
			$data['fecha_registracion'] = date("Y-m-d");

			if($this->input->post("update"))// Si es una actualizacion de cliente
			{
					$data['id'] =  $this->input->post("id");
					$this->Cliente_model->actualizar_cliente($data);
					redirect('');
			}
			else// Si es un nuevo cliente
			{
			    $res = $this->Cliente_model->guardar_cliente($data);
					$mensaje = "Cliente guardado OK";
					$unPauseData["sipext"] = $data['sipext'];
					$unPauseData["agcod"] = $data['agcod'];
					auto_unpause($unPauseData);
					$data = NULL;

					$data['message'] = $mensaje;
					$data['header'] = $this->load->view('clientes_header_view');
					$data['footer'] = $this->load->view('clientes_footer_view');
					$this->load->view('clientes_alta_view', $data);
			}
	}
}
