<?php
	class mysql {
		public string $db_host;
		public string $db_user;
		Public string $db_pass;
		public string $db_name;
		public $link_id;
		
		function __construct() {
			$this->db_host = constant("_DB_HOST");
			$this->db_user = constant("_DB_USER");
			$this->db_pass = constant("_DB_PASS");
			$this->db_name = constant("_DB_NAME");
			/*
			$this->link_id =
			mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
			
			if (!$this->link_id) {
				die("!\$this->link_id");
			}
			*/
			
			// Conectando ao banco de dados PostgreSQL
		        $conn_string = "host={$this->db_host} dbname={$this->db_name} user={$this->db_user} password={$this->db_pass}";
		        $this->link_id = pg_connect($conn_string);
		
		        if (!$this->link_id) {
		            die("Erro ao conectar ao banco de dados: " . pg_last_error());
		        }
		}

		// Método para executar consultas SQL
		function query($query) {
			/*
			$result = mysqli_query($this->link_id, $query);
			if (!$result) {
				die("!\$result");
			}
			$this->result = $result;
			return $this->result;
			*/
			$result = pg_query($this->link_id, $query);
		        if (!$result) {
		            die("Erro na consulta: " . pg_last_error());
		        }
		        return $result;
		}

		// Método para contar as linhas afetadas
		function affectedRows() {
			//return mysqli_affected_rows ($this->link_id);
			return pg_affected_rows($this->link_id);
		}

		// Método para fechar a conexão com o banco de dados
		function close() {
			pg_close($this->link_id);
	    	}

		// Função para verificar se uma tabela existe
		function tableExists($tableName) {
			$query = "SELECT to_regclass('public.$tableName')";
			$result = $this->query($query);
			$row = pg_fetch_row($result);
			
			return $row[0] ? true : false;
		}
		
		// Função para criar a tabela 'DISCIPLINAS'
		function createDisciplinaTable() {
			$createTableSql = "
				CREATE TABLE IF NOT EXISTS disciplinas (
				    ID_DISCIPLINA SERIAL PRIMARY KEY,
				    NOME VARCHAR(255) NOT NULL
				)";
			
			$this->query($createTableSql);
		}
		
		// Função para criar a tabela 'DICIONARIO'
		function createDicionarioTable() {
			$createTableSql = "
				CREATE TABLE IF NOT EXISTS dicionario (
				    ID SERIAL PRIMARY KEY,
				    PALAVRA_ORIG VARCHAR(255) NOT NULL,
				    ID_DISCIPLINA INT NOT NULL,
				    CONSTRAINT FK_DICIONARIO_DISCIPLINA FOREIGN KEY (ID_DISCIPLINA)
					REFERENCES disciplinas (ID_DISCIPLINA) ON DELETE CASCADE ON UPDATE CASCADE
				)";
			
			$this->query($createTableSql);
		}
		
		// Função para inserir dados na tabela 'DISCIPLINAS', somente se estiver vazia
		function insertDisciplinaData() {
			// Verifica se a tabela 'DISCIPLINAS' está vazia
			$checkSql = "SELECT COUNT(*) FROM disciplinas";
			$result = $this->query($checkSql);
			$row = pg_fetch_row($result);
			
			if ($row[0] == 0) { // Se a tabela estiver vazia, insere os dados
				$insertSql = "
					INSERT INTO disciplinas (ID_DISCIPLINA, NOME) VALUES
					(1, 'ESTRUTURA DE DADOS'),
					(2, 'FUNDAMENTOS DE REDES DE COMPUTADORES'),
					(3, 'ESTATISTICA')
					";
				
				$this->query($insertSql);
			}
		}
		
		// Função principal para configurar o banco de dados (criar tabelas e inserir dados)
		function setupDatabase() {
			// Criar as tabelas, se necessário
			if (!$this->tableExists('disciplinas')) {
				$this->createDisciplinaTable();
			}
			
			if (!$this->tableExists('dicionario')) {
				$this->createDicionarioTable();
			}
			
			// Inserir dados na tabela 'DISCIPLINAS' se necessário
			$this->insertDisciplinaData();
		}
	}
?>
