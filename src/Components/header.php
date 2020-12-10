<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Legend's Game</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/assets/font/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/main.css">
    </head>
    <body>
        <?php if ($_header): ?>
            <header class="navigation">
                <nav class="navbar navbar-expand">
                    <a class="navbar-brand neon-effect" href="/">Legends</a>
                    <div class="collapse navbar-collapse" id="main-navbar">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Kappa's World</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/classement/">Classement</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/boutique/">Boutique</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/credits/">Crédits</a>
                            </li>
                        </ul>
                        <div class="form-inline my-2 my-lg-0">
                            <a class="btn btn-sm btn-outline-light" href="<?= (!empty($_SESSION["_ACCOUNT_"])? "/game/": "/connexion/") ?>">Jouer maintenant</a>
                            <?php if (empty($_SESSION["_ACCOUNT_"])): ?>
                                <a class="btn btn-sm btn-outline-success ml-3" href="/inscription/">Inscription</a>
                            <?php else: ?>
                                <a class="btn btn-sm btn-outline-danger ml-3" href="/deconnexion/">Déconnexion de <?= $_SESSION["_ACCOUNT_"]->Player->username ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </header>
        <?php endif; ?>