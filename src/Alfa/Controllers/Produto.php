<?php
namespace Alfa\Controllers;
use Alfa\Config\Conn;

class Produto
{
    use Alfa\Traits\Hidratacao;
    public function __construct()
    {
       $conn = new Conn;
       return $conn->getDB();
    }

    private $idproduto;
    private $nome;
    private $valor;

    /**
     * @return int
     */
    public function getIdproduto()
    {
        return $this->idproduto;
    }
    /**
     * @param int $idproduto
     */
    public function setIdproduto($idproduto)
    {
        $this->idproduto = $idproduto;
    }
    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }
    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    /**
     * @return double
     */
    public function getValor()
    {
        return $this->valor;
    }
    /**
     * @param double $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function listar()
    {
        $query = "select * from produto";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $hidratar = new hidrata($retorno);
        return $hidratar;
    }

    public function salvar () 
    {
        try{
            $hidratar = new hidrata($this->produto);
            $query = "insert into produto (nome, valor) values(:nome, :valor)";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(":nome",$this->produto->getNome());
            $stmt->bindValue(":valor",$this->produto->getValor());
            $stmt->execute();
            $retorno = $conn->lastInsertId();
        }catch(\PDOException $e){
            echo "Error! Message:".$e->getMessage()." Code:".$e->getCode();
        }
        return $retorno;
    }

    public function alterar() 
    {   
        try{
            $query = "update produto set `nome`=?, `valor`=? WHERE `idproduto`=?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->produto->getNome());
            $stmt->bindValue(2,$this->produto->getValor());
            $stmt->bindValue(3,$this->produto->getIdproduto());
            $retorno = $stmt->execute();
         }catch(\PDOException $e){
            echo "Error! Message:".$e->getMessage()." Code:".$e->getCode();
        }
        return $retorno;
    }

    public function delete()
    {
        try{
            $query = "delete from produto WHERE `idproduto`=:idproduto";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":idproduto",$this->produto->getIdproduto());
            $retorno = $stmt->execute();
        }catch(\PDOException $e){
            echo "Error! Message:".$e->getMessage()." Code:".$e->getCode();
        }
        return $retorno;
    }
}