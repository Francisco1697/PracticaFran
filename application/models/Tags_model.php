<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tags_model extends CI_Model {

    public function buscarTagsPorCosa($id) {
        $this->db->select("t.*");
        $this->db->from("cosas_tags ct");
        $this->db->join("tags t", "t.id = ct.tags_id");
        $this->db->where("ct.cosas_id",$id);
        $results=$this->db->get();
        return $results->result();
    }

    public function buscarTagsPorNombre($nombre) {
        $this->db->select("t.id");
        $this->db->from("tags t");
        $this->db->where("t.nombre",$nombre);
        $results=$this->db->get();
        return $results->result();
    }

}