<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class EdicionTags extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Tags_model");
	}

    public function index()
	{
		$data['tags'] = $this->Tags_model->consultaTags();
	
		$this->load->view('ediciontags_view',$data);
	}

    public function actualizarTag($id)
	{
		$nombre = $this->input->post('nombre');

		$this->Tags_model->actualizarTag($id,$nombre);

		redirect('/EdicionTags');
	}

	public function eliminarTag() {

		$id = $this->input->post('id');

		$resultado = $this->Tags_model->eliminarTag($id);

		if ($resultado) {
			redirect('/EdicionTags');
		} else {
			$this->load->view('nosepuedeborrar_view');
		}
	}

	public function agregarTag() {

		$nombretag = $this->input->post('nombre');

		$this->Tags_model->agregarTag($nombretag);

		redirect('/EdicionTags');
	}
}