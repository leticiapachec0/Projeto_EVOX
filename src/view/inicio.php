<?php /** @var \model\Evento[] $eventos */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>EVOX — Plataforma de Eventos</title>
    <style>
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: radial-gradient(ellipse at center, #2a0a1a 0%, #0a0a0a 70%);
        }

        .hero-badge {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            color: #888;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            margin-bottom: 2rem;
        }

        .hero-title {
            font-size: 8rem;
            font-weight: 900;
            color: #e91e8c;
            letter-spacing: 8px;
            line-height: 1;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 60px rgba(233, 30, 140, 0.4);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #888;
            margin-bottom: 2.5rem;
        }

        .hero-subtitle span {
            color: #e91e8c;
        }

        .btn-hero {
            background-color: #e91e8c;
            border: none;
            color: white;
            padding: 14px 36px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 0 30px rgba(233, 30, 140, 0.4);
        }

        .btn-hero:hover {
            background-color: #c4177a;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 0 50px rgba(233, 30, 140, 0.6);
        }

        .eventos-recentes {
            padding: 60px 0;
        }

        .eventos-recentes h2 {
            color: #e91e8c;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .card-evento-mini {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 12px;
            padding: 20px;
            transition: border-color 0.2s, transform 0.2s;
            height: 100%;
        }

        .card-evento-mini:hover {
            border-color: #e91e8c;
            transform: translateY(-4px);
        }

        .card-evento-mini h5 {
            color: #ffffff;
            font-weight: 700;
        }

        .card-evento-mini p {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

<?php require_once "templates/template-menu.php" ?>

<!-- Hero -->
<div class="hero">
    <div class="hero-badge">
        ✦ Plataforma de Eventos
    </div>
    <div class="hero-title">EVOX</div>
    <p class="hero-subtitle">
        Onde cada noite se torna uma <span>experiência inesquecível.</span>
    </p>
    <a href="<?= BASE_URL . '/eventos' ?>" class="btn-hero">
        Explorar Eventos →
    </a>
</div>

<!-- Eventos Recentes -->
<?php if (!empty($eventos)) : ?>
    <div class="container eventos-recentes">
        <h2>Próximos Eventos</h2>
        <p class="text-muted mb-4">Descubra as melhores experiências perto de você</p>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php foreach (array_slice($eventos, 0, 4) as $evento) : ?>
                <div class="col">
                    <a href="<?= BASE_URL . '/eventos/' . $evento->getId() ?>" style="text-decoration: none;">
                        <div class="card-evento-mini">
                            <h5><?= htmlspecialchars($evento->getNome()) ?></h5>
                            <p>
                                <i class="bi bi-geo-alt-fill" style="color:#e91e8c"></i>
                                <?= htmlspecialchars($evento->getLocal()) ?> — <?= htmlspecialchars($evento->getCidade()) ?>
                            </p>
                            <p>
                                <i class="bi bi-calendar-event" style="color:#e91e8c"></i>
                                <?= $evento->getDataEvento()->format('d/m/Y') ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php require_once "templates/template-rodape.php" ?>
</body>
</html>