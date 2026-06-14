<?php use utils\Sessao; ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL . "/" ?>">EVOX</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '/eventos' ?>">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '/compradores' ?>">Compradores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '/ingressos' ?>">Ingressos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '/pedidos' ?>">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '/divulgadores' ?>">Divulgadores</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php $sucesso = Sessao::getSucesso(); $erro = Sessao::getErro(); ?>
<?php if ($sucesso): ?>
    <div class="alert alert-success alert-dismissible fade show mt-5 mx-3" role="alert">
        <?= $sucesso ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if ($erro): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-5 mx-3" role="alert">
        <?= $erro ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>