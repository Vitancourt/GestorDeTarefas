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
if(isset($_POST['buttonExcluir'])){
  $title = "Sistema gestor de tarefas - Excluir";
  require("../view/head.php");
  require("../view/menu.php");
  $tarefa->setId($idTarefa);
  $del = $tarefa->deletarTarefa($tarefa->getId());
  if($del){
    $erro= "<h3 style=\"color: red;\">Tarefa deletada.</h3>";
    $descTarefa = "";
    $botao = "";
  }else{
    $tarefa->consultaTarefa($tarefa->getId());
    $erro = "<h3 style=\"color: red;\">Não foi possível deletar sua tarefa.</h3>";
    $descTarefa = "
    <input type=\"hidden\" name=\"id\" value\"".$tarefa->getId()."\">
    Descrição: ".$tarefa->getDescricao()."<br>
    Data: ".$tarefa->getData()."<br>
    Concluído: ".$tarefa->getFeito()."<br>
    ";
    $botao = "
    <input name=\"buttonExcluir\" type=\"submit\" value=\"Confirmar exclusão\" class=\"btn btn-lg btn-success btn-block\">
    ";
  }
  require("../view/formDelTarefa.php");
}

?>
