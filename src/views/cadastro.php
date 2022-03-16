<?php
$mensagem = '';
session_cache_expire(30);
$cache_expire = session_cache_expire();

session_start();

if (isset($_SESSION['email'])) {
    header("Location:paginaInicial.php");
} else if (isset($_POST["cadastrar"])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        $custo = '08';
        $salt = 'Cf1f11ePArKlBJomM0F6aJ';
        $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

        $conexao = mysqli_connect("localhost", "root", "", "biblioteca");
        mysqli_query($conexao, "INSERT INTO `usuario`(`nome`, `senha`, `email`) VALUES ('" . trim($_POST['nome']) . "','" . $hash . "', '" . $email . "')");

        $_SESSION['email'] = $email;
        
        header("Location:paginaInicial.php");
    } else {
    ?>
        <script>
            window.alert("Preencha os campos solicitados.");
        </script>
    <?php
    }
} else {

    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="../style/signin.css" rel="stylesheet">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <title>Cadastre-se na Estante Online</title>
    </head>

    <body>
        <div class="container">
            <div class="card card-container">
                <h1><b>Estante Virtual</b></h1>
                <h4 style="text-align: center;">Bom te ver por aqui!</h4>
            </div>
        </div>
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <br>
                <form class="form-login" action="cadastro.php" method="POST"">
                    <input name=" nome" type="text" id="inputNome" class="form-control" placeholder="Nome" autofocus>
                    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autocomplete="username">
                    <input name="senha" type="password" id="inputSenha" class="form-control" placeholder="Senha" required autocomplete="current-password">
                    <br>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="cadastrar">Cadastrar-se</button>
                </form>
                Já tem uma conta? <a href="./login.php" class="cadastrar">
                    Entrar
                </a>
            </div>
        </div>
    </body>
<?php } ?>

    </html>