<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->library('form_validation');
        $this->load->library('session');
	}

	public function index()
	{
		$this->load->view('bienvenida_view');
	}

	public function iniciar_sesion() {
        // Validación de formulario
        $this->form_validation->set_rules('username', 'Usuario', 'required');
        $this->form_validation->set_rules('contrasena', 'Contraseña', 'required');

        if ($this->form_validation->run() == false) {
            // Manejar errores de validación
            // ...
        } else {
            // Verificar credenciales en la base de datos
            $username = $this->input->post('username');
            $contrasena = $this->input->post('contrasena');

			$datos = array(
				'username' => $username,
				'contraseña' => $contrasena
			);

            $usuario_valido = $this->Usuarios_model->verificar_credenciales($datos);

            if ($usuario_valido) {
                // Iniciar sesión y redirigir al usuario
                $userID = $this->Usuarios_model->getUserIDByUsername($username);
                $this->session->set_userdata('user_id', $userID[0]->id);
                redirect('/Registro');
            } else {
                // Credenciales inválidas
                // Manejar el error
                // ...
            }
        }
    }

}
