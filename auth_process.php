<?php
    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");
    
    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);

    //Resgata o tipo de formulário
    $type = filter_input(INPUT_POST, "type");
    
    //Verifica o tipo de formulário
    if($type == "register"){
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        //Verificação de dados mínimos
        if($name && $lastname && $email && $password){
            //Verificar se as senhas batem
            if($password === $confirmpassword){
                //Verificar se o email ja está cadastrado no sistema
                if($userDao->findByEmail($email) === false){
                    $user = new User();

                    //Criação de token e senha
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;

                    $auth = true;

                    $userDao->create($user, $auth);

                }else{
                    //Usuario ja existe
                    $message->setMessage("Conta com e-mail já cadastrado", "error", "back");
                }
            }else{
                //Senhas diferentes 
                $message->setMessage("As senhas não são iguais", "error", "back");
            }
        }else{
            //Envia uma mensagem de erro de dados faltantes
            $message->setMessage("Por favor, preencha todos os campos", "error", "back");
        }
    }else if($type == "login"){
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");

        //Tenta autenticar usaário
        if($userDao->authenticateUser($email, $password)){
            $message->setMessage("Seja bem vindo!", "success", "../editprofile.php");
        }else{
            //Redireciona usuário caso não consiga autenticar
            $message->setMessage("Usuário e/ou senha inválidos", "error", "back");
        }
    }else{
        $message->setMessage("Informações Inválidas", "error", "index.php");
    }
?>