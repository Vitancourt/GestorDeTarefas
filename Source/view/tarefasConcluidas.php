<!-- Begin-Página -->
<div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-10">
              <h2>Tarefas concluídas</h2>
              <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th>Descrição</th>
                              <th>Data</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            if(!session_id()){
                              session_start();
                            }
                            require_once("../model/Tarefa.php");
                            $tarefa = new Tarefa();
                            $teste = $tarefa->verTarefasConcluidas($_SESSION['id']);
                          ?>
                      </tbody>
                  </table>
              </div>
          </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
