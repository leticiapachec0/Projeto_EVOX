# Auditoria do Projeto Evox

Data: 2026-06-11

---

## O que EXISTE

| Camada | Arquivos | Status |
|---|---|---|
| **Models** | `Comprador`, `Divulgador`, `Evento`, `Ingresso`, `Pedido`, `GenericModel` | Completo |
| **DAOs** | `CompradorDAO`, `DivulgadorDAO`, `EventoDAO`, `IngressoDAO`, `PedidoDAO`, `GenericDAO` | Completo |
| **Controllers** | `CompradorController`, `DivulgadorController`, `EventoController`, `IngressoController`, `PedidoController` | Parcial — incluem views que não existem |
| **Utils** | `Conexao.php` (singleton Doctrine) | Completo |
| **Tests** | 5 testes de model + 5 testes de DAO | Presente |
| **Config** | `.env`, `doctrine.php`, `composer.json`, `composer.lock` | Presente |
| **index.php** | Raiz do projeto | Existe, mas está **vazio** |
| **src/view/** | Diretório | Existe, mas está **vazio** |
| **vendor/** | Dependências instaladas | Existe, mas **não deveria estar no git** |

---

## O que FALTA

### 1. `.gitignore` — Não existe
A pasta `vendor/` está sendo rastreada pelo git. Sem `.gitignore`, `vendor/`, `.env` e arquivos de IDE (`.idea/`) vão para o repositório.

### 2. `pasta public/` — Não existe
Toda aplicação PHP MVC com roteamento deve ter um **front controller** em `public/index.php`. Atualmente o `index.php` está na raiz e vazio.

### 3. Arquivos `.htaccess` — Nenhum existe
São necessários dois:
- `/public/.htaccess` — redireciona todas as requisições para `public/index.php`
- `/.htaccess` da raiz — redireciona para `public/`

### 4. `nikic/fast-route` — Não está no `composer.json`
O pacote não foi adicionado como dependência. Não há nenhum arquivo de rotas no projeto.

### 5. Views — Pasta vazia
Os controllers já referenciam as views com `include`, mas os arquivos não existem:

| Controller | Views esperadas |
|---|---|
| CompradorController | `lista-compradores.php`, `visualizar-comprador.php` |
| DivulgadorController | `lista-divulgadores.php`, `visualizar-divulgador.php` |
| EventoController | `lista-eventos.php`, `visualizar-evento.php` |
| IngressoController | `lista-ingressos.php`, `visualizar-ingresso.php` |
| PedidoController | `lista-pedidos.php`, `visualizar-pedido.php` |

Também faltam formulários de criação/edição para cada entidade.

---

## Comparação com a Arquitetura MVC Esperada

```
projeto_evox/
├── .gitignore              ← FALTA
├── .env
├── .htaccess               ← FALTA (redireciona para public/)
├── composer.json           ← existe, mas falta nikic/fast-route
├── composer.lock
├── doctrine.php
├── public/                 ← FALTA (diretório inteiro)
│   ├── index.php           ← FALTA (front controller + bootstrap + rotas)
│   └── .htaccess           ← FALTA (rewrite para index.php)
├── src/
│   ├── controller/         ← existe (5 controllers)
│   ├── dao/                ← existe (6 DAOs)
│   ├── model/              ← existe (6 models)
│   ├── utils/              ← existe (Conexao.php)
│   └── view/               ← existe mas VAZIO
│       ├── comprador/      ← FALTA (lista + visualizar + form)
│       ├── divulgador/     ← FALTA
│       ├── evento/         ← FALTA
│       ├── ingresso/       ← FALTA
│       └── pedido/         ← FALTA
└── vendor/                 ← existe mas DEVE ser ignorado pelo git
```

---

## Problemas Adicionais Identificados

- **`composer.json` com autoload redundante**: tem entradas duplicadas para `model\\`, `dao\\`, `utils\\` além do PSR-4 principal `Leticia\\ProjetoEvox\\` — isso pode causar conflitos.
- **`doctrine/annotations` marcado como ABANDONED**: o próprio composer.lock registra o aviso. Doctrine ORM 3.x usa atributos PHP 8 nativos (que o projeto já usa), então essa dependência pode ser removida.
- **`.env` sem proteção**: o arquivo com credenciais de banco também não está no `.gitignore`.

---

## Lista de Tarefas em Ordem de Prioridade

### P1 — Git / Segurança (imediato)
1. Criar `.gitignore` com `vendor/`, `.env`, `.idea/`
2. Remover `vendor/` do rastreamento git (`git rm -r --cached vendor/`)

### P2 — Infraestrutura Web (projeto não funciona sem isso)
3. Criar diretório `public/`
4. Criar `public/.htaccess` com rewrite para `index.php`
5. Criar `/.htaccess` na raiz redirecionando para `public/`

### P3 — Roteamento
6. Adicionar `nikic/fast-route` ao `composer.json` e instalar
7. Criar `public/index.php` com bootstrap da aplicação e definição das rotas

### P4 — Views
8. Criar as views de listagem para cada entidade (5 arquivos)
9. Criar as views de visualização/detalhe (5 arquivos)
10. Criar os formulários de criação e edição (5+ arquivos)

### P5 — Refinamentos
11. Corrigir o `composer.json` removendo entradas de autoload redundantes
12. Remover `doctrine/annotations` do `composer.json` (já usa atributos PHP 8)
