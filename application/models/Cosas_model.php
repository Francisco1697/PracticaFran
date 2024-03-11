<?php
defined('BASEPATH') OR exit('No direct script access allowed');


#[AllowDynamicProperties]
class Cosas_model extends CI_Model {

    public function __construct()
    {
        $this->load->model('Tags_model');
        $this->load->library('session');
    }

    public function consultaBase()
    {
        return $this->buscarPorNombre(null);      
    }

    public function agregarRegistro($data) 
    {
        $this->db->trans_start();

        $this->db->insert("cosas",[
            'nombre' => $data['nombre'],
            'cantidad' => $data['cantidad'],
            'created_by' => $data['user_id'],
            'created_at' => $data['fecha_actual']
        ]);
        
        $cosa_id = $this->db->insert_id();

        if ($data['opciones'] != null) {
            foreach ($data['opciones'] as $dato) {

                $array = array(
                    'cosas_id' => $cosa_id,
                    'tags_id' => $dato
                );
                $this->db->insert("cosas_tags",$array);

            }
        }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback(); 
            } else {
                $this->db->trans_commit(); 
            }
    }

    public function eliminarCosa($id,$data) 
    {
        $this->db->where('id', $id);
        $this->db->update('cosas',[
            'borrado_logico' => '1',
            'deleted_by' => $data['user_id'],
            'deleted_at' => $data['fecha_actual'],
        ]);
    }

    public function getCosa($id)
    {
        $this->db->select("c.*");
        $this->db->from("cosas c");
        $this->db->where("c.id",$id);
        $results=$this->db->get();
        return $results->row();
    }

    public function getTodasLasCosas()
    {
        $query = $this->db->where('borrado_logico = 0');
	    $query = $this->db->get('cosas');
	    $cosas = $query->result();

        foreach ($cosas as $key => $cosa) {
            $cosas[$key]->tags= $this->Tags_model->buscarTagsPorCosa($cosa->id);
        }
        return $cosas;
    }

    public function getTag($id)
    {
        $this->db->select("c.*");
        $this->db->from("tags c");
        $this->db->where("c.id",$id);
        $results=$this->db->get();
        return $results->row();
    }

    public function updatear($data, $id) 
    {
        $this->db->trans_start();

        $this->db->where('id', $id);
        $this->db->update('cosas',[
            'nombre' => $data['nombre'],
            'cantidad' => $data['cantidad'],
            'modified_by' => $data['user_id'],
            'modified_at' => $data['fecha_actual']
        ]);

        $this->Tags_model->eliminarTagsDeCosas($id);

        $this->Tags_model->agregarTagsACosa($id,$data['opciones[]']);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback(); 
        } else {
            $this->db->trans_commit(); 
        }
    }

    public function buscarPorNombre($nombre) 
    {
        if ($nombre !== null ) {
            $this->db->like('nombre', $nombre);
        }
        $this->db->where('borrado_logico = 0');
	    $query = $this->db->get('cosas');
	    $cosas = $query->result();

        foreach ($cosas as $key => $cosa) {
            $cosas[$key]->tags= $this->Tags_model->buscarTagsPorCosa($cosa->id);
        }
        return $cosas;
    }

    public function buscarCosasTags()
    {
        $query = $this->db->get('cosas_tags');
        return $query->result();
    }
}

