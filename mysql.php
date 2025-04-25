<?php
	class mysql {
		public string $db_host;
		public string $db_user;
		Public string $db_pass;
		public string $db_name;
		public $link_id;
		public $last_result;
		public $result;
		
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
		        $this->result = $result;
			return $this->result;
		}

		// Método para contar as linhas afetadas
		function affectedRows() {
			//return mysqli_affected_rows ($this->link_id);
			return pg_affected_rows($this->result);
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

		// Função para dropar uma tabela
		function dropTable($tableName) {
			$query = "DROP TABLE IF EXISTS {$tableName};";
			$this->query($query);
		}
		
		// Função para criar a tabela 'DISCIPLINAS'
		function createDisciplinaTable() {
			if (!$this->tableExists('disciplinas')) {
				$createTableSql = "
					CREATE TABLE disciplinas (
					    ID_DISCIPLINA SERIAL PRIMARY KEY,
					    NOME VARCHAR(255) NOT NULL
					)";
				
				$this->query($createTableSql);
			}
		}
		
		// Função para criar a tabela 'DICIONARIO'
		function createDicionarioTable() {
			if (!$this->tableExists('dicionario')) {
				$createTableSql = "
					CREATE TABLE dicionario (
					    ID SERIAL PRIMARY KEY,
					    PALAVRA_ORIG VARCHAR(255) NOT NULL,
					    SIGNIFICADO VARCHAR(255) NOT NULL,
					    ID_DISCIPLINA INT NOT NULL,
					    CONSTRAINT FK_DICIONARIO_DISCIPLINA FOREIGN KEY (ID_DISCIPLINA)
						REFERENCES disciplinas (ID_DISCIPLINA) ON DELETE CASCADE ON UPDATE CASCADE
					)";
				
				$this->query($createTableSql);
			}
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

		// Função para inserir dados na tabela 'DICIONARIO'
		function insertDicionarioData() {
			// Verificar se os dados já existem
		        $checkSql = "SELECT COUNT(*) FROM dicionario";
		        $result = $this->query($checkSql);
		        $row = pg_fetch_row($result);

			if ($row[0] == 0) {
				$insertSql = "
					INSERT INTO dicionario (PALAVRA_ORIG, SIGNIFICADO, ID_DISCIPLINA) VALUES
						('ACID', 'Propriedades que garantem a execução segura de transações (Atomicidade, Consistência, Isolamento, Durabilidade).', 1),
						('Algoritmo', 'Conjunto de instruções para resolver um problema de forma eficiente.', 1),
						('Amostra', 'Subconjunto de uma população utilizado para análise estatística.', 3),
						('Análise de Variância', 'Método estatístico para comparar as médias de três ou mais grupos.', 3),
						('Árvore', 'Estrutura hierárquica de dados que facilita a busca e organização.', 1),
						('Árvore Balanceada', 'Árvore que mantém a profundidade equilibrada para garantir eficiência.', 1),
						('Árvore Binária', 'Tipo de árvore onde cada nó possui no máximo dois filhos.', 1),
						('Backup', 'Cópia de segurança de dados para evitar perdas em caso de falhas.', 1),
						('Banco de Dados', 'Sistema que armazena, organiza e facilita a recuperação de dados.', 1),
						('Cardinalidade', 'Refere-se ao número de instâncias de uma entidade em uma relação.', 1),
						('Chave Composta', 'Chave formada por duas ou mais colunas que juntas identificam de forma única uma linha.', 1),
						('Chave Estrangeira', 'Campo em uma tabela que se refere à chave primária de outra tabela.', 1),
						('Chave Primária', 'Coluna que identifica de forma única cada registro em uma tabela.', 1),
						('Conexão de Rede', 'Estabelecimento de comunicação entre dispositivos em uma rede de computadores.', 2),
						('Conjunto de Dados', 'Coleção de dados organizados para análise ou processamento.', 1),
						('Consistência', 'Propriedade ACID que garante que os dados do banco de dados sejam válidos após cada transação.', 1),
						('Correlação', 'Relação entre duas variáveis, onde mudanças em uma afetam a outra.', 3),
						('Correlação de Pearson', 'Medida da força e direção da relação linear entre duas variáveis.', 3),
						('Curva de Gauss', 'Representação gráfica da distribuição normal, simétrica em torno da média.', 3),
						('Datagrama', 'Unidade básica de dados enviada em uma rede sem garantias de entrega.', 2),
						('Denormalização', 'Processo de aumentar a redundância dos dados para otimizar consultas.', 1),
						('Desvio Padrão', 'Medida que indica a dispersão de um conjunto de dados em torno da média.', 3),
						('Distribuição Normal', 'Tipo de distribuição de probabilidade que é simétrica em torno da média.', 3),
						('DNS', 'Sistema de nomes de domínio que traduz nomes de sites em endereços IP.', 2),
						('Erro Padrão', 'Medida da precisão de uma estimativa estatística.', 3),
						('Estatística Descritiva', 'Técnica usada para descrever as características básicas de um conjunto de dados.', 3),
						('Fluxo de Dados', 'Caminho percorrido pelos dados dentro de um sistema de comunicação.', 2),
						('Intervalo de Classe', 'Faixa de valores usada para organizar os dados em tabelas de frequência.', 3),
						('Intervalo de Confiança', 'Faixa de valores dentro da qual se espera que um parâmetro populacional se encontre.', 3),
						('IP', 'Endereço único atribuído a cada dispositivo conectado a uma rede.', 2),
						('LIFO', 'Last In, First Out: estrutura de dados onde o último elemento inserido é o primeiro a ser removido.', 1),
						('Média', 'Valor central de um conjunto de dados.', 3),
						('Média Ponderada', 'Média calculada levando em conta o peso ou importância dos valores.', 3),
						('Moda', 'Valor mais frequente em um conjunto de dados.', 3),
						('Multicast', 'Método de envio de dados de um único remetente para múltiplos destinatários.', 2),
						('Percentil', 'Valor abaixo do qual uma certa porcentagem dos dados se encontra.', 3),
						('Previsão', 'Estimativa de futuros valores com base em dados históricos.', 3),
						('Probabilidade', 'Medida numérica de quão provável é um evento ocorrer.', 3),
						('P-Valor', 'Medida utilizada para determinar a significância estatística de um teste.', 3),
						('Qui-Quadrado', 'Teste de hipótese usado para avaliar a associação entre variáveis categóricas.', 3),
						('Regra de Bayes', 'Teorema usado para calcular a probabilidade de um evento com base em evidências anteriores.', 3),
						('Regressão Linear', 'Modelo estatístico para prever uma variável com base em outra.', 3),
						('Relacionamento', 'Conexão entre tabelas por meio de chaves estrangeiras.', 1),
						('SQL', 'Linguagem de consulta estruturada usada para interagir com bancos de dados.', 1),
						('Streaming', 'Transmissão contínua de dados em tempo real.', 2),
						('Subconsulta', 'Consulta aninhada dentro de outra consulta.', 1),
						('Subrede', 'Parte de uma rede maior que é segmentada para aumentar a eficiência e segurança.', 2),
						('Switch', 'Dispositivo de rede usado para conectar dispositivos em uma rede local (LAN).', 2),
						('TCP', 'Protocolo de comunicação confiável e orientado a conexão.', 2),
						('Teste de Hipótese', 'Procedimento estatístico para verificar a validade de uma suposição.', 3),
						('Teste de Qui-Quadrado', 'Teste estatístico usado para avaliar se há uma associação entre duas variáveis categóricas.', 3),
						('Teste Z', 'Teste estatístico usado para comparar médias quando a variância é conhecida.', 3),
						('Tolerância a Falhas', 'Capacidade de um sistema de continuar funcionando mesmo após falhas.', 2),
						('T-Test', 'Teste estatístico para comparar médias de dois grupos.', 3),
						('UDP', 'Protocolo sem conexão e sem garantia de entrega dos pacotes de dados.', 2),
						('Variação', 'Medida da mudança em um conjunto de dados ao longo do tempo.', 3),
						('Variância', 'Medida de dispersão de um conjunto de dados em relação à média.', 3),
						('Variável Aleatória', 'Valor numérico que pode assumir diferentes resultados baseados em probabilidade.', 3),
						('VLAN', 'Rede local virtual, segmentação de rede lógica dentro de uma rede física.', 2),
						('WAN', 'Rede de longa distância que conecta várias LANs em locais diferentes.', 2)
	     				";
				
				$this->query($insertSql);
			}
		}
	}
?>
