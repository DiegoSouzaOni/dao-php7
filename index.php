<?php 

require_once("config.php");

//Busca Usuario pelo ID
//$Usuario = new Usuario();
//$Usuario->loadById(2);
//echo $Usuario;


//Busca Usuario(s) e retorna uma lista ordenada
//$Usuarios = Usuario::getList();
//echo json_encode($Usuarios);

//Busca Usuario(s) pela string que foi passada
//$Usuarios = Usuario::search("te");
//echo json_encode($Usuarios);

//Identifica se o usuario existe atraves do login e da senha
$Usuario = new Usuario();
$Usuario->login("teste","123123");

echo $Usuario;

?>