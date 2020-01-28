<?php
session_start();
require("Service.php");

// Si hay una session abierta entonces muetro el panel administrador, caso contrario redirigo al index
if(isset($_SESSION['user'])) {
    // Si el usuario hizo click en insert entonces obtengo los datos ingresados en los campos input
    if (isset($_POST['insert'])) {
          $title = $_POST['title'];
          $description = $_POST['description'];
          $latitude = $_POST['latitude'];
          $longitude = $_POST['longitude'];
          
          // Si active esta seleccionado entonces lo guardo en la base con un 1
          if(isset($_POST['active'])){
              $active = 1;
          }else{
              $active = 0;
          }
          
          $service = new Service();
          $insertService = $service->insertService($title,$description,$active,$latitude,$longitude);
          
          // Si fallo el insert del servicio muestro error y se da por terminado la ejecucion, caso contrario redirigo al panel administrador
          if(!$insertService) {
            die("Query Failed.");
          }
          header('Location: admin.php');
          }?>
          
    <!DOCTYPE html>
    <html lang="es">  
        <head>    
            <title>Find Your Service</title>    
            <meta charset="UTF-8">
            <link rel="stylesheet" href="css/styles-admin.css">
            <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
            </head>  
    
        <body>    
            <header id="header">
                <nav id="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li> <a href="logout.php">Logout</a></li>
                    </ul>
                </nav>    
            </header>
    
            <div id="main">
                <h1>Admin section</h1>
            
                <section id="insert">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input name="title" type="text" placeholder="Insert title">
                        <textarea name="description" placeholder="Insert description"></textarea>
                        <div id="checkbox">
                            <input type="checkbox" name="active"> Active
                        </div>
                        <input name="latitude" type="text" placeholder="Insert latitude">
                        <input name="longitude" type="text" placeholder="Insert longitude">
                        <input type="submit" class="btn" name="insert" value="Insert">
                    </form>
                
                </section>
            
                <section id="list"> <?php
                
                // Creo el objeto y llamo a la funcion getAllServices para listar todos los servicios cargados
                $service = new Service();
                $resultServices = $service->getAllServices();
                
                // Si hay registros entonces creo la tabla, sino muestro mensaje de no hay registros
                if (count($resultServices) > 0){ ?>
                    <table>
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Active</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Action</th>
                        </tr>
                        </thead><?php
                    
                    // Recorro el array para imprimiendo los datos de cada servicio
                    foreach ($resultServices as $row){?>
                           <tbody>
                           <tr>
                           <td><?php echo $row['title']?></td>
                           <td><?php echo $row['description']?></td>
                           <td><?php 
                            
                            // si active esta cargado con un 1 en la base entonces muetro Yes
                            if ($row['active'] == 1){
                                echo "Yes";
                            }else{
                                echo "No";
                            } ?></td>
                            <td><?php echo $row['latitude']?></td>
                            <td><?php echo $row['longitude']?></td>
                             <td>
                            <a href="edit_service.php?id=<?php echo $row['id']?>"><img src="img/edit.png" class="icon"></a>
                            <a href="delete_service.php?id=<?php echo $row['id']?>"><img src="img/delete.png" class="icon"></a>
                            </td>
                            </tr><?php
                    }?>
                    </tbody>
                    </table><?php
                }else{ ?>
                    <h3> <?php echo 'Sorry, no results found'; ?></h3> <?php
                }?>
            </section>
        </div> 
     
            <footer id= "footer">
                <span> Site developed by Guido Ezequiel Rosman &copy; 2020</span>
            </footer>
        </body>  
    </html><?php
}else{
	echo '<script> window.location="index.php"; </script>';
}
?>