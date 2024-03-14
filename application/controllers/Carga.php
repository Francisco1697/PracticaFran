<?php

use Entities\Tags;

defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Carga extends CI_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('doctrine');
		$this->load->model('Cosas_model');
		$this->load->model('Tags_model');
	}

    public function index()
	{
		//$query = $this->db->get('cosas');
		//$data['datos'] = $query->result();

		$data['datos'] = $this->doctrine->em->getRepository(Tags::class)->findAll();

		$this->load->view('carga_view', $data);
	}	

	public function submit()
	{
    	$nombre = trim($this->input->post('nombre'));
    	$cantidad = (int) $this->input->post('cantidad');
		$tagsId = (array) $this->input->post('opciones[]');

		$resultado = $this->Cosas_model->agregarRegistro($nombre, $cantidad, $tagsId);

		if ($resultado) {
			echo <<<HTML
			<script>
				alert('La cosa se creó correctamente')
				window.location.href='/Registro'
			</script>
			HTML;
		} else {
			echo <<<HTML
			<script>
				alert('Ya existe una cosa con ese nombre')
				window.location.href='/Carga/index'
			</script>
			HTML;
		}
	}

	public function eliminarCosa()
	{
		$id = $this->input->post('id');
		
		$resultado = $this->Cosas_model->eliminarCosa($id);
		
		if ($resultado) {
			echo <<<HTML
			<script>
				alert('La cosa se eliminó correctamente')
				window.location.href='/Registro'
			</script>
			HTML;
		} else {
			echo <<<HTML
			<script>
				alert('La cosa no se pudo eliminar')
				window.location.href='/Registro'
			</script>
			HTML;
		}
	}
}