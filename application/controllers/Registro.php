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
		/*$data['datos']= $this->Cosas_model->consultaBase();
		$data['cosas_tags'] = $this->Cosas_model->buscarCosasTags();
		$data['tags'] = $this->Cosas_model->consultaTags();
		foreach ($data['datos'] as $k => $cosa) {
			foreach ($data['cosas_tags'] as $k2 => $cosatag) {		
				if ($cosa->id == $cosatag->cosas_id) {					
					foreach ($data['tags'] as $k3 => $tag) {
						if ($cosatag->tags_id == $tag->id) {
							$data['datos'][$k]->tag[] = $tag;
						}
					}
				}
			}
		}*/
	

		$data['cosas'] = $this->Cosas_model->buscarPorNombre(
			$this->input->get('search')
		);
		$this->load->view('registro_view', $data);

	}
}


