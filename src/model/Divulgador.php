<?php
namespace model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_divulgador')]
class Divulgador extends GenericModel
{
    #[ORM\Column(type: 'string')]
    private $nome;

    #[ORM\Column(type: 'string')]
    private $cnpj;

    #[ORM\Column(type: 'string')]
    private $email;

    #[ORM\OneToMany(mappedBy: 'divulgador', targetEntity: Evento::class, cascade: ['all'], orphanRemoval: true, fetch: 'LAZY')]
    private $listaEventos;

    public function __construct()
    {
        $this->listaEventos = new ArrayCollection();
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj): void
    {
        $this->cnpj = $cnpj;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getListaEventos()
    {
        return $this->listaEventos;
    }

    public function setListaEventos($listaEventos): void
    {
        $this->listaEventos = $listaEventos;
    }
}
