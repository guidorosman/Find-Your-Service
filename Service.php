<?php
    //Creo la clase Service con sus funciones
    require_once('Connection.php');

    class Service extends Connection{
        private $id;
        private $title;
        private $description;
        private $active;
        private $latitude;
        private $longitude;
        
         public function getAllServices(){
            $result = $this->_conn->query("SELECT * FROM services");
            $regs = $result->fetch_all(MYSQLI_ASSOC);
            return $regs;
            
        }
        
        public function getServicesActive($title){
            $this->title = $title;
            $result = $this->_conn->query("SELECT * FROM services WHERE title LIKE '%$this->title%' and active = 1");
            $regs = $result->fetch_all(MYSQLI_ASSOC);
            return $regs;
            
        }
        
        public function getServiceById($id){
            $this->id = $id;
            $result = $this->_conn->query("SELECT * FROM services WHERE id = '$this->id'");
            $regs = $result->fetch_all(MYSQLI_ASSOC);
            return $regs;
            
        }
        
        public function insertService($title,$description,$active,$latitude,$longitude){
            $this->title = $title;
            $this->description = $description;
            $this->active = $active;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $result = $this->_conn->query("INSERT into services (title, description, active, latitude, longitude) VALUES ('$this->title', '$this->description', '$this->active','$this->latitude','$this->longitude')");
            return $result;
        }
        
        public function editService($id,$title,$description,$active,$latitude,$longitude){
            
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            
            $result = $this->_conn->query("UPDATE services set title = '$this->title', description = '$this->description', active = '$active', latitude = '$this->latitude', longitude = '$this->longitude' WHERE id='$this->id'");
            
        }
        
        public function deleteService($id){
            
            $this->id = $id;
            $result = $this->_conn->query("DELETE from services WHERE id = '$this->id'");
            return $result;
        }
        
    }

?>