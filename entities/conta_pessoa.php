<?php
    class Conta_Pessoa{

        // Connection
        private $conn;

        // Table
        private $db_table = "Conta_Pessoa";

        // Columns
        public $id_pessoa_fk;
        public $operacao;
        public $transferencia;
        public $valor;
        public $saldo;


        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }


        public function insertValor(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_pessoa_fk  = :id_pessoa_fk, 
                        operacao      = :operacao, 
                        transferencia = :transferencia, 
                        valor         = :valor, 
                        saldo         = :saldo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_pessoa_fk=htmlspecialchars(strip_tags($this->id_pessoa_fk));
            $this->operacao=htmlspecialchars(strip_tags($this->operacao));
            $this->transferencia=htmlspecialchars(strip_tags($this->transferencia));
            $this->valor=htmlspecialchars(strip_tags($this->valor));

            $saldo = $this.atualizaSaldo();

            // bind data
            $stmt->bindParam(":id_pessoa_fk", $this->id_pessoa_fk);
            $stmt->bindParam(":operacao", $this->operacao);
            $stmt->bindParam(":transferencia", $this->transferencia);
            $stmt->bindParam(":valor", $this->valor);
            $stmt->bindParam(":saldo", $this->saldo);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        public function atualizaSaldo(){

            getSaldo();

            if ($operacao === "C") 
            {
                $saldo = $saldo + $valor;
            }elseif ($operacao === "D")
            {
                $saldo = $saldo - $valor;

                if ($saldo < 0 ) {
                    return false;
                }

            }
            
            return $saldo;
            
        }


        // READ single
        public function getSaldo(){
            $sqlQuery = "SELECT
                        id,  
                        saldo,
                        id_pessoa_fk
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_pessoa_fk = :id_pessoa_fk
                    LIMIT 1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":id_pessoa_fk", $this->id_pessoa_fk);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->saldo = $dataRow['saldo'];
        }        


    }
?>