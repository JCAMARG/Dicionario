<?php
include("./config.php");

$db = new mysql();

$acao = $_GET['acao'] ?? '';

switch ($acao) {
    case 'disciplinas':
        $db->resetDisciplinaTable();
        echo "Tabela 'disciplinas' recriada com sucesso!";
        break;

    case 'dicionario':
        $db->resetDicionarioTable();
        echo "Tabela 'dicionario' recriada com sucesso!";
        break;

    default:
        echo "Ação inválida.";
        break;
}
?>
<br><a href="index.php">Voltar para a Home</a>
