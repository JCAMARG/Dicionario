<?php
	class mysql {
		public string $db_host;
		public string $db_user;
		Public string $db_pass;
		public string $db_name;
		
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
	}
?>
