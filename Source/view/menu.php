<body>
     <div id="wrapper">

         <!-- Navigation -->
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
             <!-- Brand and toggle get grouped for better mobile display -->
             <div class="navbar-header">
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                 </button>
                 <a class="navbar-brand" href="#">Gestor de tarefas</a>
             </div>
             <!-- Begin-Menu-topo -->
             <ul class="nav navbar-right top-nav">
                 <!-- Begin-Perfil -->
                 <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['usuario'];?> <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li>
                             <a href="../controller/sair.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                         </li>
                     </ul>
                 </li>
                 <!-- End-Perfil -->
             </ul>
            <!-- Begin-MenuLateralResponsivo -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="<?php echo $css;?>homepage.php"><i class="fa fa-fw fa-dashboard"></i> Início</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#agenda"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><i class="fa fa-fw"></i> Tarefas <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="agenda" class="collapse">
                            <li>
                                <a href="<?php echo $css;?>adicionarTarefa.php">Adicionar tarefas</a>
                            </li>
                            <li>
                                <a href="<?php echo $css;?>homepage.php">Ver não concluídas</a>
                            </li>
                            <li>
                                <a href="<?php echo $css;?>tarefas.php">Ver concluidas</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#pacientes"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><i class="fa fa-fw"></i> Perfil <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pacientes" class="collapse">
                            <li>
                                <a href="../controller/sair.php">Sair</a>
                            </li>
                        </ul>
                    </li>

                 </ul>
             </div>
             <!-- End-MenuLateralResponsivo -->
         </nav>
