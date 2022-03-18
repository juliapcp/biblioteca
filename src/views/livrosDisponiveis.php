<?php

function url($campo, $valor)
{
    $result = array();
    if (isset($_GET["ano"])) $result["ano"] = "ano=" . $_GET["ano"];
    if (isset($_GET["titulo"])) $result["titulo"] = "titulo=" . $_GET["titulo"];
    $result[$campo] = $campo . "=" . $valor;
    return ("livrosDisponiveis.php?" . strtr(implode("&", $result), " ", "+"));
}
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




            <?php


            echo "<select style=\"border:none\" id=\"campo\" name=\"campo\">\n";
            echo "<option value=\"ano\"" . ((isset($_GET["ano"])) ? " selected" : "") . ">Ano</option>\n";
            echo "<option value=\"titulo\"" . ((isset($_GET["titulo"])) ? " selected" : "") . ">Título</option>\n";
            echo "</select>\n";

            $value = "";

            if (isset($_GET["ano"])) $value = $_GET["ano"];
            if (isset($_GET["titulo"])) $value = $_GET["titulo"];
            echo "<input class=\"w3-button w3-white w3-border w3-round-large\" type=\"text\" id=\"valor\" name=\"valor\" value=\"" . $value . "\" size=\"120\" pattern=\"[a-z\s]+$\"> \n";

            echo '<script>';
            echo 'var valor = document.querySelector("#valor");';
            echo 'valor.addEventListener("input", function () {';
            echo 'valor.value = valor.value.toUpperCase();';
            echo '});';
            echo '</script>';

            $parameters = array();
            echo "<a href=\"\" onclick=\"value = document.getElementById('valor').value.trim().replace(/ +/g, '+'); result = '" . strtr(implode("&", $parameters), " ", "+") . "'; result = ((value != '') ? document.getElementById('campo').value+'='+value+((result != '') ? '&' : '') : '')+result; this.href ='livrosDisponiveis.php'+((result != '') ? '?' : '')+result;\">&#x1F50E;</a><br>\n";
            echo "<br>\n";

            $where = array();

            if (isset($_GET["ano"])) $where[] = "ano like '%" . strtr($_GET["ano"], " ", "%") . "%'";
            if (isset($_GET["titulo"])) $where[] = "titulo like '%" . strtr($_GET["titulo"], " ", "%") . "%'";
            $where = (count($where) > 0) ? " and " . implode(" and ", $where) : "";

            ?>
            <div class="w3-container">
                <!-- <select name="campo" style="border:none"id="campo">
                
                    echo "<option " . ((isset($_GET["ano"])) ? " selected" : "") . " value=\"Ano\">Ano</option>";
                    echo "<option " . ((isset($_GET["titulo"])) ? " selected" : "") . "value=\"Titulo\">Titulo</option>";
                
                </select>
                
                $valor = "";
                // if (isset($_GET["ano"])) $valor = $_GET["ano"];
                // if (isset($_GET["titulo"])) $valor = $_GET["titulo"];
                $parameters = [];
                // $url = isset($_GET["titulo"]) ? "livrosDisponiveis.php?titulo=". $_GET["titulo"] : 
                // "livrosDisponiveis.php?ano=" . $_GET["ano"];
                echo "<input class=\"w3-button w3-white w3-border w3-round-large\" type=\"text\" id=\"valor\" name=\"valor\" size=\"120\" pattern=\"[A-Z\s]+$\"> \n";
                echo "<button class=\"w3-button w3-white w3-border w3-round-large\" size\"120\" onclick=\"value = document.getElementById('valor').value.trim().replace(/ +/g, '+'); result = '" . strtr(implode("&", $parameters), " ", "+") . "'; result = ((value != '') ? document.getElementById('campo').value+'='+value+((result != '') ? '&' : '') : '')+result; this.href ='livrosDisponiveis.php'+((result != '') ? '?' : '')+result;\">&#x1F50E;</button><br>\n";
                -->
                <br>
                <br>

                <?php
                $conexao = mysqli_connect("localhost", "root", "", "biblioteca");
                $queryQuantidade = "SELECT COUNT(ID) AS QUANTIDADE FROM (SELECT ID,TITULO,EDITORA,ANO,AUTORES,QUANTIDADE FROM LIVRO WHERE ID NOT IN (SELECT ID FROM LIVRO LEFT JOIN EMPRESTIMO ON LIVRO.ID = EMPRESTIMO.IDLIVRO WHERE EMAILUSUARIO='" . $_SESSION["email"] . "') " . $where . ") SUBQUERY";
                $quantidadeLivros =  mysqli_fetch_array(mysqli_query($conexao, $queryQuantidade))['QUANTIDADE'];

                if ($quantidadeLivros > 0) {
                ?>
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
                        $query = " SELECT ID,TITULO,EDITORA,ANO,AUTORES,QUANTIDADE FROM LIVRO WHERE ID NOT IN (SELECT ID FROM LIVRO LEFT JOIN EMPRESTIMO ON LIVRO.ID = EMPRESTIMO.IDLIVRO WHERE EMAILUSUARIO='" . $_SESSION["email"] . "') " . $where;
                        $resultado = mysqli_query($conexao, $query);
                        while ($linha = mysqli_fetch_array($resultado)) {
                            echo "<tr><td>" . $linha['TITULO'] . "</td><td>" . $linha['AUTORES'] . "</td><td>" . $linha['ANO'] . "</td><td>" . $linha['EDITORA'] . "</td><td>" . $linha['QUANTIDADE'] . "</td><td><button class=\"w3-button w3-white w3-border w3-round-large\"><a href=\"alugarLivro.php?idLivro=" . $linha['ID'] . "\">Alugar</a></button></td></tr>";
                        }
                        ?>
                    </table>
                <?php

                } else {
                    echo '<p class="w3-xlarge ">Que pena, não tem nenhum livro aqui.</p>';
                }
                ?>
            </div>
            <br><br><br><br>

        </div>


    </body>

    </html>
<?php } ?>