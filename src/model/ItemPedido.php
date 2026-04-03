<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "item_pedido")]
class ItemPedido extends GenericModel
{
    #[ORM\Column(type: "integer")]
    private $quantidade;

    #[ORM\ManyToOne(targetEntity: Pedido::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: "pedido_id")]
    private $pedido;

    #[ORM\ManyToOne(targetEntity: Ingresso::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: "ingresso_id")]
    private $ingresso;

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade): void
    {
        $this->quantidade = $quantidade;
    }

    public function getPedido()
    {
        return $this->pedido;
    }

    public function setPedido($pedido): void
    {
        $this->pedido = $pedido;
    }

    public function getIngresso()
    {
        return $this->ingresso;
    }

    public function setIngresso($ingresso): void
    {
        $this->ingresso = $ingresso;
    }
}