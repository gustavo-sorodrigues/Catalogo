<?php
include '../conexao.php';
include '../midia.php';

$busca = $_GET['busca'] ?? '';
$erro = "";
$sucesso = "";

$genero_resultado = mysqli_query($conn, "SELECT * FROM generos");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_midia'])) {
    $dados = [
        'tipo' => $_POST['tipo'] ?? '',
        'titulo' => $_POST['titulo'] ?? '',
        'sinopse' => $_POST['sinopse'] ?? '',
        'ano' => isset($_POST['ano']) ? (int)$_POST['ano'] : 0,
        'trailer' => $_POST['trailer'] ?? '',
        'imagem' => $_POST['imagem'] ?? '',
        'destaque' => isset($_POST['destaque']) ? 1 : 0,
        'generos' => $_POST['generos'] ?? []
    ];

    try {
        $midia = new Midia($dados);
        $check_sql = "SELECT * FROM midias WHERE titulo='" . mysqli_real_escape_string($conn, $midia->getTitulo()) . "' AND tipo='" . mysqli_real_escape_string($conn, $midia->getTipo()) . "'";
        $check_res = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_res) > 0) {
            $erro = "Erro: Já existe uma mídia com este título e tipo.";
        } else {
            $midia->salvar($conn);
            $sucesso = "Mídia adicionada com sucesso!";
        }
    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}

if (!empty($busca)) {
    $sql = "SELECT midias.*, GROUP_CONCAT(generos.nome SEPARATOR ', ') AS generos
            FROM midias 
            LEFT JOIN midias_generos mg ON midias.id = mg.midia_id
            LEFT JOIN generos ON mg.genero_id = generos.id
            WHERE midias.titulo LIKE '%" . mysqli_real_escape_string($conn, $busca) . "%'
            GROUP BY midias.id
            LIMIT 1";
} else {
    $sql = "SELECT midias.*, GROUP_CONCAT(generos.nome SEPARATOR ', ') AS generos
            FROM midias 
            LEFT JOIN midias_generos mg ON midias.id = mg.midia_id
            LEFT JOIN generos ON mg.genero_id = generos.id
            GROUP BY midias.id
            ORDER BY destaque DESC, id DESC
            LIMIT 1";
}
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Catálogo de Entretenimento</title>
    <link rel="shortcut icon" type="imagex/png" href="../imagens/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/banco_styles.css">
</head>

<body class="p-4" style="background-color:#000;">
    <main class="container-fluid">
        <div class="row g-4">
            <section class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="mb-4">Adicionar Mídia</h3>
                        <?php if ($erro) echo "<div class='alert alert-danger'>$erro</div>"; ?>
                        <?php if ($sucesso) echo "<div class='alert alert-success'>$sucesso</div>"; ?>
                        <form method="POST" action="">
                            <div class="mb-2">
                                <label>Tipo:</label>
                                <select name="tipo" class="form-control" required>
                                    <option value="filme">Filme</option>
                                    <option value="serie">Série</option>
                                    <option value="anime">Anime</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Título:</label>
                                <input type="text" name="titulo" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Sinopse:</label>
                                <textarea name="sinopse" class="form-control"></textarea>
                            </div>
                            <div class="mb-2">
                                <label>Ano:</label>
                                <input type="number" name="ano" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>Gêneros:</label>
                                <select name="generos[]" class="form-control" multiple required>
                                    <?php while ($gen = mysqli_fetch_assoc($genero_resultado)) {
                                        echo "<option value='{$gen['id']}'>{$gen['nome']}</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Trailer (URL):</label>
                                <input type="text" name="trailer" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>Imagem (URL):</label>
                                <input type="text" name="imagem" class="form-control">
                            </div>
                            <div class="mb-2 form-check">
                                <input type="checkbox" name="destaque" class="form-check-input" id="destaque">
                                <label class="form-check-label" for="destaque">Destaque</label>
                            </div>
                            <button type="submit" name="adicionar_midia" class="btn btn-success mt-2">Adicionar</button>
                        </form>
                    </div>
                </div>
            </section>
            <section class="col-md-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-body d-flex align-items-center gap-2">
                        <form method="GET" action="" class="d-flex w-100">
                            <input type="text" name="busca" class="form-control" placeholder="Buscar por título..." value="<?= htmlspecialchars($busca) ?>">
                            <button class="btn btn-success ms-2">Buscar</button>
                        </form>
                    </div>
                </div>
                <?php if (mysqli_num_rows($resultado) > 0) { ?>
                    <?php while ($midia = mysqli_fetch_assoc($resultado)) { ?>
                        <div class="card mb-3 shadow-sm">
                            <div class="row g-0">
                                <?php if (!empty($midia['imagem'])) { ?>
                                    <div class="col-md-4">
                                        <img src="<?= $midia['imagem'] ?>" class="img-fluid rounded-start" alt="<?= $midia['titulo'] ?>">
                                    </div>
                                <?php } ?>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $midia['titulo'] ?> (<?= $midia['tipo'] ?>, <?= $midia['ano'] ?>)</h5>
                                        <p><strong>Gêneros:</strong> <?= $midia['generos'] ?: 'Sem gênero' ?></p>
                                        <p class="card-text"><?= $midia['sinopse'] ?></p>
                                        <div class="d-flex gap-2">
                                            <a href="editar.php?id=<?= $midia['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="deletar.php?acao=excluir&id=<?= $midia['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que quer excluir?')">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="alert alert-info">Nenhuma mídia encontrada.</div>
                <?php } ?>
            </section>
        </div>
        <a href="../index.php" class="btn btn-success mt-3 ms-3">Voltar</a>
    </main>
    <?php mysqli_close($conn); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>