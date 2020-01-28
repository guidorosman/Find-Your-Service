<?php
//Funcion que obtiene la diferencia de distancia entre lo localizacion del usuario y la del servicio. Lo de vuelve en kilometros
function getDistance($latUser, $longUser, $latService, $longService){
    $earth_radius = 6371;  
    $dLat = deg2rad($latService - $latUser);  
    $dLon = deg2rad($longService - $longUser);  
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latUser)) * cos(deg2rad($latUser)) * sin($dLon/2) * sin($dLon/2);  
    $c = 2 * asin(sqrt($a));  
    return ($earth_radius * $c);
}                      
?>                        