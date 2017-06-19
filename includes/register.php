<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Formulario de registro</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <!-- Formulario de registro que se emitir� si las variables POST no se
          establecen o si la secuencia de comandos de registro ha provocado un error. -->
        <h1>Reg�strate con nosotros</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li> Los nombres de usuario podr�an contener solo d�gitos, letras may�sculas, min�sculas y guiones bajos.</li>
            <li> Los correos electr�nicos deber�n tener un formato v�lido. </li>
            <li> Las contrase�as deber�n tener al menos 6 caracteres.</li>
            <li>Las contrase�as deber�n estar compuestas por:
                <ul>
                    <li> Por lo menos una letra may�scula (A-Z)</li>
                    <li> Por lo menos una letra min�scula (a-z)</li>
                    <li> Por lo menos un n�mero (0-9)</li>
                </ul>
            </li>
            <li> La contrase�a y la confirmaci�n deber�n coincidir exactamente.</li>
        </ul>
        <form method="post" name="registration_form">
                
                
            Nombre de usuario: <input type='text' 
                name='username' 
                id='username' /><br>
            Correo electr�nico: <input type="text" name="email" id="email" /><br>
            Contrase�a: <input type="password"
                             name="password" 
                             id="password"/><br>
            Confirmar contrase�a: <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" /><br>
            <input type="button" 
                   value="Register" 
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
		</div>
    </body>
</html>