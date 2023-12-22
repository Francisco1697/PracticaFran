<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EdicionCosa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cosas_model");
	}

    public function index($id)
	{
		$data['cosa'] = $this->Cosas_model->getCosa($id);
		$data['tags'] = $this->Tags_model->consultaTags();
		$data['tagsAsociados'] = $this->Tags_model->getTagsIdPorCosa($id);

		$this->load->view('edicion_view',$data);
	}	

	public function updatear($id)
	{
		$nombre = $this->input->post('nombre');
    	$cantidad = $this->input->post('cantidad');
		$opciones = $this->input->post('opciones[]');

		$data = array(
			"nombre" => $nombre,
			"cantidad" => $cantidad,
			"opciones[]" => $opciones
		);

		$this->Cosas_model->updatear($data, $id);

		redirect('/Registro');
	}
}