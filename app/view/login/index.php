	  <div id="login-page">
	  	<div class="container">
			  
	  			<form class="form-login" action="<?php echo URL; ?>login/logon" method="POST">
				<!-- <form class="form-login" method="post" action="index.php"> -->
		        <h2 class="form-login-heading">Acessar Finanza</h2>
		        <div class="login-wrap">
		            <input type="email" name="usuario" class="form-control" placeholder="Usuário" autofocus>
		            <br>
		            <input type="password" name="senha" class="form-control" placeholder="Senha">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Esqueceu sua senha?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" href="index.php" type="submit" name="submit_login"><i class="fa fa-lock"></i> ENTRAR </button>
		            <hr>
<!--
					<span class="pull-right">
		                    <a data-toggle="modal" href="frmCadUsuarios.php?acao=INSERT"> Cadastre-se</a>		
					</span>	
-->

<!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Esqueceu sua senha?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Digite o seu e-mail para receber sua nova senha.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
		                          <button class="btn btn-theme" type="button">Enviar</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		      </form>
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/background.jpg", {speed: 500});
    </script>


  </body>
</html>
