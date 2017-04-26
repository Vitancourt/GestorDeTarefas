<?php
if(!session_id()){
  session_start();
}
#Verificação do botao
if(isset($_POST['buttonAdicionar'])){
    $css = "../view/";
    $title = "Sistema gestor de tarefas - Adicionar tarefa";
    require_once("../view/head.php");
    require_once("../view/menu.php");
    require_once("../model/Tarefa.php");
    $desc = $_POST['desc'];
    $data = $_POST['data'];
    $feito = 0;
    $tarefa = new Tarefa();
    $tarefa->setDescricao($desc);
    $tarefa->setData($data);
    $tarefa->setFeito($feito);
    #verifica vazios, se não estiver, valida data
    $teste = $tarefa->verificaVazios($tarefa->getDescricao(), $tarefa->getData());
    if($teste){
      #Verifica data e configura para inserção
      $testeData = $tarefa->verificaData($tarefa->getData());
      if($testeData){
        $cadastra = $tarefa->cadastrarTarefa($tarefa->getDescricao(), $tarefa->getData(), $tarefa->getFeito(), $_SESSION['id']);
        $erro = "<h5 style=\"color:red;\">*Tarefa adicionada!*</h5>";
        require_once("../view/formAdTarefa.php");
      }else{
        $erro = "<h5 style=\"color:red;\">*Data inválida*</h5>";
        require_once("../view/formAdTarefa.php");
      }
    }else{
      $erro = "<h5 style=\"color:red;\">*Os dois campos são obrigatórios*</h5>";
      require_once("../view/formAdTarefa.php");
    }
}else{
  header("Location: ../view/index.php");
}
?>
