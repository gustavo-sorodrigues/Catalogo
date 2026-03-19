<?php
include 'conexao.php';
if (!isset($_SESSION)) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo de Filmes, Séries e Animes</title>

  <link rel="shortcut icon" type="imagex/png" href="imagens/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/modal.css">
</head>

<body>
  <header>
    <?php include 'components/navbar.php'; ?>

    <div class="banner">
      <img src="imagens/1.png" alt="Banner" class="img-fluid w-100">
    </div>
  </header>

  <main class="container mt-3">
    <h1>Destaques</h1>

    <section id="filmes" class="mt-4">
      <h2>Filmes</h2>
      <div class="row row-cols-1 row-cols-md-5 g-3">
        <?php
        $filmes = mysqli_query($conn, "SELECT * FROM midias WHERE tipo='filme' AND destaque=1 ORDER BY titulo DESC, id DESC LIMIT 5");
        if ($filmes) {
          while ($midia = mysqli_fetch_assoc($filmes)) {
            $imagem = !empty($midia['imagem']) ? htmlspecialchars($midia['imagem']) : 'imagens/default.jpg';
            $titulo = htmlspecialchars($midia['titulo']);
        ?>
            <div class="col">
              <div class="card" onclick="Modal.abrir(<?= intval($midia['id']) ?>)">
                <img src="<?= $imagem ?>" alt="<?= $titulo ?>" class="card-img-top">
                <div class="card-body">
                  <div class="card-title"><?= $titulo ?></div>
                </div>
              </div>

              <?php include 'components/cardmodel.php'; ?>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </section>

    <section id="series" class="mt-5">
      <h2>Séries</h2>
      <div class="row row-cols-1 row-cols-md-5 g-3">
        <?php
        $series = mysqli_query($conn, "SELECT * FROM midias WHERE tipo='serie' AND destaque=1 ORDER BY titulo DESC, id DESC LIMIT 5");
        if ($series) {
          while ($midia = mysqli_fetch_assoc($series)) {
            $imagem = !empty($midia['imagem']) ? htmlspecialchars($midia['imagem']) : 'imagens/default.jpg';
            $titulo = htmlspecialchars($midia['titulo']);
        ?>
            <div class="col">
              <div class="card" onclick="Modal.abrir(<?= intval($midia['id']) ?>)">
                <img src="<?= $imagem ?>" alt="<?= $titulo ?>" class="card-img-top">
                <div class="card-body">
                  <div class="card-title"><?= $titulo ?></div>
                </div>
              </div>

              <?php include 'components/cardmodel.php'; ?>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </section>

    <section id="animes" class="mt-5">
      <h2>Animes</h2>
      <div class="row row-cols-1 row-cols-md-5 g-3">
        <?php
        $animes = mysqli_query($conn, "SELECT * FROM midias WHERE tipo='anime' AND destaque=1 ORDER BY titulo DESC, id DESC LIMIT 5");
        if ($animes) {
          while ($midia = mysqli_fetch_assoc($animes)) {
            $imagem = !empty($midia['imagem']) ? htmlspecialchars($midia['imagem']) : 'imagens/default.jpg';
            $titulo = htmlspecialchars($midia['titulo']);
        ?>
            <div class="col">
              <div class="card" onclick="Modal.abrir(<?= intval($midia['id']) ?>)">
                <img src="<?= $imagem ?>" alt="<?= $titulo ?>" class="card-img-top">
                <div class="card-body">
                  <div class="card-title"><?= $titulo ?></div>
                </div>
              </div>

              <?php include 'components/cardmodel.php'; ?>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </section>
  </main>

  <footer class="d-flex flex-column flex-sm-row justify-content-center py-4 my-4 border-top">
    <p>© 2025 – Trabalho acadêmico desenvolvido no âmbito da disciplina de Análise e Desenvolvimento de Sistemas, pertencente ao curso da Universidade de Mogi das Cruzes (UMC).</p>
  </footer>

  <?php mysqli_close($conn); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/modal.js"></script>
</body>

</html>