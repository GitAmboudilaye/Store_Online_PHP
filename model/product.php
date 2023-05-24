<?php
//include('../model/connexion.php');
    class Product{
        private $id ;
        private $description ;
        private $couleur ;
        private $photo ;
        private $prix ;
        private $stock ;
        private $stockSell ;
        private $productList =array();


        public function __construct(){
            if(isset($_POST)){ 
                $this->description = $_POST['description'];
                $this->couleur = $_POST['couleur'];
                $this->photo = $_FILES['photo']['name'];
                $this->prix = $_POST['prix'];
                $this->stock = $_POST['stock'];
            }
            if(isset($_GET['id'])){
                $this->id = $_GET['id_product'];
            }
        }
        
        // Getters
        public function getId(){
            return $this->id;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getCouleur(){
            return $this->couleur;
        }

        public function getPhoto(){
            return $this->photo;
        }

        public function getPrix(){
            return $this->prix;
        }

        public function getStock(){
            return $this->stock;
        }
        public function getStockSell(){
            return $this->stockSell;
        }
        //Setter
        public function setId($id){
            $this->id = $id;
        }
        
        public function setDescription($description){
            $this->description = $description;
        }
        
        public function setCouleur($couleur){
            $this->couleur = $couleur;
        }
        
        public function setPhoto($photo){
            $this->photo = $photo;
        }
        
        public function setPrix($prix){
            $this->prix = $prix;
        }
        
        public function setStock($stock){
            $this->stock = $stock;
        }
        public function setStockSell($stock){
            $this->stockSell = $stock;
        }
        

    }




?>