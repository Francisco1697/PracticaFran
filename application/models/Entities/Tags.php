<?php
namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Types;
use Doctrine\ORM\Mapping\Id;
use Repositories\TagsRepository;

#[Table(name: 'tags')]
#[Entity(repositoryClass: TagsRepository::class, readOnly: false)]
class Tags
{
    #[JoinTable(name: 'cosas_tags')]
    #[JoinColumn(name: 'tags_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'cosas_id', referencedColumnName: 'id')]
    #[ManyToMany(targetEntity: Cosas::class)]

    #[Column, Id]
    private int $id;
     
    #[Column]
    private int $modified_by;
    
    #[Column]
    private \DateTime $modified_at;

    #[Column]
    private bool $borrado_logico = false;

    #[Column]
    private int $deleted_by;

    #[Column]
    private \DateTime $deleted_at;
    
    public function __construct(

        #[Column]
        private string $nombre,
        #[Column]
        private int $created_by,
        #[Column]
        private \DateTime $created_at
    ) {
        $this->cosas = new ArrayCollection();
        $this->setNombre($nombre);
        $this->setCreatedBy($created_by);
        $this->setCreatedAt($created_at);

    }

    // ACA COMIENZAN LOS SETERS Y GETERS //

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    private function setNombre(string $nombre): string {
        return $this->nombre = $nombre;
    }

    public function getCreatedBy(): int {
        return $this->created_by;
    }

    public function setCreatedBy(int $id): int {
        return $this->created_by = $id;
    }

    public function getCreatedAt(): \DateTime {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $fecha): \DateTime {
        return $this->created_at = $fecha;
    }

    public function getModifiedBy(): int {
        return $this->modified_by;
    }

    public function setModifiedBy(int $id): int {
        return $this->modified_by = $id;
    }

    public function getModifiedAt(): \DateTime {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTime $fecha): \DateTime {
        return $this->created_at = $fecha;
    }

    public function getBorradoLogico(): bool {
        return $this->borrado_logico;
    }

    public function getDeletedBy(): int {
        return $this->deleted_by;
    }

    public function getDeletedAt(): \DateTime {
        return $this->deleted_at;
    }

    // ACA TERMINAN LOS SETERS Y GETERS //

    public function eliminarTag($user_id, $fecha): void {
        $this->borrado_logico = true;
        $this->deleted_by = $user_id;
        $this->deleted_at = $fecha;
    }

}