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
                <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
                <a href="#servicos" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Serviços</a>
                <a href="#autores" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Autores</a>
                <br><br><br>
                <br><br><br>
                <br><br>
                <?php
                $conexao = mysqli_connect("localhost", "root", "", "biblioteca");
                $nomeUsuario =  mysqli_fetch_array(mysqli_query($conexao, "SELECT NOME FROM USUARIO WHERE EMAIL='". $_SESSION['email'] ."'"))['NOME'];
                echo '<p class="w3-bar-item w3-button w3-hover-white"><i class="fa fa-user-o" aria-hidden="true"></i></i> '.$nomeUsuario.'</p>';
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
                <h1 class="w3-xxxlarge w3-text-red"><b>Propósito</b></h1>
                <p>Queremos democratizar o acesso à cultura.</p>

            </div>

            <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
                <span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
                <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
                    <img id="img01" class="w3-image">
                    <p id="caption"></p>
                </div>
            </div>

            <div class="w3-container" id="servicos" style="margin-top:75px">
                <h1 class="w3-xxxlarge w3-text-red"><b>Serviços</b></h1>

            </div>

            <div class="w3-container" id="autores" style="margin-top:75px">
                <h1 class="w3-xxxlarge w3-text-red"><b>Autores que estão fazendo sucesso</b></h1>

                <p>Os melhores do mundo.</p>
                <br>
            </div>

            <div class="w3-row-padding">
                <div class="w3-col m4 w3-margin-bottom">
                    <div class="w3-light-grey">
                        <img src="https://www.publishnews.com.br/estaticos/uploads/2019/05/cLmyook9buaVbnRBmFMPLHOZAXDw2gQGiX53HEQL13BRvszn63dAXvdKdX9NuVhLDb4sXJJlnrfGNZL6.png" alt="Martha Medeiros" style="width:100%">
                        <div class="w3-container">
                            <h3>Martha Medeiros</h3>
                            <p class="w3-opacity">Cronista</p>
                            <p>É conhecida como uma das melhores cronistas brasileiras. Entre suas obras mais conhecidas estão <b>Divã</b>, <b>Doidas e Santas</b> e <b>Feliz Por Nada</b>. Seus livros já ultrapassaram a marca de 1 milhão de exemplares vendidos.</p>
                        </div>
                    </div>
                </div>
                <div class="w3-col m4 w3-margin-bottom">
                    <div class="w3-light-grey">
                        <img src="https://claudia.abril.com.br/wp-content/uploads/2016/10/bem-estar-brasileiras-reconhecidas-lygia-73479.jpg?quality=85&strip=info&resize=680,453" alt="Lygia" style="width:100%">
                        <div class="w3-container">
                            <h3>Lygia Fagundes Telles</h3>
                            <p class="w3-opacity">Pós-modernista</p>
                            <p>É uma escritora brasileira considerada por acadêmicos, críticos e leitores uma das mais importantes e notáveis escritoras brasileiras do século XX e da história da literatura brasileira.</p>
                        </div>
                    </div>
                </div>
                <div class="w3-col m4 w3-margin-bottom">
                    <div class="w3-light-grey">
                        <img src="https://robertajungmann.com.br/wp-content/uploads/2020/11/unnamed-1-470x352.jpg" alt="Clarisse" style="width:100%">
                        <div class="w3-container">
                            <h3>Clarisse Lispector</h3>
                            <p class="w3-opacity">Modernista</p>
                            <p>Foi um dos maiores nomes da literatura brasileira do Século XX. Com seu romance inovador e com sua linguagem altamente poética, sua obra se destacou diante dos modelos narrativos tradicionais.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <script>
            function w3_open() {
                document.getElementById("mySidebar").style.display = "block";
                document.getElementById("myOverlay").style.display = "block";
            }

            function w3_close() {
                document.getElementById("mySidebar").style.display = "none";
                document.getElementById("myOverlay").style.display = "none";
            }

            function onClick(element) {
                document.getElementById("img01").src = element.src;
                document.getElementById("modal01").style.display = "block";
                var captionText = document.getElementById("caption");
                captionText.innerHTML = element.alt;
            }
        </script>

    </body>

    </html>
<?php } ?>