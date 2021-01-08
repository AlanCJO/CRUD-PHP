<?php 

require __DIR__.'/vendor/autoload.php';

use App\Entity\Vaga;

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    header('location: index.php?status=error');
    exit;
}

// CONSULTA VAGA
$obVaga = Vaga::getVaga($_GET['id']);

// VALIDAÇÃO DA VAGA - Se não for uma instância de vaga
if(!$obVaga instanceof Vaga)
{
    header('location: index.php?status=error');
    exit;
}


// VALIDAÇÃO DO POST
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo']))
{

    $obVaga->titulo     = $_POST['titulo'];
    $obVaga->descricao  = $_POST['descricao'];
    $obVaga->ativo      = $_POST['ativo'];
    $obVaga->atualizar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';

?>