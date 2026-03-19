<?php
include '../conexao.php';

if (!$conn) {
  die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

session_start();

$acao = $_POST['acao'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($acao === 'login') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (!empty($email) && !empty($senha)) {
      $res = mysqli_query($conn, "SELECT * FROM usuarios WHERE email='$email' LIMIT 1");
      if (!$res) {
        die("Erro na consulta: " . mysqli_error($conn));
      }

      if (mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);

        if (password_verify($senha, $user['senha'])) {
          $_SESSION['id'] = $user['id'];
          $_SESSION['nome'] = $user['nome'];
          $_SESSION['tipo'] = $user['tipo'];

          if ($user['tipo'] === 'admin') {
            header("Location: ../database/bancoDados.php");
          } else {
            header("Location: ../index.php");
          }
          exit;
        } else {
          $erro = "E-mail ou senha incorretos";
        }
      } else {
        $erro = "E-mail não encontrado";
      }
    } else {
      $erro = "Preencha todos os campos";
    }
  } elseif ($acao === 'cadastro') {
    $nome = mysqli_real_escape_string($conn, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $senha = trim($_POST['senha']);

    if (!empty($nome) && !empty($email) && !empty($senha)) {
      if (strlen($senha) < 8) {
        $erro = "A senha deve ter pelo menos 8 caracteres.";
      } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha_hash', 'usuario')";
        $cad = mysqli_query($conn, $sql);

        if (!$cad) {
          $erro = "Erro ao cadastrar: " . mysqli_error($conn);
        } else {
          $sucesso = "Cadastro realizado com sucesso!";
        }
      }
    } else {
      $erro = "Preencha todos os campos";
    }
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Cadastro</title>
  <link rel="shortcut icon" type="imagex/png" href="../imagens/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/login_styles.css">
</head>

<body>
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="width:500px; max-width:95%;">
      <div class="card-body p-4">

        <?php if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
        <?php if (isset($sucesso)) echo "<div class='alert alert-success'>$sucesso</div>"; ?>

        <ul class="nav nav-tabs mb-3" id="authTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Login</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Cadastro</button>
          </li>
        </ul>

        <div class="tab-content">

          <div class="tab-pane fade show active" id="login" role="tabpanel">
            <form method="post">
              <input type="hidden" name="acao" value="login">
              <div class="mb-3">
                <label for="emailLogin" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="emailLogin" name="email" placeholder="seu@exemplo.com" required>
              </div>
              <div class="mb-3">
                <label for="senhaLogin" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senhaLogin" name="senha" placeholder="Digite sua senha" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
          </div>

          <div class="tab-pane fade" id="register" role="tabpanel">
            <form method="post">
              <input type="hidden" name="acao" value="cadastro">
              <div class="mb-3">
                <label for="nomeRegister" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nomeRegister" name="nome" placeholder="Seu nome" required>
              </div>
              <div class="mb-3">
                <label for="emailRegister" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="emailRegister" name="email" placeholder="seu@exemplo.com" required>
              </div>
              <div class="mb-3">
                <label for="senhaRegister" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senhaRegister" name="senha" placeholder="Digite sua senha" required>
              </div>
              <button type="submit" class="btn btn-success w-100">Cadastrar</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>