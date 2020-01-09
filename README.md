# Cadastro de usuário e Login com PHP

Trabalho realizado com PHP, HTML e CSS junto com Banco de dados MySQL para cadastrar um novo usuário e login ao usuário cadastrado criando uma nova sessão.

# Veja como funciona o sistema

![](GIFLoginPHP.gif)

# Código SQL para criar o projeto

    create DATABASE login;
    use login;

    create TABLE usuario (
	  id int AUTO_INCREMENT PRIMARY key,
    nome varchar(30),
    telefone varchar(30),
    email varchar (40),
    senha varchar (32)   
    );

