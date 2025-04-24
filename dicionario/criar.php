<?php
// criar.php

function checkAndCreateTable($dbObj) {
    // Verificar se a tabela "dicionario" existe
    $checkTableSql = "SELECT to_regclass('public.dicionario')";
    $checkResult = $dbObj->query($checkTableSql);
    $checkRow = pg_fetch_row($checkResult);
    
    // Se a tabela não existir, criá-la
    if (!$checkRow[0]) {
        // Criar a tabela "dicionario"
        $createTableSql = "
        CREATE TABLE dicionario (
            ID SERIAL PRIMARY KEY,
            PALAVRA_ORIG VARCHAR(255) NOT NULL,
            ID_DISCIPLINA INT NOT NULL,
            CONSTRAINT FK_DICIONARIO_DISCIPLINA FOREIGN KEY (ID_DISCIPLINA)
                REFERENCES disciplinas (ID_DISCIPLINA) ON DELETE CASCADE ON UPDATE CASCADE
        )";
      
        $dbObj->query($createTableSql);
        echo "Tabela 'dicionario' criada com sucesso!";
    }
}
?>
