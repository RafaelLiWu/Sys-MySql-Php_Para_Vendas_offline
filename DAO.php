<?php

class DateBase
{
    public function _CriarDao($conect, $comando, array $binds)
    {
        $existe = $conect->prepare("SELECT Nome FROM produtos WHERE Nome = :nome");
        $existe->bindValue("nome", "{$binds['nome']}");
        $existe->execute();
        $dados = $existe->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            $jaExiste = "UPDATE produtos SET Quantidade = (Quantidade + {$binds['quantidade']}) WHERE Nome = '{$dados['Nome']}'";
            $query = $conect->prepare($jaExiste);
            $query->execute();
            echo("<meta http-equiv='refresh' content='1'>");
        } else {
            $criar = $conect->prepare($comando);
            foreach ($binds as $chaves => $valores) {
                $criar->bindValue($chaves, $valores);
            }
            $criar->execute();
            if ($criar->rowCount() > 0) {
                echo("<meta http-equiv='refresh' content='1'>");
                return true;
            }
            return false;
        };
    }

    public function _SelectDao($conect, $comando, array $binds)
    {
        $mostrar = $conect->prepare($comando);
        foreach ($binds as $key => $value) {
            $mostrar->bindValue($key, $value);
        }
        $mostrar->execute();
        return $mostrar;
    }

    public function _InserirDados($conect , $produto, $quantidade, $valor , $date)
    {
        $total = $quantidade * $valor;
        $comando = "INSERT INTO dia{$date} (Nome, Quantidade, Valor) VALUES (:produto, :quantidade, :valor)";
        $mandar = $conect->prepare($comando);
        $mandar->bindValue("produto", $produto);
        $mandar->bindValue("quantidade", $quantidade);
        $mandar->bindValue("valor", $total);
        $mandar->execute();


        $this->_EncontrarEstoque($conect, $produto, $quantidade);
        
    }

    public function _EncontrarEstoque($conect, $produto, $quantidade){

        $comando = "SELECT product_id FROM produtos WHERE Nome = :nome";
        $arr = array(
            "nome" => $produto
        );
        $result = $this->_SelectDao($conect, $comando, $arr);
        $dados = $result->fetch();
        $this->_DescontarEstoque($conect, $dados['product_id'], $quantidade);
    }

    public function _DescontarEstoque($conect, $produto_id, $quantidade){
        $comando = "UPDATE produtos SET Quantidade = (Quantidade - :quantidade) WHERE product_id = :product_id";
        $bind = array(
            "product_id" => $produto_id,
            "quantidade" => $quantidade
        );
        $quest = $conect->prepare($comando);
        foreach($bind as $chaves => $valores) {
            $quest->bindValue($chaves, $valores);
        }
        $quest->execute();
    }
}
