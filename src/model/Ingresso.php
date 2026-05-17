<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_ingresso')]
class Ingresso extends GenericModel
{
    #[ORM\Column(type: 'float')]
    private $preco;

    #[ORM\Column(type: 'integer')]
    private $quantidade;

    #[ORM\ManyToOne(targetEntity: Evento::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'evento_id')]
    private $evento;

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco): void
    {
        $this->preco = $preco;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade): void
    {
        $this->quantidade = $quantidade;
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
