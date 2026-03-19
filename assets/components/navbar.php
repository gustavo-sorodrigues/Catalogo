<?php
$usuario_id = $_SESSION['id'] ?? 0;
$nome_usuario = '';
$usuario_foto = 'user.jpg';

if ($usuario_id > 0) {
    $res = mysqli_query($conn, "SELECT nome, foto FROM usuarios WHERE id = $usuario_id");
    if ($res && mysqli_num_rows($res) > 0) {
        $usuario = mysqli_fetch_assoc($res);
        $nome_usuario = $usuario['nome'];
        if (!empty($usuario['foto'])) {
            $usuario_foto = $usuario['foto'];
        }
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">


        <a class="navbar-brand" href="#">
            <img src="/Catálogo+/imagens/logo.png" alt="logo" style="width:200px; height:auto;">
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarContent">


            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina_atual == 'index.php') echo 'active'; ?>" href="/Catálogo+/index.php">Página Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina_atual == 'filmes.php') echo 'active'; ?>" href="/Catálogo+/paginas/filmes.php">Filmes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina_atual == 'series.php') echo 'active'; ?>" href="/Catálogo+/paginas/series.php">Séries</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina_atual == 'animes.php') echo 'active'; ?>" href="/Catálogo+/paginas/animes.php">Animes</a>
                </li>
            </ul>


            <form class="d-flex  my-2 my-lg-0" role="search" method="get" action="/Catálogo+/buscar.php" style="max-width: 400px;">
                <input class="form-control me-1" type="search" name="q" placeholder="" aria-label="Buscar">
                <button class="btn" type="submit" style="background-color: #ffc857; color: #000; border: none; white-space: nowrap;">
                    Buscar
                </button>
            </form>


            <div class="dropdown ms-5">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle " style="color:#ffc857" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/Catálogo+/imagens/<?php echo $usuario_foto; ?>" alt="Avatar" width="40" height="40" class="rounded-circle me-1">
                    <strong style="color:#ffc857; font-size:14px; "><?= htmlspecialchars($nome_usuario) ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow mt-2" aria-labelledby="dropdownUser">
                    <?php
                    if ($nome_usuario === 'admin') {
                        echo '<li><a class="dropdown-item" href="/Catálogo+/database/bancoDados.php" style="color:#ffc857;">Minha Área</a></li>';
                        echo '<li><a class="dropdown-item" href="/Catálogo+/usuarios/perfil.php" style="color:#ffc857;">Meu Perfil</a></li>';
                    } else {
                        echo '<li><a class="dropdown-item" href="/Catálogo+/usuarios/perfil.php" style="color:#ffc857;">Meu Perfil</a></li>';
                    }
                    ?>
                    <li><a class="dropdown-item" href="/Catálogo+/usuarios/login.php" style="color:#ffc857;">Sair</a></li>
                </ul>
            </div>

        </div>
    </div>
</nav>