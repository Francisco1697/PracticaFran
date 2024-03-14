<?php

use Doctrine\Common\Collections\ArrayCollection;
use Entities\Tags;
use Entities\Cosas;

defined('BASEPATH') OR exit('No direct script access allowed');


#[AllowDynamicProperties]
class Cosas_model extends CI_Model {

    public function __construct()
    {
        $this->load->library('session');
		$this->load->library('doctrine');
    }

    public function consultaBase()
    {
        return $this->buscarPorNombre(null);      
    }

    public function agregarRegistro(string $nombre, int $cantidad, array $tagsId): bool
    {

        if ($this->doctrine->em->getRepository(Cosas::class)->findOneBy(['nombre'=> $nombre])) {
            return false;
        }

        try {
            $fecha_actual = new \DateTimeImmutable();
            $usuario = $this->session->userdata('user_id');
            $tags = new ArrayCollection($this->doctrine->em->getRepository(Tags::class)->findBy(['id'=> $tagsId]));

            $this->doctrine->em->getConnection()->beginTransaction();

            $cosa = new \Entities\Cosas($nombre, $cantidad, $usuario, $fecha_actual, $tags);

            $this->doctrine->em->persist($cosa);
            $this->doctrine->em->flush();

            $this->doctrine->em->getConnection()->commit();
        } catch (\Throwable $e) {
            $this->doctrine->em->getConnection()->rollBack();
            throw new \Exception('Ocurrio un error al intentar crear la cosa',0,$e);
        }
        return true;
    }

    public function eliminarCosa($id) 
    {
        if (!$this->doctrine->em->getRepository(Cosas::class)->findBy(['id' => $id])) {
            return false;
        }
        
        try {
            $fecha_actual = new \DateTimeImmutable();
		    $usuario = $this->session->userdata('user_id');

            $this->doctrine->em->getConnection()->beginTransaction();

            $cosa = $this->doctrine->em->getRepository(Cosas::class)->findOneById(['id' => $id]);
            $cosa->setBorradoLogico(1);
            $cosa->setDeletedBy($usuario);
            $cosa->setDeletedAt($fecha_actual);

            $this->doctrine->em->flush();
            $this->doctrine->em->getConnection()->commit();
        } catch (\Throwable $e) {
            $this->doctrine->em->getConnection()->rollBack();
            throw new \Exception('Ocurrio un error al intentar eliminar la cosa',0,$e);
        }
        return true;
    }

    public function getCosa(int $id): ?Cosas
    {
        $cosa = $this->doctrine->em->find(Cosas::class, $id);
        return $cosa;
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

