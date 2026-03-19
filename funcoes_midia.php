<?php
function buscarMidias($conn, $tipo, $titulo = '', $pagina_atual = 1, $registros_por_pagina = 20)
{
    $titulo = mysqli_real_escape_string($conn, $titulo);
    $inicio = ($pagina_atual - 1) * $registros_por_pagina;

    $where = "WHERE tipo='$tipo'";
    if ($titulo !== '') {
        $where .= " AND titulo LIKE '%$titulo%'";
    }

    $total_query = mysqli_query($conn, "SELECT COUNT(*) FROM midias $where");
    $total_registros = $total_query->fetch_row()[0];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    $sql = "SELECT * FROM midias $where ORDER BY destaque DESC, id DESC LIMIT $inicio, $registros_por_pagina";
    $res = mysqli_query($conn, $sql);

    return [
        'dados' => $res,
        'total_paginas' => $total_paginas,
        'total_registros' => $total_registros
    ];
}
