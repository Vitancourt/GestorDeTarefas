<?php
if(!session_id()){
  session_start();
}
#Verificação do botao
if(isset($_POST['buttonEditar'])){
    $css = "../view/";
    $title = "Sistema gestor de tarefas - Editar tarefa";
    require_once("../view/head.php");
    require_once("../view/menu.php");
    require_once("../model/Tarefa.php");
    $idTarefa = $_POST['id'];
    $desc = $_POST['desc'];
    $data = $_POST['data'];
    $feito = 0;
    $tarefa = new Tarefa();
    $tarefa->setId($idTarefa);
    $tarefa->setDescricao($desc);
    $tarefa->setData($data);
    $tarefa->setFeito($feito);
    #verifica vazios, se não estiver, valida data
    $teste = $tarefa->verificaVazios($tarefa->getDescricao(), $tarefa->getData());
    if($teste){
      #Verifica data e configura para inserção
      $testeData = $tarefa->verificaData($tarefa->getData());
      if($testeData){
        $cadastra = $tarefa->editarTarefa($tarefa->getId(), $tarefa->getDescricao(), $tarefa->getData());
        if($cadastra){
          $tarefa->consultaTarefa($tarefa->getId());
          $erro = "<h5 style=\"color:red;\">*Tarefa editada!*</h5>";
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
              <input onkeypress=\"mascara(this, mdata);\" maxlength=\"10\" class=\"form-control\" id=\"data\"
               name=\"data\" placeholder=\"DD/MM/AAAA\" type=\"text\" value=\"".$tarefa->getData()."\"/>
            </div>
            <div class=\"form-group\">
            </div>
          ";
          require_once("../view/formEdTarefa.php");
        }
      }else{
          $tarefa->consultaTarefa($tarefa->getId());
          $erro = "<h5 style=\"color:red;\">*Data inválida*</h5>";
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
          require_once("../view/formEdTarefa.php");
      }
    }else{
        $erro = "<h5 style=\"color:red;\">*Os dois campos são obrigatórios*</h5>";
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
        require_once("../view/formEdTarefa.php");
      }

}else{
  header("Location: ../view/index.php");
}

?>
