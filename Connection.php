<?php
    // Creo la clase Connection con los datos para poder ingresar a la base
    class Connection {
        private $_HOST = 'localhost';
        private $_USERNAME = 'id12249469_guidoros';
        private $_PASSWORD = 'pass123';
        private $_DATABASE = 'id12249469_examen_bnt';
        protected $_conn;
        
        public function __construct(){
            $this->_conn = new mysqli($this->_HOST, $this->_USERNAME, $this->_PASSWORD, $this->_DATABASE);   
            if ($this->_conn->connect_errno){
                echo "Connection error";
            }
        }
    }
?>