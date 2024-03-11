<?php
namespace Entities;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Types;
use Doctrine\ORM\Mapping\Id;

#[Entity]
#[Table(name: 'usuarios')]
class Usuarios
{

    #[Column, Id]
    private int $id;
    
    public function __construct(
        #[Column]
        private string $username,
        #[Column]
        private int $contraseña,
    ) {
        $this->setUsername($username);
        $this->setContraseña($contraseña);
    }

    // ACA COMIENZAN LOS SETERS Y GETERS //

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    private function setUsername(string $username): string {
        return $this->username = $username;
    }

    public function getContraseña(): string {
        return $this->contraseña;
    }

    private function setContraseña(string $contraseña): string {
        return $this->contraseña = $contraseña;
    }

    // ACA TERMINAN LOS SETERS Y GETERS //

}