<?php /**
 * @var \model\Evento $evento
 * @var \model\Divulgador[] $divulgadores
 */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Cadastro de Evento</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= $evento->getId() ? 'Editar Evento' : 'Cadastrar Evento' ?></h1>

    <form id="formCadastroEvento" action="<?= BASE_URL . '/eventos/cadastrar' ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($evento->getId() ?? '') ?>">

        <div class="row mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input id="nome" name="nome" type="text" class="form-control"
                   value="<?= htmlspecialchars($evento->getNome() ?? '') ?>">
        </div>

        <div class="row mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea id="descricao" name="descricao" class="form-control"><?= htmlspecialchars($evento->getDescricao() ?? '') ?></textarea>
        </div>

        <div class="row mb-3">
            <label for="cidade" class="form-label">Cidade:</label>
            <input id="cidade" name="cidade" type="text" class="form-control"
                   value="<?= htmlspecialchars($evento->getCidade() ?? '') ?>">
        </div>

        <div class="row mb-3">
            <label for="local" class="form-label">Local:</label>
            <input id="local" name="local" type="text" class="form-control"
                   value="<?= htmlspecialchars($evento->getLocal() ?? '') ?>">
        </div>

        <div class="row mb-3">
            <label for="data_evento" class="form-label">Data do Evento:</label>
            <input id="data_evento" name="data_evento" type="date" class="form-control"
                   value="<?= $evento->getDataEvento() ? $evento->getDataEvento()->format('Y-m-d') : '' ?>">
        </div>

        <div class="row mb-3">
            <label for="divulgador_id" class="form-label">Divulgador:</label>
            <select id="divulgador_id" name="divulgador_id" class="form-control">
                <option value="">Selecione um divulgador</option>
                <?php foreach ($divulgadores as $divulgador) : ?>
                    <option value="<?= $divulgador->getId() ?>"
                        <?= $divulgador->getId() == $evento->getDivulgador()?->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($divulgador->getNome()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="row mb-3">
            <label for="imagem_evento" class="form-label">Imagem do Evento:</label>
            <?php if ($evento->getUrlImagem()) : ?>
                <div class="mb-2">
                    <img src="<?= $evento->getUrlImagem() ?>" alt="Imagem atual" style="max-width: 200px; border-radius: 8px;">
                </div>
            <?php endif; ?>
            <input id="imagem_evento" name="imagem_evento" type="file" class="form-control" accept="image/*">
        </div>

        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="<?= BASE_URL . '/eventos' ?>" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>