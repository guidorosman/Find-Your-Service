<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
	    <title>Validating...</title>
	    <meta charset="utf-8">
    </head>
    <body>
		<?php
		    require('User.php');
		    //Si el usuario dio click en login entro al IF
			if(isset($_POST['login'])){
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				//Creo el objeto y llamo a la funciongetUserByEmailAndPassword para ver si los datos ingresados
				// son correctos y existen en la base
				$user = new User();
				$resultUser = $user->getUserByEmailAndPassword($email,$password);
				
				// Si devolvio resultado quiere decir que ingreso datos correctos entonces guardo el user en session y lo redirigo a panel administrador
				if (count($resultUser) > 0){ 
				    foreach ($resultUser as $row){
    					$_SESSION["user"] = $row['email']; 
    					echo '<script> window.location="admin.php"; </script>';
				    }
				}else{
				    // Si ingreso datos incorrectos entra en este else
					echo '<script> alert("User or password wrong.");</script>';
					echo '<script> window.location="login.php"; </script>';
				}
			}
		?>	
    </body>
</html>