<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Excluir sua tarefa:</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="../controller/delTarefa.php" method="post">
                        <fieldset>
                          <div class="form-group">
                            <?php
                              echo $erro;
                              echo $descTarefa;
                            ?>
                          </div>
                        </fieldset>
                        <?php
                          echo $botao;
                        ?>                        
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- LOGIN -->


</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo $css; ?>js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $css; ?>js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo $css; ?>js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo $css; ?>js/plugins/morris/morris.min.js"></script>
<script src="<?php echo $css; ?>js/plugins/morris/morris-data.js"></script>



</body>

</html>
