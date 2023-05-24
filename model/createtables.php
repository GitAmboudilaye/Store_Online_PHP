<?php
//http://localhost/Boutique_Online/model/createtable.php
require_once("connexion.php");
/*$Req= "CREATE TABLE IF NOT EXISTS Products (
    Id_ INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Categorie VARCHAR(50) NOT NULL,
    Description VARCHAR(50) NOT NULL,
    Couleur VARCHAR(50) NOT NULL,           
    Occasion ENUM('Anniversaire', 'Mariage') NOT NULL,
    Utilisation ENUM('Bouquets', 'Vase') NOT NULL,
    Photo VARCHAR(250) NOT NULL,
    Prix DECIMAL(10,2) NOT NULL,
    Stock_Number INT(100) NOT NULL
)";   */    

$Reqcategorie = "CREATE TABLE IF NOT EXISTS Categories (
    Id_Category INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(50) NOT NULL,
    Description VARCHAR(10000) NOT NULL
)";

$Reqproduct = "CREATE TABLE IF NOT EXISTS Products (
    Id_Product  INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Description_Product VARCHAR(10000) NOT NULL,
    Couleur VARCHAR(100) NOT NULL,           
    Photo VARCHAR(250) NOT NULL,
    Prix DECIMAL(10,2) NOT NULL  
)";
/*CONSTRAINT FK_Products_Categories FOREIGN KEY (category_id) REFERENCES Categories(id)*/
$Reqjonction = "CREATE TABLE IF NOT EXISTS Product_Category (
    Id_Product_Category  INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Id_Product INT(10) NOT NULL,
    Id_Category INT(10) NOT NULL,
    Stock_Initial INT(100) NOT NULL,
    Stock_Sell INT(100) NOT NULL,
    FOREIGN KEY (Id_Product) REFERENCES Products(Id_Product),
    FOREIGN KEY (Id_Category) REFERENCES Categories(Id_Category)
);";
//PRIMARY KEY (Id_Product, Id_Category),
        


$connexion = new Connexion();
$con = $connexion->getConnexion();
$con->query($Reqcategorie);
$con->query($Reqproduct);
$con->query($Reqjonction);

/*DROP table product_category;
DROP TABLE products;
DROP TABLE categories;*/

/*SELECT Products.*, Categories.*, Product_Category.*
                    FROM Categories
                    INNER JOIN Product_Category ON Categories.Id_Category = Product_Category.Id_Product
                    INNER JOIN Products ON Product_Category.Id_Category = Products.Id_Product
                    WHERE Categories.Nom='News'; */
?>
