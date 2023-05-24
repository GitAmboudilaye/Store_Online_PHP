<?php
    include('../model/connexion.php');
    //include('../model/categoryDB.php');
    class ProductDB{
        private $con;
        private $product;
        private $category;
        private $categoryDB;
        private $product_category;

        public function Insertdata($post){
            $connexion = new Connexion();
            $this->con = $connexion->getConnexion();
            //------------------
            $description = $_POST['description'];
            $couleur = $_POST['couleur'];
            
            $prix = $_POST['prix'];
            $stock_i = $_POST['stock'];
            $stock_s = 0;
            if (empty($_FILES['photo']['name'])){
                // Afficher un message d'erreur ou rediriger l'utilisateur vers une page de formulaire avec un message d'erreur
                die("Vous devez télécharger une image.");
                return;
            }
            //build upload file
            $photo = $_FILES['photo']['name'];
            $photo_bdd = "photos/".$photo;
            $dossier_photo = 'C:\XamppNew\htdocs\Cours_CM\projetsession/photos/'.$photo;
            Copy($_FILES['photo']['tmp_name'], $dossier_photo);
            //Insertion data
            $req_product=$this->con->prepare("INSERT INTO Products(Description_Product, Couleur, Photo, Prix) 
            values (?, ?, ?, ?)");
            $req_product->bind_param('sssd',$description, 
                                            $couleur, 
                                            $photo_bdd, 
                                            $prix);
            $req_product->execute();

            //Récupération de l'ID du produit inséré
            // cette funtion mysqli_insert_id() permet de recuperer l'Id a l'instant de la reauest
            $id_produit = mysqli_insert_id($this->con);
            
            //Recuperation de les categories 
            $id_data = array(); 
            $category = $_POST['categories'];
            //$description = $_POST['description'];
            foreach ($category as $categorie) {
                $req = $this->con->prepare("SELECT Id_Category FROM Categories WHERE Nom = ?");
                $req->bind_param('s', $categorie);
                $req->execute(); // Exécute la requête préparée
                $res = $req->get_result();
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $id_data[] = $row['Id_Category'];
                    } 
                }
            }
            // Insertion des catégories dans la table Product_Category
            foreach($id_data as $id_category){
                $req_categorie = $this->con->prepare("INSERT INTO Product_Category (Id_Product, Id_Category, Stock_Initial, Stock_Sell) Value(?, ?, ?, ?)");
                $req_categorie->bind_param('iiii',$id_produit, $id_category, $stock_i, $stock_s);
                $req_categorie->execute();
            }

            if($req_product->affected_rows > 0  && $req_categorie->affected_rows > 0) {
                echo "Insertion réussie!";
                header("Location:../view/dashboard.php");
            } else {
                echo '<div style="background: red; padding: 5px;"><center>Failed to register, try again!</center></div>'; 
            }
        }
        public function DisplayProduct(){
            //connnexion to data base
            $connexion = new Connexion();
            $this->con = $connexion->getConnexion();
            //------------------

            require_once('../model/categoryDB.php');
            $this->categoryDB = new CategoryDB();
            $categories = $this->categoryDB->Displayallcategories();
            $categoryProducts = array();
          
            if(!empty(!$categories)){
                echo '<div style="background: blue; padding: 5px;"><center>This store is empty. Please add news products</center></div>'; 
                exit;
            }
            foreach($categories as $category){
                
                $req = $this->con->prepare("SELECT Products.*, Categories.*, Product_Category.*
                    FROM Products
                    INNER JOIN Product_Category ON products.Id_Product = Product_Category.Id_Product
                    INNER JOIN Categories ON Product_Category.Id_Category = categories.Id_Category
                    WHERE Product_Category.Id_Category= ?");
                $req->bind_param('i',$category['Id_Category']);
                $req->execute();
            
                $res = $req->get_result();
                if($res->num_rows >0){

                    $data = array();
                    while ($row = $res->fetch_assoc()){
                        
                        $data[] = array(
                            'Id_Product' => $row['Id_Product'],
                            'Id_Product_Category' => $row['Id_Product_Category'],
                            'Couleur' => $row['Couleur'],
                            'Description_Product' => $row['Description_Product'],
                            'Prix' => $row['Prix'],
                            'Photo' => $row['Photo'],
                            'Stock_Initial' => $row['Stock_Initial'],
                            'Stock_Sell' => $row['Stock_Sell']
                        );
                        
                    }
                    $categoryProducts[$category['Nom']] =$data ;
                    
                }
                else{
                    
                    $empty = array();
                    $categoryProducts[$category['Nom']] =$empty ;
                    //echo '<div style="background: blue; padding: 5px;"><center>This category is empty. Please add news products</center></div>'; 
                    
                }
            }
            return $categoryProducts; 
        }

        public function DisplayProductbyId($id){
            //connnexion to data base
            $connexion = new Connexion();
            $this->con = $connexion->getConnexion();
            $req = $this->con->prepare("SELECT Products.*, Categories.*, Product_Category.*
            FROM products
            INNER JOIN Product_Category ON products.Id_Product = Product_Category.Id_Product
            INNER JOIN Categories ON Product_Category.Id_Category = categories.Id_Category
            WHERE Product_Category.Id_Product_Category=  ?");
            $req->bind_param('i',$id);
            $req->execute();
            $res = $req->get_result();

            if($res->num_rows >0){

                $row = $res->fetch_assoc();
                echo 'products is find!'.$row["Id_Product_Category"];
                return $row; 
            }
            else{
                echo 'products is not find!';
            }
        }
        public function Updatercord($id){

            //$id = $_GET['id_product'];
            $description = $_POST['description'];
            $couleur = $_POST['couleur'];
            
            $prix = $_POST['prix'];
            $stock_i = $_POST['stock'];
            //---------------------
            //connnexion to data base
            echo 'update!'.$id;
            $connexion = new Connexion();
            $this->con = $connexion->getConnexion();
            if (empty($_FILES['photo']['name'])){
                // Afficher un message d'erreur ou rediriger l'utilisateur vers une page de formulaire avec un message d'erreur
                die("Vous devez télécharger une image.");
                return;
            }
            //build upload file
            $photo = $_FILES['photo']['name'];
            $photo_bdd = "photos/".$photo;
            $dossier_photo = 'C:\XamppNew\htdocs\Cours_CM\projetsession/photos/'.$photo;
            Copy($_FILES['photo']['tmp_name'], $dossier_photo);
            
            echo 'update!'.$id;
            // les deux tableaux sont identiques
            $req = $this->con->prepare("UPDATE Products 
            INNER JOIN Product_Category ON Products.Id_Product = Product_Category.Id_Product_Category
            SET Products.Description_Product = ? , Products.Couleur  = ?, Products.Photo = ?, Products.Prix = ?, Product_Category.Stock_Initial = ?
            WHERE Product_Category.Id_Product_Category = ?");

            $req->bind_param('sssdii', $description, $couleur, $photo_bdd, $prix, $stock_i, $id);
            $res = $req->execute();
            if($res){            
                // Redirect to dashboad
                header("Location:../view/dashboard.php");
            }
            else{
                echo 'Could not update!';
            }
            
        }

        // Delete record
        public function deleteRecord($id){
            $product = new ProductDB();
            $each_id = $product->DisplayProductbyId($id);
            $connexion = new Connexion();
            $this->con = $connexion->getConnexion();
            // Supprimer tous les enregistrements de Product_Category associés à la catégorie et product
            $req = $this->con->prepare("DELETE FROM Product_Category WHERE Id_Product_Category = ?");
            $req->bind_param('i', $each_id['Id_Product_Category']);
            $res1 = $req->execute();

            
            // Supprimer la Product
            $req = $this->con->prepare("DELETE FROM Products WHERE Id_Product = ?");
            $req->bind_param('i', $each_id['Id_Produt']);
            $res2 = $req->execute();

            if($res1 && $res2){            
                // Redirect to dashboad
                header("Location:../view/dashboard.php");
            }
            else{
                echo 'Could not delete!';
            }
        }
        public function deleteMultiRecord($id_array){
            $product = new ProductDB();
            $connexion = new Connexion();
            $this->con = $connexion->getConnexion();
            $res1 =false;
            $res2 =false;
            foreach ($id_array as $id ){
                $each_id = $product->DisplayProductbyId($id);
            
            
            // Supprimer tous les enregistrements de Product_Category associés à la catégorie et product
            $req = $this->con->prepare("DELETE FROM Product_Category WHERE Id_Product_Category = ?");
            $req->bind_param('i', $each_id['Id_Product_Category']);
            $res1 = $req->execute();

            
            // Supprimer la Product
            $req = $this->con->prepare("DELETE FROM Products WHERE Id_Product = ?");
            $req->bind_param('i', $each_id['Id_Produt']);
            $res2 = $req->execute();
            }

            if($res1 && $res2){            
                // Redirect to dashboad
                header("Location:../view/dashboard.php");
            }
            else{
                echo 'Could not delete!';
            }
            
        }


    }
?>