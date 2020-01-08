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
    <h1>LOGIN</h1>
    <!-- <form method="POST" actions="processa.php"> -->
    <form method="POST">
    <label for="seu email">Email:</label>
    <input type="email" class="form-control" name="emailLogin" aria-describedby="emailHelp">
    <label for="Senha">Senha</label>
    <input type="password" class="form-control" name="senhaLogin">
    <button type="submit" class="btn btn-primary">ACESSAR</button>
    <a href="cadastrar.php"> Ainda não é inscrito?<strong>Cadastre-se</strong></a>
  </div>
</form>
<?php
//isset = verifica a existencia de variavel, array
if (isset($_POST['emailLogin']))
{
    //addslashes para evitar sql injection
    $emailLogin = addslashes($_POST['emailLogin']);
    $senhaLogin = addslashes($_POST['senhaLogin']);

    //verificar se esta preenchido (Validação form)
    if(!empty($emailLogin) && !empty($senhaLogin))
    {

      $u->conectar("sistemajbs", "localhost", "root", "");
      if($u->msgErro == "")//se não teve erro, OK
      {

        if ($u->logar($emailLogin, $senhaLogin))
        {
          header("location: areaprivada.php");
        }
        else
        { 
          ?>
          <div class="msg-erro">
          Email e/ou senha estão incorretos!
          </div>
          <?php
        }
      }
      else
      {
        ?>
        <div class="msg-erro">
        <?php echo "Erro: ".$u->msgErro; ?>
        </div>
        <?php
      }
    }
    else
    {
      ?>
      <div class="msg-erro">
      Preencha todos os campos!
      </div>
      <?php
    }
  }
?>
</body>
</html>