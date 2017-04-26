<!-- LOGIN -->
<script type="text/javascript">
/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mdata(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    v=v.replace(/(\d{2})(\d)/,"$1/$2");

    v=v.replace(/(\d{2})(\d{2})$/,"$1$2");
    return v;
}
function id( el ){
	return document.getElementById( el );
}
function next( el, next )
{
	if( el.value.length >= el.maxLength )
		id( next ).focus();
}
</script>
<div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Edite sua tarefa:</h3>
                    <?php
                    echo $erro;
                    ?>
                </div>
                <div class="panel-body">
                    <form role="form" action="../controller/edTarefa.php" method="post">
                        <fieldset>
                          <?php
                          echo $form;
                          ?>
                          <input name="buttonEditar" type="submit" value="Submeter edição" class="btn btn-lg btn-success btn-block">
                        </fieldset>
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
