<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Carga extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cosas_model");
		$this->load->library('session');
	}

    public function index()
	{
		//$query = $this->db->get('cosas');
		//$data['datos'] = $query->result();

		$data['datos'] = $this->Tags_model->consultaTags();

		$this->load->view('carga_view', $data);
	}	

	public function getFechaActual() {
		return (date('Y-m-d H:i:s'));
	}

	public function agregarRegistro()
	{
    	$nombre = $this->input->post('nombre');
    	$cantidad = $this->input->post('cantidad');
		$opciones = $this->input->post('opciones[]');
		$user_id = $this->session->userdata('user_id');
		$fecha_actual = $this->getFechaActual();

    	$data = array(
    	    'nombre' => $nombre,
    	    'cantidad' => $cantidad,
			'opciones' => $opciones,
			'user_id' => $user_id,
			'fecha_actual' => $fecha_actual
    	);
		
		$this->Cosas_model->agregarRegistro($data);

    	redirect('/Registro');  
	}

	public function eliminarCosa()
	{
		$id = $this->input->post('id');
		$user_id = $this->session->userdata('user_id');
		$fecha_actual = $this->getFechaActual();

		$data = array(
			'user_id' => $user_id,
			'fecha_actual' => $fecha_actual
		);
		
		$this->Cosas_model->eliminarCosa($id,$data);
		
		redirect('/Registro');
	}
}