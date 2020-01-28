<?php
//Si el usuario dio click en logout entonces destruyo la session y redirigo al index
session_start();
session_destroy();
echo '<script> window.location="index.php"; </script>';
?>
<!DOCTYPE html>
<html>
    <head>
	    <title>Logging out...</title>
	    <meta charset="utf-8">
    </head>
    <body>
        <script language="javascript">location.href = "index.php";</script>
    </body>
</html>