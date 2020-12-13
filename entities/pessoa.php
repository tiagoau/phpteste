<?php
    class Pessoa{

        // Connection
        private $conn;

        // Table
        private $db_table = "Pessoa";

        // Columns
        public $id;
        public $cpf;
        public $nome;
        public $sexo;
        public $criado_em;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // recupera todos as registros da tabela Pessoa
        public function getPessoas(){
            $sqlQuery = "SELECT id, cpf, nome, sexo, criado_em FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // cria um registro na tabela Pessoa
        public function createPessoa(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        cpf = :cpf, 
                        nome = :nome, 
                        sexo = :sexo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            //formata os valores recebidos
            $this->cpf=htmlspecialchars(strip_tags($this->cpf));
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->sexo=htmlspecialchars(strip_tags($this->sexo));

        
            // realiza o bind dos dados recebidos na query
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":sexo", $this->sexo);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
    }
?>