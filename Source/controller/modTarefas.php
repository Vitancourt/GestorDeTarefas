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
    $tarefa->consultaTarefa($tarefa->getId());
    $descTarefa = "
    <input type=\"hidden\" name=\"id\" value=\"".$tarefa->getId()."\">
    Descrição: ".$tarefa->getDescricao()."<br>
    Data: ".$tarefa->getData()."<br>
    Concluído: ".$tarefa->getFeito()."<br>
    ";
    $erro = "";
    require("../view/formConcluir.php");
  }else if(isset($_POST['buttonVer'])){
  	$title = "Sistema gestor de tarefas - Ver tarefa";
  	require("../view/head.php");
    require("../view/menu.php");
    $tarefa->setId($idTarefa);
    $tarefa->consultaTarefa($tarefa->getId());
    $descTarefa = "
    Descrição: ".$tarefa->getDescricao()."<br>
    Data: ".$tarefa->getData()."<br>
    Concluído: ".$tarefa->getFeito()."<br>
    ";
    $erro = "";
    require("../view/tarefasVer.php");
  }else if(isset($_POST['buttonEditar'])){
  	$title = "Sistema gestor de tarefas - Editar tarefa";
  	require("../view/head.php");
  	require("../view/menu.php");
    $tarefa->setId($idTarefa);
    $tarefa->consultaTarefa($tarefa->getId());
    $erro = "";
    $form = "
      <div class=\"form-group\">
        <input type=\"hidden\" name=\"id\" value=\"".$tarefa->getId()."\">
      </div>
      <div class=\"form-group\">
        <label for=\"desc\">Descrição: max. 200 caracteres</label>
        <textarea name=\"desc\" class=\"form-control\" rows=\"5\" maxlength=\"200\" id=\"desc\">".$tarefa->getDescricao()."</textarea>
      </div>
      <div class=\"form-group \">
        <label class=\"control-label requiredField\" for=\"data\">
         Data da tarefa: ex:(15/04/1993) formatação automática
        </label>
        <input onkeypress=\"mascara(this, mdata);\" maxlength=\"10\" class=\"form-control\" id=\"data\" name=\"data\" placeholder=\"DD/MM/AAAA\" type=\"text\" value=\"".$tarefa->getData()."\"/>
      </div>
      <div class=\"form-group\">
      </div>
    ";
    require("../view/formEdTarefa.php");
  }else if(isset($_POST['buttonExcluir'])){
  	$title = "Sistema gestor de tarefas - Excluir tarefa";
  	require("../view/head.php");
    require("../view/menu.php");
    $tarefa->setId($idTarefa);
    $tarefa->consultaTarefa($tarefa->getId());
    $erro = "";
    $descTarefa = "
    <input type=\"hidden\" name=\"id\" value=\"".$tarefa->getId()."\">
    Descrição: ".$tarefa->getDescricao()."<br>
    Data: ".$tarefa->getData()."<br>
    Concluído: ".$tarefa->getFeito()."<br>
    ";
    $botao = "
    <input name=\"buttonExcluir\" type=\"submit\" value=\"Confirmar exclusão\" class=\"btn btn-lg btn-success btn-block\">
    ";
    require("../view/formDelTarefa.php");
  }else{
    header("Location: ../view/homepage.php");
  }



?>
