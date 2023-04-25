<?php
    require_once("templates/header.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $user = new User();

    $userData = $userDao->verifyToken(true);
?>
    <div id="main-container" class="container-fluid">
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Adicionar Filme</h1>
            <p class="page-description">Adicione uma critica e compartilhe</p>
            <form action="<?= $BASE_URL ?>/movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">  
                <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control space" id="title" name="title" placeholder="Titulo do filme">
                </div>
                <div class="form-group">
                    <label for="image">Capa</label><br>
                    <input type="file" class="form-control-file space" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="length">Duração</label>
                    <input type="text" class="form-control space" id="length" name="length" placeholder="Duração do filme">
                </div>
                <div class="form-group">
                    <label for="category">Categoria</label>                    
                    <select class="form-control space" name="category" id="category">
                        <option value="">Selecione</option>
                        <option value="Ação">Ação</option>
                        <option value="Drama">Drama</option>
                        <option value="Comédia">Comédia</option>
                        <option value="Fantasia / Ficção">Fantasia / Ficção</option>                        
                        <option value="Romance">Romance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trailer">Duração</label>
                    <input type="text" class="form-control space" id="trailer" name="trailer" placeholder="Link do trailer do filme">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>                    
                    <textarea class="form-control space" name="description" id="description" rows="5" placeholder="Descrva o filme brevemente"></textarea>
                </div>
                <input type="submit" class="btn card-btn" value="Adicionar">
            </form>                
        </div>
    </div> 
<?php
    require_once("templates/footer.php");
?>  