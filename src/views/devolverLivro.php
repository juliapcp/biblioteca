<?php

session_cache_expire(30);
$cache_expire = session_cache_expire();

session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.php?mensagem=erro");
} else {
    $conexao = mysqli_connect("localhost", "root", "", "biblioteca");
    $deleteEmprestimo = "DELETE FROM EMPRESTIMO WHERE IDLIVRO=".$_GET['idLivro']." and EMAILUSUARIO = '".$_SESSION['email']."'";
    $aumentaLivrosDisponiveis = "UPDATE LIVRO SET QUANTIDADE = LIVRO.QUANTIDADE+1";
    mysqli_query($conexao, $deleteEmprestimo);
    mysqli_query($conexao, $aumentaLivrosDisponiveis);

    header("Location:livrosDisponiveis.php");

}
