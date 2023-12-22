<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carga extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cosas_model");
	}

    public function index()
	{
		//$query = $this->db->get('cosas');
		//$data['datos'] = $query->result();

		$data['datos'] = $this->Tags_model->consultaTags();

		$this->load->view('carga_view', $data);
	}	

	public function agregarRegistro()
	{
    	$nombre = $this->input->post('nombre');
    	$cantidad = $this->input->post('cantidad');
		$opciones = $this->input->post('opciones[]');		

    	$data = array(
    	    'nombre' => $nombre,
    	    'cantidad' => $cantidad,
			'opciones' => $opciones
    	);
		
		$this->Cosas_model->agregarRegistro($data);

    	redirect('/Registro');  
	}

	public function eliminar()
	{
		$id = $this->input->post('id');
		
		$this->Cosas_model->eliminar($id);
		
		redirect('/Registro');
	}
}