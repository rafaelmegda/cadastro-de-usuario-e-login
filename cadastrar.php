<?php
require_once 'classes/usuarios.php';
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JBS Passagem</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

<div class="form-group">
    <h1>Cadastrar Usuário</h1>
    <!-- <form method="POST" actions="processa.php"> -->
    <form method="POST">
    <label for="nomeUsuario">Nome Completo</label>
    <input type="text" class="form-control" name="nomeUsuario" maxlength="50">
    <label for="telefone">Telefone</label>
    <input type="text" class="form-control" name="telefoneUsuario" maxlength="30">
    <label for="seu email">E-mail</label>
    <input type="email" class="form-control" name="emailUsuario" aria-describedby="emailHelp" maxlength="30">
    <label for="Senha">Senha</label>
    <input type="password" class="form-control" name="senhaUsuario" maxlength="15">
    <label for="Senha">Confirmar Senha</label>
    <input type="password" class="form-control" name="confirmarSenha" maxlength="15">
    <button type="submit" class="btn btn-primary">CADASTRAR</button>
    </form>
</div>

<?php

//isset = verifica a existencia de variavel, array
if (isset($_POST['nomeUsuario']))
{
    //addslashes para evitar sql injection
    $nomeUsuario = addslashes($_POST['nomeUsuario']);
    $telefoneUsuario = addslashes($_POST['telefoneUsuario']);
    $emailUsuario = addslashes($_POST['emailUsuario']);
    $senhaUsuario = addslashes($_POST['senhaUsuario']);
    $confirmarSenha = addslashes($_POST['confirmarSenha']);

    //verificar se esta preenchido (Validação form)
    if(!empty($nomeUsuario) && !empty($telefoneUsuario) && !empty($emailUsuario)
        && !empty($senhaUsuario) && !empty($confirmarSenha))
    {
        $u->conectar("sistemajbs", "localhost", "root", "");
        if($u->msgErro == "")//se não teve erro, OK
        {
            //confirmar o verificar senha
            if($senhaUsuario == $confirmarSenha)
            {
                if($u->cadastrar($nomeUsuario, $telefoneUsuario, $emailUsuario, $senhaUsuario))
                {
                    echo "Cadastrado com sucesso! Acesse para entrar!";
                }
                else
                {
                    echo "Email já cadastrado!";
                }
            }
            else
            {
                echo "Senha e confirmar senha não correspondem";
            }             
        }
        else
        {
            echo "Erro: ".$u->msgErro;
        }
    }
    else
    {
        echo "Preencha todos os campos!";
    }
}


?>

</body>
</html>