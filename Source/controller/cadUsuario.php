<?php
#Verificação do botao
if(isset($_POST['buttonCadastrar'])){
    require("../model/Usuario.php");
    $usuario = $_POST['usuario'];
    $senha = $_POST['password'];
    $user = new Usuario();
    $user->setUsuario($usuario);
    $user->setSenha($senha);
    #teste de usuário (Se já existe)
    $teste = $user->verificaVazios($user->getUsuario(), $user->getSenha());
    #se Falso emite erro e exite tela de cadastro
    if(!$teste){
      $css = "../view/";
      $title = "Sistema gestor de tarefas - Login";
      require("../view/head.php");
      $index = "../view/";
      require("../view/menuoff.php");
      $erro = "<h5 style=\"color: red;\">*Os campos são obrigatórios.*</h5>";
      require("../view/formCadUsuario.php");
    #se verdadeiro consulta se já existe usuário no DB, se não insere.
    }else{
      $verifica = $user->verificaUsuario($user->getUsuario());
      if(!$verifica){
        #cadastra e efetua login
        $insere = $user->cadastrar($user->getUsuario(), $user->getSenha());
        #efetua login com o cadastro feito
        if($insere){
          $login = $user->logar($user->getUsuario(), $user->getSenha());
          if($login){
            $user->iniciaSession($user->getUsuario());
            if($user){
              header("Location: ../view/homepage.php");
            }else{
              header("Location: ../view/index.php");
            }
          }
        }
      }else{
        #emite erro e exibe tela de cadastro
        $css = "../view/";
        $title = "Sistema gestor de tarefas - Cadastro";
        require("../view/head.php");
        $index = "../view/";
        require("../view/menuoff.php");
        $erro = "<h5 style=\"color: red;\">*Este nome de usuário já existe.*</h5>";
        require("../view/formCadUsuario.php");
      }
    }
}
?>
