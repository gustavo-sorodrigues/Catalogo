<?php

$midiaId = intval($midia['id']);
$midiaTipo = htmlspecialchars($midia['tipo']);

$sqlMedia = "SELECT AVG(nota) AS media FROM avaliacoes WHERE tipo='$midiaTipo' AND id_item=$midiaId";
$resultMedia = $conn->query($sqlMedia);
$linhaMedia = $resultMedia->fetch_assoc();
$mediaNotas = $linhaMedia['media'] ?? 0;

$sqlComentarios = "
    SELECT a.nota, a.comentario, u.nome, u.foto
    FROM avaliacoes a
    JOIN usuarios u ON a.id_usuario = u.id
    WHERE a.tipo='$midiaTipo' AND a.id_item=$midiaId
";
$resultComentarios = $conn->query($sqlComentarios);
$listaComentarios = [];
while ($comentarioAtual = $resultComentarios->fetch_assoc()) {
    $comentarioAtual['nome'] = htmlspecialchars($comentarioAtual['nome']);
    $comentarioAtual['comentario'] = htmlspecialchars($comentarioAtual['comentario']);
    $comentarioAtual['foto'] = !empty($comentarioAtual['foto'])
        ? '/Catálogo+/imagens/' . $comentarioAtual['foto']
        : '/Catálogo+/imagens/user.jpg';
    $listaComentarios[] = $comentarioAtual;
}

$videoId = '';
if (!empty($midia['trailer'])) {
    preg_match("/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/", $midia['trailer'], $matches);
    $videoId = $matches[1] ?? '';
}
?>


<div id="customModal<?= $midiaId ?>" class="custom-modal">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <h5><?= htmlspecialchars($midia['titulo']) ?> (<?= intval($midia['ano']) ?>)</h5>
            <button type="button" class="custom-close" onclick="Modal.fechar(<?= $midiaId ?>)">×</button>
        </div>

        <div class="custom-modal-body">
            <?php if (!empty($midia['sinopse'])) { ?>
                <p><?= nl2br(htmlspecialchars($midia['sinopse'])) ?></p>
            <?php } ?>

            <?php if ($videoId) { ?>
                <div class="custom-ratio">
                    <iframe src="https://www.youtube.com/embed/<?= $videoId ?>" allowfullscreen></iframe>
                </div>
            <?php } ?>

            <hr>
            <h5>Avaliações</h5>
            <p><strong>Média das notas:</strong> ⭐ <?= number_format($mediaNotas, 1) ?></p>

            <?php if (count($listaComentarios) > 0) { ?>
                <?php foreach ($listaComentarios as $comentario) { ?>
                    <div class="custom-comment">
                        <img src="<?= $comentario['foto'] ?>" alt="Foto do usuário">
                        <div>
                            <strong><?= $comentario['nome'] ?></strong> ⭐ <?= intval($comentario['nota']) ?><br>
                            <?= nl2br($comentario['comentario']) ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Nenhuma avaliação ainda.</p>
            <?php } ?>

            <hr>
            <h5>Deixe sua avaliação</h5>
            <form method="POST" action="/Catálogo+/usuarios/votar.php" class="custom-form">
                <input type="hidden" name="tipo" value="<?= $midiaTipo ?>">
                <input type="hidden" name="id_item" value="<?= $midiaId ?>">
                <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">

                <div class="form-group">
                    <label>Nota (1 a 5):</label>
                    <input type="number" name="nota" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <label>Comentário (opcional):</label>
                    <textarea name="comentario" maxlength="500"></textarea>
                </div>
                <button type="submit" class="custom-btn">Enviar</button>
            </form>
        </div>
    </div>
</div>