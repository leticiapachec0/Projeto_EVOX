<?php
namespace model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "divulgador")]
class Divulgador extends GenericModel
{
    #[ORM\Column(type: "string")]
    private $nome;

    #[ORM\Column(type: "string")]
    private $cnpj;

    #[ORM\Column(type: "string")]
    private $email;

    #[ORM\OneToMany(mappedBy: "divulgador", targetEntity: Evento::class, cascade: ["all"], orphanRemoval: true)]
    private $eventos;

    public function __construct()
    {
        $this->eventos = new ArrayCollection();
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEventos()
    {
        return $this->eventos;
    }

    public function setEventos($eventos): void
    {
        $this->eventos = $eventos;
    }
}