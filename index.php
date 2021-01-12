<?php 

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;

// BUSCA
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

// CONDIÇÕES SQL
$condicoes = [
    strlen($busca) ? 'titulo LIKE "%'.str_replace(' ','%', $busca).'%"' : null
];

// CLÁUSULA WHERE
$where = implode(' AND ', $condicoes);

// OBTÉM AS VAGAS
$vagas = vaga::getVagas($where);

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';

?>