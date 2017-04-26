<?php
$css = "../view/";
require_once("../model/Usuario.php");
require_once("../model/Tarefa.php");
if(!session_id()){
  session_start();
}
$user = new Usuario();
$testeSessao = $user->validaSession();
if(!$testeSessao){
  header("Location: ../view/index.php");
}
#define o id no objeto instanciado
$id = $_SESSION['id'];
$user->setId($id);
$idTarefa = $_POST['id'];
$tarefa = new Tarefa();
#testa botões
if(isset($_POST['buttonConcluir'])){
  $title = "Sistema gestor de tarefas - Concluir tarefa";
  require("../view/head.php");
  require("../view/menu.php");
  $tarefa->setId($idTarefa);
  $tarefa->concluirTarefa($tarefa->getId());
  $tarefa->consultaTarefa($tarefa->getId());
  $descTarefa = "
  <input type=\"hidden\" name=\"id\" value\"".$tarefa->getId()."\">
  Descrição: ".$tarefa->getDescricao()."<br>
  Data: ".$tarefa->getData()."<br>
  Concluído: ".$tarefa->getFeito()."<br>
  ";
  $erro = "<h5 style=\"color: red;\">*Tarefa alterada para concluído*</h5>";
  require("../view/formConcluir.php");
}

?>
