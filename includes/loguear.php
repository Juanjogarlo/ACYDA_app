<div class="jumbotron jumbotronjuanjologin">
	<div id="conectandregister" >
		<form action="includes/process_login.php" method="post" name="login_form" style="margin-top: -17px; float:right;">     
			<!--<a href="register.php">Registrarse.</a><br>-->
			<?php
			if (isset($_GET['error'])) {
				echo '<span id="mensaje" style="color:red; font-size:1.3em">Datos incorrectos</span><br>';
			}
			else
			{
				echo '<span id="mensaje" style=" font-size:1.3em">Acceso a administración</span><br>';
			}
			?> 
			<span>Correo electrónico: </span><input type="text" name="email" class="inputlogin"/>
			<br>
			<span>Contraseña: </span><input type="password" class="inputlogin"
							 name="password" 
							 id="password"/>
			<br><input type="button" class="botonlogin" 
				   value="Login" 
				   onclick="formhash(this.form, this.form.password);" /> 
		</form>
	</div>
</div>