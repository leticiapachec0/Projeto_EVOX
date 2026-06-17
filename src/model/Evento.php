<?php
namespace model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_evento')]
class Evento extends GenericModel
{
    #[ORM\Column(type: 'string')]
    private $nome;

    #[ORM\Column(type: 'text')]
    private $descricao;

    #[ORM\Column(type: 'string')]
    private $cidade;

    #[ORM\Column(type: 'string')]
    private $local;

    #[ORM\Column(type: 'date')]
    private $data_evento;

    #[ORM\Column(type: 'string', nullable: true)]
    private $urlImagem;

    #[ORM\ManyToOne(targetEntity: Divulgador::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'divulgador_id', nullable: true)]
    private $divulgador;

    #[ORM\OneToMany(mappedBy: 'evento', targetEntity: Ingresso::class, cascade: ['all'], orphanRemoval: true, fetch: 'LAZY')]
    private $ingressos;

    public function __construct()
    {
        $this->ingressos = new ArrayCollection();
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade): void
    {
        $this->cidade = $cidade;
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function setLocal($local): void
    {
        $this->local = $local;
    }

    public function getDataEvento()
    {
        return $this->data_evento;
    }

    public function setDataEvento($data_evento): void
    {
        $this->data_evento = $data_evento;
    }

    public function getDivulgador()
    {
        return $this->divulgador;
    }

    public function setDivulgador($divulgador): void
    {
        $this->divulgador = $divulgador;
    }

    public function getIngressos()
    {
        return $this->ingressos;
    }

    public function setIngressos($ingressos): void
    {
        $this->ingressos = $ingressos;
    }

    public function getUrlImagem()
    {
        return $this->urlImagem;
    }

    public function setUrlImagem($urlImagem): void
    {
        $this->urlImagem = $urlImagem;
    }
}
