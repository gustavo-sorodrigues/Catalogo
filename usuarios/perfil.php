<?php
include '../conexao.php';

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = ($_SESSION['id']);

$result = mysqli_query($conn, "SELECT * FROM usuarios WHERE id=$usuario_id");
$user = mysqli_fetch_assoc($result);

if (isset($_POST['enviar_foto'])) {
    $arquivo = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if ($arquivo != "") {
        $novo_arquivo = "../imagens/perfil_" . $usuario_id . ".jpg";

        if (move_uploaded_file($tmp, $novo_arquivo)) {
            mysqli_query($conn, "UPDATE usuarios SET foto='$novo_arquivo' WHERE id=$usuario_id");
            $_SESSION['foto'] = $novo_arquivo;
            $user['foto'] = $novo_arquivo;

            header("Location: ../index.php");
            exit;
        } else {
            echo "alert('Erro ao enviar a foto.')";
        }
    }
}

$avaliacoes_query = mysqli_query($conn, "
    SELECT a.nota, a.comentario, m.titulo, m.tipo
    FROM avaliacoes a
    JOIN midias m ON a.id_item = m.id
    WHERE a.id_usuario = $usuario_id
    ORDER BY a.id DESC
");

$avaliacoes = mysqli_fetch_all($avaliacoes_query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="shortcut icon" type="imagex/png" href="../imagens/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/banco_styles.css">
</head>

<body>
    <main class="container mt-5">
        <div class="row">

            <section class="col-md-4 text-center">
                <h4>Foto de Perfil</h4>
                <img src="<?php
                            if (isset($user['foto']) && $user['foto'] != '') {
                                echo $user['foto'] . '?';
                            } else {
                                echo '../imagens/user.jpg';
                            }
                            ?>" alt="Perfil" class="rounded-circle mb-3" width="150" height="150">

                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="foto" class="form-control mb-2" required>
                    <button type="submit" name="enviar_foto" class="btn btn-warning w-100" style="background-color:#ffc857 !important">Enviar Imagem</button>
                </form>
            </section>

            <section class="col-md-8">
                <h4>Minhas Avaliações</h4>
                <?php
                if (count($avaliacoes) > 0) {
                    foreach ($avaliacoes as $a) {
                        echo '<div style="margin-bottom:15px; padding:10px; border-bottom:1px solid #ccc;">';
                        echo '<strong>' . $a['titulo'] . ' (' . $a['tipo'] . ') - ' . $a['nota'] . '/5</strong><br>';
                        echo '<span>' . $a['comentario'] . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Nenhuma avaliação feita ainda.</p>';
                }
                ?>
            </section>

        </div>
        <a href="../index.php" class="btn btn-success mt-4 ms-1">Voltar</a>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>