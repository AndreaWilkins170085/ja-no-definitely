<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity(repositoryClass="App\Repository\UserRepository")
*/

class User
{

   /**
    * @ORM\Id()
    * @ORM\GeneratedValue(strategy="SEQUENCE")
    * @ORM\Column(type="integer")
    */

    private $id;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Email()
    */

    private $email;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */

    private $username;

    /**
    * @Assert\NotBlank()
    */
    
    private $password;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

}

?>