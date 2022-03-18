<?php

session_cache_expire(30);
$cache_expire = session_cache_expire();

session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.php?mensagem=erro");
} else {
    echo $_GET["idLivro"];

    $conexao = mysqli_connect("localhost", "root", "", "biblioteca");
    $insertEmprestimo = "INSERT INTO EMPRESTIMO (idLivro, emailUsuario) VALUES (".$_GET['idLivro'].", '".$_SESSION['email']."')";
    $diminuiLivrosDisponiveis = "UPDATE LIVRO SET QUANTIDADE = LIVRO.QUANTIDADE-1";
    mysqli_query($conexao, $insertEmprestimo);
    mysqli_query($conexao, $diminuiLivrosDisponiveis);

    header("Location:emprestimosUsuario.php");

} ?>