<?php
include '../conexao.php';
include '../midia.php';

$midia = new Midia();

try {
    $midia->setTipo($_POST['tipo'] ?? '');
    $midia->setTitulo($_POST['titulo'] ?? '');
    $midia->setSinopse($_POST['sinopse'] ?? '');
    $midia->setTrailer($_POST['trailer'] ?? '');
    $midia->setImagem($_POST['imagem'] ?? '');
    $midia->setAno(isset($_POST['ano']) ? (int)$_POST['ano'] : 0);
    $midia->setDestaque(isset($_POST['destaque']) ? 1 : 0);
    $midia->setGeneros($_POST['generos'] ?? []);

    $midia->salvar($conn);

    echo "Nova mídia inserida com sucesso!";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

mysqli_close($conn);
