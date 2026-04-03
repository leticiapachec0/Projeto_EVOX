<?php
namespace model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "pedido")]
class Pedido extends GenericModel
{
    #[ORM\Column(type: "date")]
    private $data;

    #[ORM\ManyToOne(targetEntity: Comprador::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: "comprador_id")]
    private $comprador;

    #[ORM\OneToMany(mappedBy: "pedido", targetEntity: ItemPedido::class, cascade: ["all"], orphanRemoval: true)]
    private $itens;

    public function __construct()
    {
        $this->itens = new ArrayCollection();
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getComprador()
    {
        return $this->comprador;
    }

    public function setComprador($comprador): void
    {
        $this->comprador = $comprador;
    }

    public function getItens()
    {
        return $this->itens;
    }

    public function setItens($itens): void
    {
        $this->itens = $itens;
    }
}