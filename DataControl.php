<?php

require_once 'DAO.php';

class Controler
{
    private $db;
    private $date;


    public function __construct($database)
    {
        try {
            $this->db = new PDO("mysql:host=localhost;port=3306;dbname=$database", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->date = date("Y_m_d");
        } catch (PDOException $e) {
            die("Error <br> {$e}");
        }
    }

    public function _Criar(array $binds)
    {
        if (!empty($binds['nome']) && !empty($binds['quantidade']) && !empty($binds['valor'])) {
            try {
                $comando = "INSERT INTO produtos (Nome, Quantidade, Valor) VALUES (:nome, :quantidade, :valor)";
                $valores = array(
                    "nome" => "{$binds['nome']}",
                    "quantidade" => "{$binds['quantidade']}",
                    "valor" => "{$binds['valor']}"
                );
                $dao = new DateBase();
                $dao->_CriarDao($this->db, $comando, $valores);
            } catch (PDOException $e) {
                die("Houve um erro {$e->getMessage()}");
            }
        }
    }

    public function _Select($comando, array $binds)
    {
        
        $dao = new DateBase();
        $result = $dao->_SelectDao($this->db, $comando, $binds);
        return $result;
    }

    public function _criarBancoDeDados() {
        $date = date("Y_m_d");
        try {
            $quest = $this->db->prepare("CREATE TABLE dia{$date} (Nome VARCHAR(40) NOT NULL, Quantidade int NOT NULL, Valor float NOT NULL, product_id int AUTO_INCREMENT NOT NULL PRIMARY KEY)");
            $quest->execute();
        } catch(PDOException $e) {
        }
    }

    public function _vendas(array $produtos, array $quantidade, array $valor)
    {
        try {
            $n = 0;
            $dao = new DateBase();
            foreach($produtos as $product)
            {
                $dao->_InserirDados($this->db, $product, $quantidade[$n], $valor[$n], $this->date);
                $n++;
            }
            
            echo("<meta http-equiv='refresh' content='1'>");
        } catch (PDOException $e) {
            die("Erro ao iniciar o serviço{$e->getMessage()}");
        }
    }
}
