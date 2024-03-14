<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class EdicionCosa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cosas_model");
		$this->load->model("Tags_model");
		$this->load->library('session');
	}

    public function index($id)
	{
		$data['cosa'] = $this->Cosas_model->getCosa($id);
		$data['tags'] = $this->Tags_model->buscarTags();

		$this->load->view('edicion_view',$data);
	}	

	public function getFechaActual() {
		return (date('Y-m-d H:i:s'));
	}

	public function updatear($id)
	{
		$nombre = $this->input->post('nombre');
    	$cantidad = $this->input->post('cantidad');
		$opciones = $this->input->post('opciones[]');
		$user_id = $this->session->userdata('user_id');
		$fecha_actual = $this->getFechaActual();

		$data = array(
			"nombre" => $nombre,
			"cantidad" => $cantidad,
			"opciones[]" => $opciones,
			'user_id' => $user_id,
			'fecha_actual' => $fecha_actual
		);

		$this->Cosas_model->updatear($data, $id);

		redirect('/Registro');
	}
}