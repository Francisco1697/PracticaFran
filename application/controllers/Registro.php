<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Registro extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cosas_model");
	}

    public function index()
	{
		$data['cosas'] = $this->Cosas_model->buscarPorNombre(
			$this->input->get('search')
		);
		$this->load->view('registro_view', $data);

	}
}


