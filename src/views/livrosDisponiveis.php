<?php

session_cache_expire(30);
$cache_expire = session_cache_expire();

session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.php?mensagem=erro");
} else {

?>

    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <title>Estante Virtual</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style/paginaInicial.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    </head>

    <body>

        <nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
            <div class="w3-container">
                <h3 class="w3-padding-64"><b>Estante<br>Virtual</b></h3>
            </div>
            <div class="w3-bar-block">
                <a href="./paginaInicial.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
                <br><br><br>
                <br><br><br>
                <br><br>
                <?php
                $conexao = mysqli_connect("localhost", "root", "", "biblioteca");
                $nomeUsuario =  mysqli_fetch_array(mysqli_query($conexao, "SELECT NOME FROM USUARIO WHERE EMAIL='" . $_SESSION['email'] . "'"))['NOME'];
                echo '<p class="w3-bar-item w3-button w3-hover-white"><i class="fa fa-user-o" aria-hidden="true" title="Visualizar meus livros"></i></i><a href="./emprestimosUsuario.php"> ' . $nomeUsuario . '</a></p>';
                ?>

                <a href="./logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white"><i class="fa fa-sign-out"></i> Sair</a>
            </div>
        </nav>

        <header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
            <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
            <span>Estante Virtual</span>
        </header>


        <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <div class="w3-main" style="margin-left:340px;margin-right:40px">


            <div class="w3-container" style="margin-top:80px" id="showcase">
                <h1 class="w3-jumbo"><b>Estante Virtual</b></h1>
                <h1 class="w3-xxxlarge w3-text-red"><b>Livros disponíveis para empréstimo</b></h1>

            </div>


            <div class="w3-container">
                <br>
                <table class="w3-table-all">
                    <thead>
                        <tr class="w3-red">
                            <th>Título</th>
                            <th>Autores</th>
                            <th>Ano</th>
                            <th>Editora</th>
                            <th>Disponíveis</th>
                            <th></th>
                        </tr>
                    </thead>

                    <?php
                    $conexao = mysqli_connect("localhost", "root", "", "biblioteca");
                    $query = " SELECT distinct ID,TITULO,EDITORA,ANO,AUTORES,QUANTIDADE FROM LIVRO LEFT JOIN EMPRESTIMO ON LIVRO.ID=EMPRESTIMO.IDLIVRo where emailusuario is null or emailusuario <> '" . $_SESSION["email"] . "' AND QUANTIDADE>0;";
                    $resultado = mysqli_query($conexao, $query);
                    while ($linha = mysqli_fetch_array($resultado)) {
                        echo "<tr><td>" . $linha['TITULO'] . "</td><td>" . $linha['AUTORES'] . "</td><td>" . $linha['ANO'] . "</td><td>" . $linha['EDITORA'] . "</td><td>" . $linha['QUANTIDADE'] . "</td><td><button class=\"w3-button w3-white w3-border w3-round-large\">Alugar</button></td></tr>";
                    }
                    ?>
                </table>
            </div>
            <br><br><br><br>

        </div>


    </body>

    </html>
<?php } ?>