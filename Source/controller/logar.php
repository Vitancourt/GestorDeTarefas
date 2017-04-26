<?php
#Verificação do botao
if(isset($_POST['buttonlogar'])){
    require("../model/Usuario.php");
    $usuario = $_POST['usuario'];
    $senha = $_POST['password'];
    $user = new Usuario();
    $user->setUsuario($usuario);
    $user->setSenha($senha);
    #inicia os teste no banco e login.
    $login = $user->logar($user->getUsuario(), $user->getSenha());
    if($login){
        $user->iniciaSession($user->getUsuario());
        if($user){
            header("Location: ../view/homepage.php");
        }
    }else{
        $css = "../view/";
        $title = "Sistema gestor de tarefas";
        require("../view/head.php");
        $index = "../view/";
        require("../view/menuoff.php");
        $erro = "<h5 style=\"color: red; font-weight: bold;\">*A combinação de dados está incorreta!*</h3>";
        require("../view/formlogin.php");
    }
}
?>
