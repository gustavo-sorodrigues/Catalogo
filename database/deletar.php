<?php
include '../conexao.php';
include '../midia.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $midia_result = mysqli_query($conn, "SELECT * FROM midias WHERE id=$id");
    if (!$midia_result || mysqli_num_rows($midia_result) === 0) die("Mídia não encontrada.");
    $dados = mysqli_fetch_assoc($midia_result);
    $mg_result = mysqli_query($conn, "SELECT genero_id FROM midias_generos WHERE midia_id=$id");
    $generos = [];
    while ($row = mysqli_fetch_assoc($mg_result)) $generos[] = $row['genero_id'];
    $dados['generos'] = $generos;

    $midia = new Midia($dados);

    mysqli_query($conn, "DELETE FROM midias_generos WHERE midia_id=" . $id);
    $delete = mysqli_query($conn, "DELETE FROM midias WHERE id=" . $id);

    if ($delete) {
        header("Location: bancoDados.php");
        exit;
    } else {
        die("Erro ao excluir mídia: " . mysqli_error($conn));
    }
} else {
    die("ID da mídia não fornecido.");
}

mysqli_close($conn);
