<?php 

require_once("config.php");

$Usuario = new Usuario();

$Usuario->loadbyId(2);

echo $Usuario;

?>