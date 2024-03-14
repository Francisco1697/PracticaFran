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
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Types;
use Doctrine\ORM\Mapping\Id;
use Repositories\CosasRepository;

#[Table(name: 'cosas')]
#[Entity(repositoryClass: CosasRepository::class, readOnly: false)]
class Cosas
{
    #[Column, Id, GeneratedValue]
    private ?int $id = null;
     
    #[Column]
    private int $modified_by;
    
    #[Column]
    private \DateTimeImmutable $modified_at;

    #[Column]
    private bool $borrado_logico = false;

    #[Column]
    private int $deleted_by;

    #[Column]
    private \DateTimeImmutable $deleted_at;
    
    public function __construct(
        #[Column]
        private string $nombre,
        #[Column]
        private string $cantidad,
        #[Column]
        private int $created_by,
        #[Column]
        private \DateTimeImmutable $created_at,
        /**
         * @var Collection<int, Tags>
         */
        #[ManyToMany(targetEntity: Tags::class)]
        #[JoinTable(name: 'cosas_tags')]
        #[JoinColumn(name: 'cosas_id', referencedColumnName: 'id')]
        #[InverseJoinColumn(name: 'tags_id', referencedColumnName: 'id')]
        private Collection $tags
    ) {
        $this->setNombre($nombre);
    }

    // ACA COMIENZAN LOS SETERS Y GETERS //

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        if (trim($nombre) === '') {
            throw new \Exception('Que haces hijo de puttaa?');
        }
        $this->nombre = $nombre;
    }

    public function getCantidad(): int {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): void {
        $this->cantidad = $cantidad;
    }

    public function getCreatedBy(): int {
        return $this->created_by;
    }

    public function setCreatedBy(int $id): void {
        $this->created_by = $id;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $fecha): void {
        $this->created_at = $fecha;
    }

    public function getModifiedBy(): int {
        return $this->modified_by;
    }

    public function setModifiedBy(int $id): void {
        $this->modified_by = $id;
    }

    public function getModifiedAt(): \DateTimeImmutable {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTimeImmutable $fecha): void {
        $this->created_at = $fecha;
    }

    public function getBorradoLogico(): bool {
        return $this->borrado_logico;
    }

    public function setBorradoLogico(): void {
        $this->borrado_logico = true;
    }

    public function getDeletedBy(): int {
        return $this->deleted_by;
    }

    public function setDeletedBy(int $id): void {
        $this->deleted_by = $id;
    }

    public function getDeletedAt(): \DateTimeImmutable {
        return $this->deleted_at;
    }

    public function setDeletedAt(\DateTimeImmutable $fecha): void {
        $this->deleted_at = $fecha;
    }

    public function getTags(): Collection {
        return $this->tags;
    }

    // ACA TERMINAN LOS SETERS Y GETERS //

}