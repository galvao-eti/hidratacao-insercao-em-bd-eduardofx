<?php
namespace Alfa\Controllers;
use Alfa\Config\Conn;

class Usuario
{
    use Alfa\Traits\Hidratacao;

    public function __construct()
    {
       $conn = new Conn;
       return $conn->getDB();
    }
    
    private $id;
    private $email;
    private $senha;

    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return int
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }
    /**
     * @param string $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }


    public function listar()
    {
        $query = "select * from usuario";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $hidratar = new hidrata($retorno);
        return $hidratar;
    }

    public function salvar () 
    {
        try{
            $hidratar = new hidrata($this->usuario);
            $query = "insert into usuario (email, senha) values(:email, :senha)";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(":email",$this->usuario->getEmail());
            $stmt->bindValue(":senha",$this->usuario->getSenha());
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
            $query = "update usuario set `email`=?, `senha`=? WHERE `id`=?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->usuario->getEmail());
            $stmt->bindValue(2,$this->usuario->getSenha());
            $stmt->bindValue(3,$this->usuario->getId());
            $retorno = $stmt->execute();
         }catch(\PDOException $e){
            echo "Error! Message:".$e->getMessage()." Code:".$e->getCode();
        }
        return $retorno;
    }

    public function delete()
    {
        try{
            $query = "delete from usuario WHERE `id`=:id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id",$this->usuario->getId());
            $retorno = $stmt->execute();
        }catch(\PDOException $e){
            echo "Error! Message:".$e->getMessage()." Code:".$e->getCode();
        }
        return $retorno;
    }

}