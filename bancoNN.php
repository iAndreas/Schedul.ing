<?php


class bancoNN {

    public $pdo, $tabela;

    public function conexao() {
			try {
				require 'credentials.php';
					$this->pdo = new PDO('mysql:host=localhost;dbname='.$databaseCredentials['name'], $databaseCredentials['username'], $databaseCredentials['password']);
					$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->pdo->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
						echo 'Error: ' . $e->getMessage();
						exit;
        }
    }

    public function obterCampos() {
        
        $consulta = $this->pdo->query("desc " . $this->tabela);
        while ($lista = $consulta->fetch()) {
            $campos [] = $lista[0];
        }
        return $campos;
    }

    public function validarData($campo) {
        $data = DateTime::createfromFormat('d/m/Y', $campo);
        if ($data && $data->format('d/m/Y')) {
            return true;
        } else {
            return false;
        }
    }
    
    public function geraStmt($sql, $vetor, $campos){
        $stmt = $this->pdo->prepare($sql);       
        
            for ($j = 0; $j <= count($vetor)-1; $j++) {
                if (is_numeric($vetor[$j])) {
                    $stmt->bindParam (':' . $campos[$j], $vetor[$j], PDO::PARAM_INT);
                    } elseif ($this->validarData($vetor[$j])) {
                    $stmt->bindParam(':' . $campos[$j], date("Y-m-d", strtotime(str_replace("/", "-", $vetor[$j]))), PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':' . $campos[$j], $vetor[$j], PDO::PARAM_STR);
                }
            }
            return $stmt;
    }

    public function select($sql) {
        $this->conexao();
        try {
            $consulta = $this->pdo->query($sql);
            $vetor = null;
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                $vetor[] = $linha; 
            }
            return $vetor;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function inserirN($vetor) {
        
        $this->conexao();
        try {
            
            $campos = $this->obterCampos();
            echo "AAAAAAAAAAAAAAA";
            $sql = "INSERT INTO " . $this->tabela . "(";
            $i = 0;
            foreach ($campos as $v) {
                if ($i == 0) {
                    $sql .= $v;
                } elseif ($i > 0) {
                    $sql .= ", " . $v;
                }
                $i++;
            }
            $sql .= ") VALUES(";
            $i = 0;
           
            foreach ($campos as $v) {
                if ($i == 0) {
                    $sql .= ":" . $v;
                } elseif ($i > 0) {
                    $sql .= ", :" . $v;
                }
                $i++;
            }
            $sql .= ")";
            
            echo $sql;
            $stmt = $this->geraStmt($sql, $vetor, $campos);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public  function deleteN($id, $id2) {
        $this->conexao();
        try {
            
					$campos = $this->obterCampos();
					
					$stmt = $this->pdo->prepare("DELETE FROM " . $this->tabela . " WHERE {$campos[0]} = :id and {$campos[1]} = :id2");
					echo ("DELETE FROM " . $this->tabela . " WHERE {$campos[0]} = :id and {$campos[1]} = :id2");
					$stmt->bindParam(':id', $id);
					$stmt->bindParam(':id2', $id2);
					$stmt->execute();
					return true;
        } catch (PDOException $e) {
					return 'Error: ' . $e->getMessage();
        }
    }

    function update($vetor, $codigo_lab_antigo) {
        $this->conexao();
        try {
					$sql = "UPDATE {$this->getTabela()} SET cod_laboratorio = :cod_laboratorio";
					$sql .= " WHERE cod_agendamento = :cod_agendamento and cod_laboratorio = :cod_antigo";
					echo $sql;
					$stmt = $this->pdo->prepare($sql);
					$stmt->bindParam (':cod_laboratorio', $vetor[0], PDO::PARAM_INT);
					$stmt->bindParam (':cod_agendamento', $vetor[1], PDO::PARAM_INT);
					$stmt->bindParam (':cod_antigo', $codigo_lab_antigo, PDO::PARAM_INT);
					$stmt->execute();
					// echo "\n";
					// echo $stmt->rowCount();
					// echo "\n";
					// print_r($vetor);
					// exit;
        } catch (PDOException $e) {
					echo 'Error: ' . $e->getMessage();
					// exit;
        }
    }

    function getPdo() {
        return $this->pdo;
    }

    function getTabela() {
        return $this->tabela;
    }

 function setPdo($pdo) {
        $this->pdo = $pdo;
    }

 function setTabela($tabela) {
        $this->tabela = $tabela;
    }


}