<?php
    // Creo la clase Connection con los datos para poder ingresar a la base
    class Connection {
        private $_HOST = '';
        private $_USERNAME = '';
        private $_PASSWORD = '';
        private $_DATABASE = '';
        protected $_conn;
        
        public function __construct(){
            $this->_conn = new mysqli($this->_HOST, $this->_USERNAME, $this->_PASSWORD, $this->_DATABASE);   
            if ($this->_conn->connect_errno){
                echo "Connection error";
            }
        }
    }
?>
