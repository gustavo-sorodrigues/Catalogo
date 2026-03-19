<?php
include '../conexao.php';
include '../funcoes_midia.php';

session_start();

$titulo = $_GET['titulo'] ?? '';
$pagina = $_GET['pagina'] ?? 1;

$resultado = buscarMidias($conn, 'serie', $titulo, $pagina);
$series = $resultado['dados'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Séries</title>
    <link rel="shortcut icon" type="imagex/png" href="../imagens/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <main class="container mt-3">
        <h1>Séries</h1>

        <section class="mt-4">
            <div class="row row-cols-1 row-cols-md-5 g-3">
                <?php
                if (mysqli_num_rows($series) > 0) {
                    while ($midia = mysqli_fetch_assoc($series)) {
                ?>
                        <div class="col">
                            <div class="card" onclick="Modal.abrir(<?= intval($midia['id']) ?>)">
                                <?php if (!empty($midia['imagem'])) { ?>
                                    <img src="<?= htmlspecialchars($midia['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($midia['titulo']) ?>">
                                <?php } ?>
                                <div class="card-body">
                                    <div class="card-title"><?= htmlspecialchars($midia['titulo']) ?></div>
                                </div>
                            </div>

                            <?php include '../components/cardmodel.php'; ?>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Nenhuma série encontrada.</p>";
                }
                ?>
            </div>
        </section>

        <?php include '../components/pagination.php'; ?>
    </main>

    <footer class="d-flex flex-column flex-sm-row justify-content-center py-4 my-4 border-top">
        <p>© 2025 – Trabalho acadêmico desenvolvido no âmbito da disciplina de Análise e Desenvolvimento de Sistemas, pertencente ao curso da Universidade de Mogi das Cruzes (UMC).</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/modal.js"></script>
</body>

</html>

<?php mysqli_close($conn); ?>