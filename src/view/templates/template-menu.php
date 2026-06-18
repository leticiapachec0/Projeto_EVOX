<?php use utils\Sessao; ?>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #111111; border-bottom: 1px solid #2a2a2a;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL . "/" ?>" style="color: #e91e8c; font-weight: 800; letter-spacing: 2px;">EVOX</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '/eventos' ?>">Eventos</a>
                    </li>

                    <?php if (isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin') : ?>
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
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['usuario_id'])) : ?>
                        <li class="nav-item d-flex align-items-center">
                        <span class="nav-link" style="color: #888;">
                            <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
                            <span style="color: #e91e8c; font-size: 0.75rem; margin-left: 4px;">
                                (<?= $_SESSION['usuario_role'] ?>)
                            </span>
                        </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL . '/logout' ?>" style="color: #888;">Sair</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL . '/cadastro' ?>" style="color: #888;">Sou Divulgador</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL . '/login' ?>"
                               style="background: #e91e8c; color: white; padding: 8px 20px; border-radius: 50px; text-decoration: none; font-weight: 600; margin-left: 8px;">
                                Login
                            </a>
                        </li>
                    <?php endif; ?>
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