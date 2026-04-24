<?php

class Usuario{
    private $id;
    private $email;
    private $nome;
    private $senha;
    private $pdo;

    public function conecta(){
        $dns      = "mysql:dbname=etimUsuario;host=localhost"; 
        $userName = "root";
        $userPass = "";

        try {
            $this->pdo = new PDO($dns, $userName, $userPass);
            return true;
        } catch (\Throwable $th) {    
            return false;
        }
    }

    public function inserirUsuario($nome, $email, $senha){
        // passo 1 - Criar uma variavel com a consulta SQL
        $sql = "INSERT INTO usuario SET nome = :n, email = :e, senha = :s";

        // passo 2 - Passar essa consulta para o metodo prepare do pdo:
        $stmt = $this->pdo->prepare($sql);

        // passo 3 - Para cada apelido, criar o bindValue:
        $stmt->bindValue(":e", $email);
        $stmt->bindValue(":n", $nome);
        $stmt->bindValue(":s", $senha);

        // passo 4 - Executar o comando e retornar Verdadeiro ou Falso

        return $stmt->execute();
    }

    public function checkUser($email){
        $sql  = "SELECT *FROM usuario WHERE email = :e";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":e" , $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
   
    }

    public function checkPass($email, $senha){
        $sql  = "SELECT *FROM usuario WHERE email = :e AND senha = :s";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":e" , $email);
        $stmt->bindValue(":s" , md5( $senha ));
        $stmt->execute();
        return $stmt->rowCount() > 0;
     
    }

    public function listarUsuarios(){
        $sql  = "SELECT *FROM usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt ->excute();

        if($stmt->rowCount() > 0 ){
            return $stmt->fetchAll();
        }else{
            return Array();
        }

    }

    public function apagarUsuario($id){
        $sql = "DELETE FROM usuario WHERE id = :i";
        $stmt = $this->pdo->prepare( $sql );
        $stmt ->bindValue( ":i", $id );
        return $stmt ->execute();
    }

    public function alterarUsuario( $id, $nome, $email, $senha ){
    $sql = "UPDATE usuario SET nome = :n, email = :e, senha = :s WHERE id = :i";
    $stmt = $this-pdo->prepare( $sql ):
    $stmt ->bindValue( ":n", $nome)
    $stmt ->bindValue( ":s", $senha)
    $stmt ->bindValue( ":e", $email)
    $stmt ->bindValue( ":i", $id)
    $stmt ->execute();
    return $stmt->fetch();
    }
}