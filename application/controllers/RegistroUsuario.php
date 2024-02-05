<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegistroUsuario extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model("Usuarios_model");
	}

    public function index()
	{
		$this->load->view('registrousuario_view');
	}	

    public function agregar_usuario() {

        $username = $this->input->post('username');
        $contrasena = $this->input->post('contrasena'); 
        $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);

        $datos = array(
            'username' => $username,
            'contraseña' => $contrasena_hasheada
        );

        $this->Usuarios_model->guardar_usuario($datos);

        redirect('/Welcome');
    }

}