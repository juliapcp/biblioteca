<!DOCTYPE html>
<html lang="pt-BR">
<?php

session_cache_expire(30);
$cache_expire = session_cache_expire();

session_start();

if (!empty($_GET["mensagem"]) && $_GET["mensagem"]  == 'erro') {
?>
    <script>
        window.alert("Você precisa estar logado para acessar esta página.");
    </script>
    <?php
}

if (isset($_SESSION['email'])) {
    header("Location:paginaInicial.php");
} else if (isset($_POST["entrar"])) {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (!empty($email) && !empty($senha)) {
        $custo = '08';
        $salt = 'Cf1f11ePArKlBJomM0F6aJ';
        $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

        $conexao = mysqli_connect("localhost", "root", "", "biblioteca");
        $nroUsuarios = mysqli_fetch_array(mysqli_query($conexao, "SELECT COUNT(*) AS NROUSUARIO FROM USUARIO WHERE EMAIL='" . $email . "' AND SENHA='".$hash."'"))["NROUSUARIO"];

        if($nroUsuarios > 0){
            $_SESSION['email'] = $email;
            header("Location:paginaInicial.php");
        } else {
            ?>
                <script>
                    window.alert("E-mail ou senha inválidos.");
                </script>
            <?php
            header("Refresh:0");
        }
    } else {
    ?>
        <script>
            window.alert("Preencha os campos solicitados.");
        </script>
    <?php
    }
} else {

    ?>


    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="../style/signin.css" rel="stylesheet">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <title>Logar na Estante Online</title>
    </head>

    <body>
        <div class="container">
            <div class="card card-container">
                <h1><b>Estante Virtual</b></h1>
                <h4 style="text-align: center;">Bem vindo de volta!</h4>
            </div>
        </div>
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <br>
                <form class="form-login" action="login.php" method="POST">
                    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
                    <input name="senha" type="password" id="inputSenha" class="form-control" placeholder="Senha" required>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="entrar">Entrar</button>
                </form>
                Não tem uma conta? <a href="./cadastro.php" class="cadastrar">
                    Cadastre-se
                </a>
            </div>
        </div>
    </body>
<?php } ?>

</html>