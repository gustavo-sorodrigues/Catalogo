<?php
include 'conexao.php';

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

$q = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

if ($q != "") {
    $sql = "SELECT * FROM midias WHERE titulo LIKE '%$q%'";
    $resultado = mysqli_query($conn, $sql);

    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($resultado) > 0) {
        $midia = mysqli_fetch_assoc($resultado);

        if ($midia['tipo'] === 'filme') {
            header("Location: paginas/filmes.php?titulo=" . urlencode($midia['titulo']));
            exit;
        } elseif ($midia['tipo'] === 'serie') {
            header("Location: paginas/series.php?titulo=" . urlencode($midia['titulo']));
            exit;
        } elseif ($midia['tipo'] === 'anime') {
            header("Location: paginas/animes.php?titulo=" . urlencode($midia['titulo']));
            exit;
        }
    } else {
        echo "<div class='alert alert-warning text-center mt-3'>Nenhuma mídia encontrada com esse nome.</div>";
    }
} else {
    echo "<div class='alert alert-info text-center mt-3'>Digite um nome para buscar.</div>";
}

if ($conn) {
    mysqli_close($conn);
}
