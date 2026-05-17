<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_pedido')]
class Pedido extends GenericModel
{
    #[ORM\Column(type: 'date')]
    private $data;

    #[ORM\Column(type: 'integer')]
    private $quantidade;

    #[ORM\Column(type: 'float')]
    private $total;

    #[ORM\ManyToOne(targetEntity: Comprador::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'comprador_id')]
    private $comprador;

    #[ORM\ManyToOne(targetEntity: Evento::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'evento_id')]
    private $evento;

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade): void
    {
        $this->quantidade = $quantidade;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }

    public function getComprador()
    {
        return $this->comprador;
    }

    public function setComprador($comprador): void
    {
        $this->comprador = $comprador;
    }

    public function getEvento()
    {
        return $this->evento;
    }

    public function setEvento($evento): void
    {
        $this->evento = $evento;
    }
}
