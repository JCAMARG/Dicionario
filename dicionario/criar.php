<?php
// criar.php

// Função para verificar se uma tabela existe
function tableExists($dbObj, $tableName) {
    $query = "SELECT to_regclass('public.$tableName')";
    $result = $dbObj->query($query);
    $row = pg_fetch_row($result);
    
    return $row[0] ? true : false;
}

// Função para criar a tabela 'DISCIPLINAS'
function createDisciplinaTable($dbObj) {
    $createTableSql = "
    CREATE TABLE IF NOT EXISTS disciplinas (
        ID_DISCIPLINA SERIAL PRIMARY KEY,
        NOME VARCHAR(255) NOT NULL
    )";
    
    $dbObj->query($createTableSql);
    echo "Tabela 'DISCIPLINAS' criada ou já existente.\n";
}

// Função para criar a tabela 'DICIONARIO'
function createDicionarioTable($dbObj) {
    $createTableSql = "
    CREATE TABLE IF NOT EXISTS dicionario (
        ID SERIAL PRIMARY KEY,
        PALAVRA_ORIG VARCHAR(255) NOT NULL,
        ID_DISCIPLINA INT NOT NULL,
        CONSTRAINT FK_DICIONARIO_DISCIPLINA FOREIGN KEY (ID_DISCIPLINA)
            REFERENCES disciplinas (ID_DISCIPLINA) ON DELETE CASCADE ON UPDATE CASCADE
    )";
    
    $dbObj->query($createTableSql);
    echo "Tabela 'DICIONARIO' criada ou já existente.\n";
}

// Função para inserir dados na tabela 'DISCIPLINAS', somente se estiver vazia
function insertDisciplinaData($dbObj) {
    // Verifica se a tabela 'DISCIPLINAS' está vazia
    $checkSql = "SELECT COUNT(*) FROM disciplinas";
    $result = $dbObj->query($checkSql);
    $row = pg_fetch_row($result);
    
    if ($row[0] == 0) { // Se a tabela estiver vazia, insere os dados
        $insertSql = "
        INSERT INTO disciplinas (ID_DISCIPLINA, NOME) VALUES
            (1, 'ESTRUTURA DE DADOS'),
            (2, 'FUNDAMENTOS DE REDES DE COMPUTADORES'),
            (3, 'ESTATISTICA')
        ";
        
        $dbObj->query($insertSql);
        echo "Dados inseridos na tabela 'DISCIPLINAS'.\n";
    } else {
        echo "Tabela 'DISCIPLINAS' já contém dados. Nenhuma inserção necessária.\n";
    }
}

// Função principal para verificar e criar as tabelas, e inserir dados
function setupDatabase($dbObj) {
    // Verificar e criar a tabela 'DISCIPLINAS'
    if (!tableExists($dbObj, 'disciplinas')) {
        createDisciplinaTable($dbObj);
    } else {
        echo "Tabela 'DISCIPLINAS' já existe.\n";
    }
    
    // Verificar e criar a tabela 'DICIONARIO'
    if (!tableExists($dbObj, 'dicionario')) {
        createDicionarioTable($dbObj);
    } else {
        echo "Tabela 'DICIONARIO' já existe.\n";
    }

    // Inserir dados na tabela 'DISCIPLINAS' se necessário
    insertDisciplinaData($dbObj);
}
?>
