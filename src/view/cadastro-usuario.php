<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>EVOX — Criar Conta</title>
</head>
<body>

<?php require_once "templates/template-menu.php" ?>

<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 80px 16px;">
    <div style="background: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px;">

        <h2 style="color: #e91e8c; text-align: center; font-weight: 800; margin-bottom: 8px;">EVOX</h2>

        <!-- Abas Entrar / Criar Conta -->
        <div style="display: flex; background: #111; border-radius: 8px; margin-bottom: 24px;">
            <a href="<?= BASE_URL . '/login' ?>"
               style="flex: 1; text-align: center; padding: 10px; border-radius: 8px; color: #888; text-decoration: none;">
                Entrar
            </a>
            <a href="<?= BASE_URL . '/cadastro' ?>"
               style="flex: 1; text-align: center; padding: 10px; border-radius: 8px; background: #e91e8c; color: white; text-decoration: none; font-weight: 600;">
                Criar Conta
            </a>
        </div>

        <!-- Seletor de tipo -->
        <p class="form-label mb-2">Tipo de conta</p>
        <div class="d-flex gap-2 mb-3">
            <div id="btnComprador" onclick="selecionarTipo('comprador')"
                 style="flex:1; border: 2px solid #e91e8c; border-radius: 12px; padding: 16px; text-align: center; cursor: pointer; background: #2a0a1a;">
                <div style="font-size: 1.5rem;">🎫</div>
                <div style="color: #e91e8c; font-weight: 700;">Comprador</div>
                <div style="color: #888; font-size: 0.8rem;">Comprar ingressos</div>
            </div>
            <div id="btnDivulgador" onclick="selecionarTipo('divulgador')"
                 style="flex:1; border: 2px solid #2a2a2a; border-radius: 12px; padding: 16px; text-align: center; cursor: pointer;">
                <div style="font-size: 1.5rem;">📢</div>
                <div style="color: #fff; font-weight: 700;">Divulgador</div>
                <div style="color: #888; font-size: 0.8rem;">Publicar eventos</div>
            </div>
        </div>

        <form action="<?= BASE_URL . '/salvar-cadastro' ?>" method="POST" id="formCadastroUsuario">
            <input type="hidden" name="role" id="roleInput" value="comprador">

            <div class="mb-3">
                <label class="form-label">Nome completo</label>
                <input type="text" name="nome" class="form-control" placeholder="Seu nome" required>
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="seu@email.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" placeholder="••••••••" required>
            </div>

            <!-- Campos de Comprador -->
            <div id="camposComprador">
                <div class="mb-3">
                    <label class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00">
                </div>
                <div class="mb-3">
                    <label class="form-label">Idade</label>
                    <input type="number" name="idade" class="form-control" placeholder="Sua idade">
                </div>
            </div>

            <!-- Campos de Divulgador -->
            <div id="camposDivulgador" style="display:none;">
                <div class="mb-3">
                    <label class="form-label">CNPJ</label>
                    <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0000-00">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2" style="border-radius: 50px; padding: 12px;">
                Criar Conta
            </button>
        </form>
    </div>
</div>

<script>
    function selecionarTipo(tipo) {
        document.getElementById('roleInput').value = tipo;

        if (tipo === 'comprador') {
            document.getElementById('btnComprador').style.border = '2px solid #e91e8c';
            document.getElementById('btnComprador').style.background = '#2a0a1a';
            document.getElementById('btnComprador').querySelector('div:nth-child(2)').style.color = '#e91e8c';
            document.getElementById('btnDivulgador').style.border = '2px solid #2a2a2a';
            document.getElementById('btnDivulgador').style.background = 'transparent';
            document.getElementById('btnDivulgador').querySelector('div:nth-child(2)').style.color = '#fff';
            document.getElementById('camposComprador').style.display = 'block';
            document.getElementById('camposDivulgador').style.display = 'none';
        } else {
            document.getElementById('btnDivulgador').style.border = '2px solid #e91e8c';
            document.getElementById('btnDivulgador').style.background = '#2a0a1a';
            document.getElementById('btnDivulgador').querySelector('div:nth-child(2)').style.color = '#e91e8c';
            document.getElementById('btnComprador').style.border = '2px solid #2a2a2a';
            document.getElementById('btnComprador').style.background = 'transparent';
            document.getElementById('btnComprador').querySelector('div:nth-child(2)').style.color = '#fff';
            document.getElementById('camposDivulgador').style.display = 'block';
            document.getElementById('camposComprador').style.display = 'none';
        }
    }
</script>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>