<?php
	session_start();
	$css = "";
	$title = "Sistema gestor de tarefas - Página inicial";
	require("head.php");
	require_once("../model/Usuario.php");
	$user = new Usuario();

	$testeSessao = $user->validaSession();
	if($testeSessao){
		require("menu.php");
		require("home.php");
	}else{
		header("Location: index.php");
	}
?>
