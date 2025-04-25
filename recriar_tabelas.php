<?php
include("./config.php");

$db = new mysql();

$acao = $_GET['acao'] ?? '';

switch ($acao) {
    case 'criar_disciplinas':
        $db->dropTable('dicionario');
        $db->createDicionarioTable();
        $db->dropTable('disciplinas');
        $db->createDisciplinaTable();
        echo "Tabela 'disciplinas' recriada com sucesso!";
        break;

    case 'criar_dicionario':
        $db->dropTable('dicionario');
        $db->createDicionarioTable();
        echo "Tabela 'dicionario' recriada com sucesso!";
        break;

    case 'ins_disc':
        // Carregar dados na tabela 'disciplinas'
        $db->insertDisciplinaData();
        echo "Dados carregados na tabela 'disciplinas' com sucesso!";
        break;

    case 'ins_dici':
        // Carregar dados na tabela 'dicionario'
        $db->insertDicionarioData();
        echo "Dados carregados na tabela 'dicionario' com sucesso!";
        break;

    case 'restaurar':
        // Restaurar as tabelas (dropar e recriar)
        $db->dropTable('disciplinas');
        $db->createDisciplinaTable();
        $db->insertDisciplinaData();
        
        $db->dropTable('dicionario');
        $db->createDicionarioTable();
        $db->insertDicionarioData();

        echo "Banco restaurado com sucesso!";
        break;

    default:
        echo "Ação inválida.";
        break;
}
?>
<br><a href="index.php">Voltar para a Home</a>
