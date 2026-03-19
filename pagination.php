<?php
$total_paginas = 3;
$pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

        <li class="page-item <?php if ($pagina_atual <= 1) echo 'disabled'; ?>">
            <a class="page-link mt-3" style="color:#1f2a38; padding:8px 16px; border-radius:0.25rem 0 0 0.25rem; border:none;" href="?pagina=<?php echo $pagina_atual - 1; ?>">
                <span>&laquo;</span>
            </a>
        </li>

        <?php
        for ($i = 1; $i <= $total_paginas; $i++) {
            $active = ($i == $pagina_atual) ? 'active' : '';

            echo '<li class="page-item ' . $active . '">
            <a class="page-link mt-3"
               style="color:#1f2a38; padding:8px 16px; border:none; ' . (($i == $pagina_atual) ? 'background-color:#ffc857; color:#1f2a38;' : '') . '"
               href="?pagina=' . $i . '">' . $i . '</a>
          </li>';
        }
        ?>

        <li class="page-item <?php if ($pagina_atual >= $total_paginas) echo 'disabled'; ?>">
            <a class="page-link mt-3" style="color:#1f2a38; padding:8px 16px; border-radius:0 0.25rem 0.25rem 0; border:none;" href="?pagina=<?php echo $pagina_atual + 1; ?>">
                <span>&raquo;</span>
            </a>
        </li>

    </ul>
</nav>