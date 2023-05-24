<?php
    class Connexion{
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $databasename = "OwnStore";
        private $con;
        public function __construct(){
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->databasename);
            if(mysqli_connect_error()){
                trigger_error('erreur de connexion', mysqli_connect_error());
            }
            else{
                return $this->con;
            }
           
        }
        public function getConnexion(){
            if( $this->con == null){
                return new Connexion();
            }
            return  $this->con;
        }
    }
 
?> 