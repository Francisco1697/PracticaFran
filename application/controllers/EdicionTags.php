<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class EdicionTags extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cosas_model");
	}

    public function index()
	{
		$data['tags'] = $this->Cosas_model->consultaTags();
	
		$this->load->view('ediciontags_view',$data);
	}

    public function actualizarTags()
	{
	}

}