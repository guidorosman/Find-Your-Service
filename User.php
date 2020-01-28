<?php
    //Creo la clase User con sus funciones
    require_once('Connection.php');

    class User extends Connection{
        private $email;
        private $password;
        
        public function getUserByEmailAndPassword($email,$password){
            $this->email = $email;
            $this->password = $password;
            $result = $this->_conn->query("SELECT * FROM users WHERE email='$this->email' AND password='$this->password'");
            $regs = $result->fetch_all(MYSQLI_ASSOC);
            return $regs;
        }
    }

?>