<?php
    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $flassMessage = $message->getMessage();

    if(!empty($flassMessage["msg"])){
        //Limpar mensagem
        $message->clearMessage();
    }

    $userDao = new UserDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken(false);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieStar</title>
    <link rel="short icon" href="<?= $BASE_URL?>/img/moviestar.ico"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS do Projeto -->
    <link rel="stylesheet" href="<?= $BASE_URL?>/styles.css">
</head>
<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a  href="<?= $BASE_URL?>" class="navbar-brand">
                <img src="<?= $BASE_URL?>/img/logo.svg" alt="MovieStar" id="logo">
                <span id="moviestar-title">MovieStar</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>       
            </button>
            <form action="<?= $BASE_URL?>/search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0" style="display: flex;"> <!-- Estilo inline para resolver o problema de duas linhas entre o campo de input do formulario e o botão de busca-->
                <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar Filmes" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <?php if($userData): ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL?>/newmovie.php" class="nav-link">
                                <i class="far fa-plus-square"></i>Incluir Filme
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL?>/dashboard.php" class="nav-link">
                                Meus Filmes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL?>/editprofile.php" class="nav-link bold">
                                <?= $userData->name ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL?>/logout.php" class="nav-link">
                                Sair
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL?>/auth.php" class="nav-link">Entrar / Cadastrar</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>   
    </header>

    <?php if(!empty($flassMessage["msg"])): ?>
        <div class="msg-container">
            <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
        </div>
    <?php endif; ?>