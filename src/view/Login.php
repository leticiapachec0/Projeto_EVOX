<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>EVOX — Login</title>
</head>
<body>

<?php require_once "templates/template-menu.php" ?>

<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px;">

        <h2 style="color: #e91e8c; text-align: center; font-weight: 800; margin-bottom: 8px;">EVOX</h2>

        <!-- Abas Entrar / Criar Conta -->
        <div style="display: flex; background: #111; border-radius: 8px; margin-bottom: 24px;">
            <a href="<?= BASE_URL . '/login' ?>"
               style="flex: 1; text-align: center; padding: 10px; border-radius: 8px; background: #e91e8c; color: white; text-decoration: none; font-weight: 600;">
                Entrar
            </a>
            <a href="<?= BASE_URL . '/cadastro' ?>"
               style="flex: 1; text-align: center; padding: 10px; border-radius: 8px; color: #888; text-decoration: none;">
                Criar Conta
            </a>
        </div>

        <form action="<?= BASE_URL . '/autenticar' ?>" method="POST">

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="seu@email.com" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary w-100" style="border-radius: 50px; padding: 12px;">
                Entrar
            </button>
        </form>

        <p class="text-center mt-3" style="color: #888; font-size: 0.9rem;">
            Não tem conta?
            <a href="<?= BASE_URL . '/cadastro' ?>" style="color: #e91e8c;">Criar Conta</a>
        </p>

    </div>
</div>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>