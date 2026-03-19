<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/Catálogo+/conexao.php';

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

if (!isset($_SESSION['id'])) {
    header("Location: /Catálogo+/index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['id'];
    $tipo = isset($_POST['tipo']) ? mysqli_real_escape_string($conn, $_POST['tipo']) : '';
    $id_item = isset($_POST['id_item']) ? intval($_POST['id_item']) : 0;
    $nota = isset($_POST['nota']) ? floatval($_POST['nota']) : 0;
    $comentario = isset($_POST['comentario']) ? mysqli_real_escape_string($conn, $_POST['comentario']) : '';

    if (!empty($tipo) && $id_item > 0 && $nota >= 1 && $nota <= 5) {
        $sql = "INSERT INTO avaliacoes (tipo, id_item, nota, comentario, id_usuario) 
                VALUES ('$tipo', $id_item, $nota, '$comentario', $id_usuario)";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado) {
            $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : '/Catálogo+/index.php';
            header("Location: $redirect");
            exit;
        } else {
            echo "<div class='alert alert-danger text-center mt-3'>Erro ao salvar: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center mt-3'>Preencha todos os campos corretamente e use nota de 1 a 5.</div>";
    }
}

if ($conn) {
    mysqli_close($conn);
}
