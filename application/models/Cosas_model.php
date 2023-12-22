<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cosas_model extends CI_Model {

    public function __construct()
    {
        $this->load->model('Tags_model');
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

    public function eliminar($id) 
    {
        $this->db->where('cosas_id',$id);
        $this->db->delete('cosas_tags');

        $this->db->where('id', $id);
		$this->db->delete('cosas');
    }

    public function getCosa($id)
    {
        $this->db->select("c.*");
        $this->db->from("cosas c");
        $this->db->where("c.id",$id);
        $results=$this->db->get();
        return $results->row();
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
        $this->db->update('cosas',['nombre' => $data['nombre'],
        'cantidad' => $data['cantidad']]);

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

