<?php
	session_start();
	$css = "";
	$title = "Sistema gestor de tarefas - Adicionar tarefa";
	require_once("head.php");
	require_once("../model/Usuario.php");
	$user = new Usuario();
	$testeSessao = $user->validaSession();
	if($testeSessao){
		require_once("menu.php");
		$erro = "";
		require_once("formAdTarefa.php");
	}else{
		header("Location: index.php");
	}
?>
