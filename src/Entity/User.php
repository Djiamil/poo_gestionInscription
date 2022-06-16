<?php

namespace App\Entity;

use App\Entity\Personne;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use App\Repository\PersonneRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\{UserInterface,PasswordAuthenticatedUserInterface};

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"role",type:"string")]
#[ORM\DiscriminatorMap(["rp"=>"Rp","ac"=>"Ac","etudiant"=>"Etudiant"])]
#[UniqueEntity(fields: ['login'], message: 'There is already an account with this login')]

class User extends Personne implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Column(type: 'string', length: 50, unique:true)]
    protected $login;

    #[ORM\Column(type: 'string', length: 180)]
    protected $password;

    #[ORM\Column(type: 'json')]
    private $roles = [];


    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUserIdentifier()
    {
        return $this->login;
    }
    public function getRoles()
    {
        $roles[]="ROLE_USER";
        return array_unique($roles);
    }
    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        
    }
    public function getUsername()
    {
        return $this->login;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
