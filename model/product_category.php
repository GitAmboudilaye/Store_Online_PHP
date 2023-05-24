<?php
//include'../model/connexion.php';
    class Product_Category{
        
        private $id_product_category;
        private $id_product;
        private $id_category;
        private $stock_i;
        private $stock_s;

    // Constructeur
        public function __construct() {
            if(isset($_GET)){
                $this->id_product_category = $_GET['id_product_category'];
            }
            
        }
        // Getters
        public function getId_product_category() {
            return $this->id_product_category;
        }
        public function getId_product() {
            return $this->id_product;
        }
        public function getId_category() {
            return $this->id_category;
        }
        public function getStock_i () {
            return $this->stock_i;
        }
        public function getStock_s () {
            return $this->stock_s;
        }
    }
?>