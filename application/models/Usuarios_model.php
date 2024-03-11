<?php
defined('BASEPATH') OR exit('No direct script access allowed');


#[AllowDynamicProperties]
class Usuarios_model extends CI_Model {

    public function verificar_credenciales($datos) {

        $this->db->where('username', $datos['username']);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() === 0) {
            return false;
        }
        
        $usuario = $query->row();
 
        return password_verify($datos['contraseña'], $usuario->contraseña);
    }

    public function guardar_usuario($datos) {

        $this->db->insert("usuarios",$datos);

    }

    public function getUserIDByUsername($username) {

        $this->db->select("u.id");
        $this->db->from("usuarios u");
        $this->db->where("u.username",$username);
        $results=$this->db->get();
        return $results->result();
    }

}