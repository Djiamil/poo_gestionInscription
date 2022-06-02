<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"role",type:"string")]
#[ORM\DiscriminatorMap(["user"=>"User","professeur"=>"Professeur"])]

class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 50)]
    protected $nonComplet;

    #[ORM\Column(type: 'smallint')]
    protected $etat;

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNonComplet(): ?string
    {
        return $this->nonComplet;
    }

    public function setNonComplet(string $nonComplet): self
    {
        $this->nonComplet = $nonComplet;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
