<?php
namespace model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "comprador")]
class Comprador extends GenericModel
{
    #[ORM\Column(type: "string")]
    private $nome;

    #[ORM\Column(type: "string")]
    private $cpf;

    #[ORM\Column(type: "string")]
    private $email;

    #[ORM\Column(type: "integer")]
    private $idade;

    #[ORM\OneToMany(mappedBy: "comprador", targetEntity: Pedido::class, cascade: ["all"], orphanRemoval: true)]
    private $pedidos;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade): void
    {
        $this->idade = $idade;
    }

    public function getPedidos()
    {
        return $this->pedidos;
    }

    public function setPedidos($pedidos): void
    {
        $this->pedidos = $pedidos;
    }
}