<?php

use Entities\Tags;

defined('BASEPATH') OR exit('No direct script access allowed');


#[AllowDynamicProperties]
class Tags_model extends CI_Model {

    public function __construct()
    {
		$this->load->library('doctrine');
    }

    public function buscarTagsPorCosa($id) 
    {
        $this->db->select("t.*");
        $this->db->from("cosas_tags ct");
        $this->db->join("tags t", "t.id = ct.tags_id");
        $this->db->where("ct.cosas_id",$id);
        $results=$this->db->get();
        return $results->result();
    }

    public function buscarTags(): array
    {
        $tags = $this->doctrine->em->getRepository(Tags::class)->findAll();
        return $tags;
    }

    public function buscarTagsPorNombre($nombre) {
        $this->db->select("t.id");
        $this->db->from("tags t");
        $this->db->where("t.nombre",$nombre);
        $results=$this->db->get();
        return $results->result();
    }

    public function getTagsIdPorCosa($id) {
        $this->db->select("ct.tags_id");
        $this->db->from("cosas_tags ct");
        $this->db->where("ct.cosas_id",$id);
        $results=$this->db->get();
        $resultado = array_map(function($tag) {
            return $tag->tags_id;
        }, $results->result());
        return $resultado; 
    }

    public function eliminarTagsDeCosas($id) {
        $this->db->where('cosas_id', $id);
        $this->db->delete('cosas_tags');
    }
    
    public function agregarTagsACosa($id,$opciones) {
        foreach ($opciones as $tag) {
            $array = array(
                'cosas_id' => $id,
                'tags_id' => $tag
            );

            $this->db->insert("cosas_tags",$array);
        }
    
    }

    public function actualizarTag($id, $nombre, $user_id, $fecha_actual) {

        $this->db->where('id',$id);
        $this->db->update('tags',['nombre'=>$nombre, 'modified_by'=>$user_id, 'modified_at'=>$fecha_actual]);
    }

    public function eliminarTag($id) {

        $this->db->select("ct.*");
        $this->db->from("cosas_tags ct");
        $this->db->where("ct.tags_id",$id);
        $results=$this->db->get();

        if ($results->result()) {
            return false;
        } else {
            $this->db->where('id',$id);
            return $this->db->delete('tags');
        }
    }

    public function agregarTag($nombre,$user_id,$fecha_actual) {

        $this->db->insert('tags',['nombre' => $nombre, 'created_by' => $user_id, 'created_at' => $fecha_actual]);
    }

}