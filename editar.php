<?php
include '../conexao.php';
include '../midia.php';

$id = (int)$_GET['id'];
$midia_result = mysqli_query($conn, "SELECT * FROM midias WHERE id=$id");
if (!$midia_result || mysqli_num_rows($midia_result) === 0) die("Mídia não encontrada.");
$dados = mysqli_fetch_assoc($midia_result);

$mg_result = mysqli_query($conn, "SELECT genero_id FROM midias_generos WHERE midia_id=$id");
$generos = [];
while ($row = mysqli_fetch_assoc($mg_result)) {
    $generos[] = $row['genero_id'];
}
$dados['generos'] = $generos;

$midia = new Midia($dados);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $midia->setTitulo(trim($_POST['titulo']));
        $midia->setTipo(trim($_POST['tipo']));
        $midia->setSinopse(trim($_POST['sinopse']));
        $midia->setTrailer(trim($_POST['trailer']));
        $midia->setImagem(trim($_POST['imagem']));
        $midia->setAno((int)$_POST['ano']);
        $midia->setGeneros($_POST['generos'] ?? []);
        $midia->setDestaque(isset($_POST['destaque']) ? 1 : 0);
        $midia->salvar($conn);
        header("Location: ../database/bancoDados.php");
        exit;
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}

$generos_result = mysqli_query($conn, "SELECT * FROM generos");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Mídia</title>
    <link rel="shortcut icon" type="imagex/png" href="../imagens/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/banco_styles.css">
</head>

<body class="p-4">
    <main class="container">
        <section class="mb-4">
            <h3>Editar Mídia</h3>
            <?php foreach ($errors as $error) { ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php } ?>
        </section>

        <section>
            <form method="POST" class="mb-5">
                <div class="mb-2">
                    <label>Título:</label>
                    <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($midia->getTitulo()) ?>">
                </div>

                <div class="mb-2">
                    <label>Tipo:</label>
                    <select name="tipo" class="form-control">
                        <option value="filme" <?= $midia->getTipo() === 'filme' ? 'selected' : '' ?>>Filme</option>
                        <option value="serie" <?= $midia->getTipo() === 'serie' ? 'selected' : '' ?>>Série</option>
                        <option value="anime" <?= $midia->getTipo() === 'anime' ? 'selected' : '' ?>>Anime</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>Sinopse:</label>
                    <textarea name="sinopse" class="form-control"><?= htmlspecialchars($midia->getSinopse()) ?></textarea>
                </div>

                <div class="mb-2">
                    <label>Trailer URL:</label>
                    <input type="text" name="trailer" class="form-control" value="<?= htmlspecialchars($midia->getTrailer()) ?>">
                </div>

                <div class="mb-2">
                    <label>Imagem (URL):</label>
                    <input type="text" name="imagem" class="form-control" value="<?= htmlspecialchars($midia->getImagem() ?? '') ?>">
                </div>

                <div class="mb-2">
                    <label>Ano:</label>
                    <input type="number" name="ano" class="form-control" value="<?= htmlspecialchars($midia->getAno()) ?>">
                </div>

                <div class="mb-2">
                    <label>Gêneros:</label>
                    <select name="generos[]" class="form-control" multiple>
                        <?php while ($gen = mysqli_fetch_assoc($generos_result)) { ?>
                            <option value="<?= $gen['id'] ?>" <?= in_array($gen['id'], $midia->getGeneros()) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($gen['nome']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-2 form-check">
                    <input type="checkbox" name="destaque" class="form-check-input" id="destaque" <?= $midia->getDestaque() ? 'checked' : '' ?>>
                    <label class="form-check-label" for="destaque">Destaque</label>
                </div>

                <button type="submit" class="btn btn-primary" style="color:black !important; background-color:#ffc857 !important"> Confirmar Alteração</button>
            </form>
            <a href="bancoDados.php" class="btn btn-success mt-1 ms-1">Voltar</a>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>