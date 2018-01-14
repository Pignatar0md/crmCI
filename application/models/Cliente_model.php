<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil();
        $this->load->helper('file');
    }

    function obtener_clientes_para_csv($data)// boton Descargar .csv
    {
        if ($data['tel1'])
        {
            $this->db->where('tel1', $data['tel1']);
        } elseif ($data['agcod'])
        {
            $this->db->where('agcod', $data['agcod']);
        } elseif ($data['fecha_registracion'])
        {
            $date = explode('-', $data['fecha_registracion']);
            $date[0] = trim($date[0]);
            $date[1] = trim($date[1]);
            $date[0] = explode('/', $date[0]);
            $date[1] = explode('/', $date[1]);
            $date[0] = array_reverse($date[0]);
            $date[1] = array_reverse($date[1]);
            $date[0] = implode('-', $date[0]);
            $date[1] = implode('-', $date[1]);
            $this->db->where('fecha_registracion >', $date[0]);
            $this->db->where('fecha_registracion <', $date[1]);
        }
        $result = $this->db->get('clientes');
        $csvData = $this->dbutil->csv_from_result($result);
        write_file('/var/www/html/crm/application/download/csv_result.csv', $csvData);
    }

    function obtener_clientes_por($data)// boton Buscar
    {
        if ($data['tel1'])
        {
            $this->db->where('tel1', $data['tel1']);
        } elseif ($data['agcod'])
        {
            $this->db->where('agcod', $data['agcod']);
        } elseif ($data['fecha_registracion'])
        {
            $date = explode('-', $data['fecha_registracion']);
            $date[0] = trim($date[0]);
            $date[1] = trim($date[1]);
            $date[0] = explode('/', $date[0]);
            $date[1] = explode('/', $date[1]);
            $date[0] = array_reverse($date[0]);
            $date[1] = array_reverse($date[1]);
            $date[0] = implode('-', $date[0]);
            $date[1] = implode('-', $date[1]);
            $this->db->where('fecha_registracion >', $date[0]);
            $this->db->where('fecha_registracion <', $date[1]);
        }
        $result = $this->db->get('clientes');
        return $result->result_array();
    }

    function obtener_detalle_cliente($data) // boton + Info
    {
        $this->db->where('id', $data);
        $result = $this->db->get('clientes');
        return $result->result_array();
    }

    function guardar_cliente($data) // boton Guardar y ready!
    {
        $this->db->insert(
          'clientes',
          array(
            "nom" => $data['nom'],
            "direc" => $data['direc'],
            "localid" => $data['localid'],
            "codpostal" => $data['codpostal'],
            "pcia" => $data['pcia'],
            "tel1" => $data['tel1'],
            "tel2" => $data['tel2'],
            "tel3" => $data['tel3'],
            "email" => $data['email'],
            "agcod" => $data['agcod'],
            "selReg" => $data['selReg'],
            "selPub" => $data['selPub'],
            "obsC" => $data['obsC'],
            "selCalif" => $data['selCalif'],
            "sipextension" => $data['sipext'],
            "uniqueid" => $data['uniqueid'],
            "fecha_registracion" => date("Y-m-d")
          )
        );
    }

    function actualizar_cliente($data) // boton Actualizar
    {
        $this->db->where('id', $data['id']);
        $this->db->update(
          'clientes',
          array(
            "nom" => $data['nom'],
            "direc" => $data['direc'],
            "localid" => $data['localid'],
            "codpostal" => $data['codpostal'],
            "pcia" => $data['pcia'],
            "tel1" => $data['tel1'],
            "tel2" => $data['tel2'],
            "tel3" => $data['tel3'],
            "email" => $data['email'],
            "selReg" => $data['selReg'],
            "selPub" => $data['selPub'],
            "obsC" => $data['obsC'],
            "selCalif" => $data['selCalif']
          )
        );
    }
 }
?>
