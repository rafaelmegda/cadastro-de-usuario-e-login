<?php

class Usuario 
{
     //usando PDO
    private $pdo;
    public $msgErro = "";   
    
    public function conectar($nome, $host, $usuario, $senha) 
    {
        global $pdo;
        global $msgErro;
        try 
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) 
        {
            $msgErro = $e->getMessage();
        }
        
    }

    public function cadastrar($nome, $telefone, $email, $senha)
    {
        global $pdo;
        //verificar se já esta cadastrado
        $sql = $pdo->prepare("SELECT id FROM usuarios
            WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();

            //veficar se já esta cadastrado, contando as linhas
            if($sql->rowCount() > 0)
            {
                return false; //já esta cadastrado
            }
            else
            {
                //caso não, cadastrar   
                $sql = $pdo->prepare("INSERT INTO usuarios (nome,
                telefone, email, senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();
                return true;
            }
    }

    public function logar($email, $senha)
    {
        global $pdo;
        //verificar se o email e senha estão cadastrados, se sim
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE
            email = :e AND senha = :s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                //Entrar no sistema (Sessão)
                $dado = $sql->fetch(); //fetch pega o que vem  do bd e transformar em vetor
                session_start();
                $_SESSION['id'] = $dado['id'];
                return true; //logado com sucesso
            }
            else
            {
                return false; //não conseguiu logar

            }
    }
}


?>