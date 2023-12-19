<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edicion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cosas_model");
	}

    public function index($id)
	{
		$data = $this->Cosas_model->getCosa($id);
		//$vars = [
		//	"id" => $id,
		//	"nombre" => $nombre,
		//	"cantidad" => $cantidad
		//];
		$this->load->view('edicion_view',$data);
	}	

	//public function editar($id)
	//{
	//	//$id = $this->input->post("id");
	//	$this->load->view('vista3',$id);
	//}

	public function updatear($id)
	{
		$nombre = $this->input->post('nombre');
    	$cantidad = $this->input->post('cantidad');

		$data = array(
			"nombre" => $nombre,
			"cantidad" => $cantidad
		);

		$this->Cosas_model->updatear($data, $id);

		redirect('/Registro');
	}
}