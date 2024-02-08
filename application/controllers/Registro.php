<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Registro extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cosas_model");
		$this->load->library('session');
	}

    public function index()
	{
		$data['cosas'] = $this->Cosas_model->getTodasLasCosas();

		if ($this->session->userdata('user_id'))
		{
			$this->load->view('registro_view', $data);
		} else {
			redirect('/Welcome');
		}
	}

	public function cerrar_sesion() 
	{
		$this->session->sess_destroy();
		redirect('/Welcome');
	}

	public function buscar_registros()
	{
		$data['cosas'] = $this->Cosas_model->buscarPorNombre(
			$this->input->get('search')
		);

		$this->load->view('registrosub_view', $data);
	}
}


