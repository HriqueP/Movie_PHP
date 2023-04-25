<?php
    require_once("templates/header.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $user = new User();

    $userData = $userDao->verifyToken(true);
    $fullName = $user->getFullName($userData);

    if($userData->image == ""){
        $userData->image = "user.png";
    }
?>
    <div id="main-container" class="container-fluid edit-profile-page">
        <div class="col-md-12">
            <form action="<?= $BASE_URL?>/user_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="update">
                <div class="row">
                    <div class="col-md-4">
                        <h1><?= $fullName ?></h1>
                        <p class="page-description">Altere os seus dados:</p>
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control space" id="name" name="name" placeholder="Digite o seu nome" value="<?= $userData->name ?>"> 
                        </div>
                        <div class="form-group">
                            <label for="lastname">Sobrenome</label>
                            <input type="text" class="form-control space" id="lastname" name="lastname" placeholder="Digite o seu sobrenome" value="<?= $userData->lastname ?>"> 
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" readonly class="form-control space disable" id="email" name="email" value="<?= $userData->email ?>"> 
                        </div>
                        <input type="submit" class="btn card-btn" value="Alterar">
                    </div>
                    <div class="col-md-4">
                        <div id="profile-image-container" style="background-image: url('<?= $BASE_URL?>/img/users/<?= $userData->image ?>');"></div>
                        <div class="form-group">
                            <label for="image">Foto</label><br>
                            <input type="file" class="form-control-file space" name="image"> 
                        </div>      
                        <div class="form-group">
                            <label for="bio">Sobre você</label>
                            <textarea class="form-control space" name="bio" id="bio" rows="5" placeholder="Conte-nos sobre você..."><?= $userData->bio ?></textarea>
                        </div>                  
                    </div>
                </div>
            </form>

            <div class="row" id="change-password-container">
                <div class="col-md-4">
                    <h2>Alterar Senha</h2>
                    <p class="page-description">Digite e altera sua senha</p>
                    <form action="<?= $BASE_URL?>/user_process.php" method="POST">
                        <input type="hidden" name="type" value="changepassword">
                        <div class="form-group">
                            <label for="password">Nova Senha</label>
                            <input type="password" class="form-control space" id="password" name="password" placeholder="Digite a nova senha"> 
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Confirmação da Senha</label>
                            <input type="password" class="form-control space" id="confirmpassword" name="confirmpassword" placeholder="Confirme a nova senha"> 
                        </div>
                        <input type="submit" class="btn card-btn" value="Alterar Senha">
                    </form>                    
                </div>
            </div>
        </div>
    </div> 
<?php
    require_once("templates/footer.php");
?>  