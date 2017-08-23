<?php

require_once("config.php");

//Carrega um usuário
// $user = new Usuario();
// $user->loadById(4);
// echo $user;

//Carrega uma lista de usuários
// $lista = Usuario::getList();
// echo json_encode($lista);

//Carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("daniel");
//echo json_encode($search);

//Carrega um usuário usando o login e a senha
$usuario = new Usuario();
$usuario->login("Daniela","321");

echo $usuario;

?>