<?php
require("functions.php"); 
require("Service.php");?>

<!DOCTYPE html>
<html lang="es">  
    <head>    
        <title>Find Your Service</title>    
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    </head>  
    
    <body>    
        <header id="header">
            <nav id="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Admin section</a></li>
                </ul>
            </nav>    
        </header>
    
    <div id="main">
        <section id="section">
            <h1>Find Your Service</h1>
             <form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input id="search" type="text" name="title" placeholder="Insert service" autocomplete="off">
                    <div id="position">
                    <span>Your localization:</span>
                    <label for="lat">Lat:</label>
                    <input id="lat" type="text" name="lat" readonly="readonly">
                    <label for="long">Long:</label>
                    <input id="long" type="text" name="long" readonly="readonly">
                    <span>Radio range:</span>
                    <select name="distance">
                        <option value="0">Anywhere</option>
                        <option value="2">2 KM</option>
                        <option value="10">10 KM</option>
                        <option value="100">100 KM</option>
                    </select>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Search">
            </form> 
            
    <?php
    //Si el usuario presiono Search, entonces entro al IF
    if(isset($_POST['submit'])){
        
        //Si ingreso texto para buscar entonces entro al IF, sino muestro mensaje que ingrese algo para buscar
       if ($_POST['title'] != ""){
            $title = $_POST['title'];
            $lat = $_POST['lat'];
            $long = $_POST['long'];
            $distance =  $_POST['distance'];  
            $tableHeadings = "";
            $tableResults = "";
            
            $service = new Service();
            $resultServices = $service->getServicesActive($title);
            
            //Me fijo si la consulta SQL arrojo resultados
            if (count($resultServices) > 0){ 
                //Encabezado de tabla a mostrar
                $tableHeadings = "<table id='table'>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Active</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Distance from you</th>
                        </tr>
                    </thead>";
                
                    //Recorro el array para ir llenando datos a la tabla
                    foreach ($resultServices as $row){
                        //Llamo a funcion para comparar distancia entre usuario y servicio
                        $d = getDistance($lat,$long,$row['latitude'],$row['longitude']);
                        
                        //Si se ingreso filtro distancia entro al IF para compararlo con la diferencia de distancia entre el usuario y servicio
                        if ($distance != 0){
                            //Siempre que la diferencia de distancia entre el usuario y el servicio sea menor
                            //o igual que el filtro seleccionado entonces guardo el resultado para mostrar en la tabla
                            if ($d <= $distance){
                            
                            //Lleno la tabla con los datos del servicio
                            $tableResults = $tableResults . "<tbody>
                                         <tr> 
                                            <td>".$row['title']."</td>
                                            <td>".$row['description']."</td>
                                            <td>Yes</td>
                                            <td>".$row['latitude']."</td>
                                            <td>".$row['longitude']."</td>
                                            <td>".round($d, 2)." KM</td>";       
                            }
                            //Si no ingreso filtro distancia(anywhere) entonces no hago comparacion y muestro directamente los resultados en la tabla
                        }else{
                            
                            //Lleno la tabla con los datos del servicio
                             $tableResults = $tableResults . "<tbody>
                                         <tr> 
                                            <td>".$row['title']."</td>
                                            <td>".$row['description']."</td>
                                            <td>Yes</td>
                                            <td>".$row['latitude']."</td>
                                            <td>".$row['longitude']."</td>
                                            <td>".round($d, 2)." KM</td>";       
                                            
                        }
                    } 
                
                    //Si la variable tableResults no esta vacia quiere decir que  encontro resultados en los if anteriores y hay datos para mostrar. Los imprimo a continuacion
                    if ($tableResults != ""){?>
                        <h3 id="title"> <?php echo 'Results found:'; ?></h3> <?php
                        echo $tableHeadings; 
                        echo $tableResults;
                   }else{?>
                        <h3><?php echo 'No results found'; ?></h3<?php  
                   }
                //Si no encontro resultados la consulta SQL muestro mensaje de no resultados encontrados   
                }else{?>
                    <h3><?php echo 'No results found'; ?></h3<?php  
                }
                
       //El usuario no ingreso texto al campo search
       }else{?>
           <h3><?php echo 'Insert something to search';?></h3<?php  
       }    
    
    }?>   
       </section>    
    </div> 
     
        <footer id= "footer">
            <span> Site developed by Guido Ezequiel Rosman &copy; 2020</span>
        </footer>
    
        <script type="text/javascript" src="localization.js"></script>
    
    </body>  
</html>