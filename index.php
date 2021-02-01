<?php 

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;

// BUSCA
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

// STATUS
$filtroStatus = strtolower(filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING));
$filtroStatus = in_array($filtroStatus, array('s', 'n')) ? $filtroStatus : '';

// CONDIÇÕES SQL
$condicoes = [ 
    strlen($busca) ? 'titulo LIKE "%'.str_replace(' ','%', $busca).'%"' : null, 
    strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
];



// CLÁUSULA WHERE
$condicoes = array_filter($condicoes);

// OBTÉM AS VAGAS
$vagas = vaga::getVagas($where);

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';

?>