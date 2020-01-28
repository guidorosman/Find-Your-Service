<?php
session_start();
require("Service.php");

//Si hay una session abierta entonces me muestra panel para editar, caso contrario no me permite ingresar y me redirige al index
if(isset($_SESSION['user'])) {

    $title = '';
    $description= '';
    $active= '';
    $latitude= '';
    $longitude= '';

    // Si el usuario selecciono un servicio para editar, entonces obtengo el id que llega como parametro por GET y creo el objeto para llamar a la funcion y trar los datos del servicio con ese ID
    if  (isset($_GET['id'])) {
        $id = $_GET['id'];
  
        $service = new Service();
        $serviceById = $service->getServiceById($id);

        // Si encontro resultados para ese ID entonces lo recorro para extraer los datos
        if (count($serviceById) > 0){
            foreach ($serviceById as $row){  
                $title = $row['title'];
                $description = $row['description'];
                $active = $row['active'];
                $latitude = $row['latitude'];
                $longitude = $row['longitude'];
            }
        }  
    }

    // Si el usuario hizo click en editar, entonces obtengo los valores de los campos input
    if (isset($_POST['update'])) {
      $id = $_GET['id'];
      $title= $_POST['title'];
      $description = $_POST['description'];
      $latitude = $_POST['latitude'];
      $longitude = $_POST['longitude'];
      
      // Si active esta seleccionado entonces lo cargo en la base como valor 1
      if(isset($_POST['active'])){
          $active = 1;
      }else{
          $active = 0;
      }
  
      $service = new Service();
      $editService = $service->editService($id,$title,$description,$active,$latitude,$longitude);
      header('Location: admin.php');
    }?>

    <!DOCTYPE html>
    <html lang="es">  
        <head>    
            <title>Find Your Service</title>    
            <meta charset="UTF-8">
            <link rel="stylesheet" href="css/styles-edit.css">
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
                <section id="section">
                    <h1>Edit</h1>
                    <form action="edit_service.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <input name="title" type="text" value="<?php echo $title; ?>" placeholder="Update Title">
                        <textarea name="description" placeholder="Update Description"><?php echo $description;?></textarea>
                        <div id="checkbox">
                            <?php 
                            if ($active ==1){ ?>
                                <input type="checkbox" name="active" value="active" checked="checked" > Active
                            <?php
                            }else{?>
                                <input type="checkbox" name="active" value="active" > Active
                            <?php
                            }?>
                        </div>
                        <input name="latitude" type="text" value="<?php echo $latitude; ?>" placeholder="Update Latitude">
                        <input name="longitude" type="text" value="<?php echo $longitude; ?>" placeholder="Update Longitude">
                        <input type="submit" class="btn" name="update" value="Edit">
                    </form>
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