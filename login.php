<?php
	session_start();
	require('User.php');
	// Si el usuario ya esta logueado entonces lo redirigo al panel administrador
	// Caso contrario, se muestra la pagina de login para ingresar datos logueo
	if(isset($_SESSION['user'])){
	    echo '<script> window.location="admin.php"; </script>';
	}
?>

<!DOCTYPE html>
<html lang="es">  
    <head>    
        <title>Find Your Service</title>    
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles-login.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    </head>  
    
    <body>    
        <header id="header">
            <nav id="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li> <a href="login.php">Admin section</a></li>
                </ul>
            </nav>    
        </header>
    
    <div id="main">
        <section id="section">
            <h1>Login</h1>
			<form method="post" action="validation.php">
				<input type="email" name="email" required placeholder="Email">
			    <input type="password" name="password" required placeholder="Password">
				<input type="submit" class="btn" name="login" value="Login">
			</form>
        </section>    
    </div> 
     
    <footer id= "footer">
        <span> Site developed by Guido Ezequiel Rosman &copy; 2020</span>
    </footer>
  
  </body>  
</html>






