<?php
require("Service.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  
  $service = new Service();
  $deleteService = $service->deleteService("$id");
  if(!$deleteService) {
    die("Query Failed.");
  }
  header('Location: admin.php');
}

?>