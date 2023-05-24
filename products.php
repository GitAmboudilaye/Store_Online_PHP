<?php
 include("connexion.php");
 
class Products{
   // Configurations DB
   
  
    // Insert data
    public function insertData($post){
        $connexion=new Connexion();
       $con=$connexion->con;
        
        //$connexion=new Connexion();
     // $con=$connexion->getConnexion();
        
        $var_categorie = $_POST['categorie'];
        $var_couleur = $_POST['couleur'];
        $var_description = $_POST['description'];
        $var_occasion = $_POST['occasion'];
        $var_prix = $_POST['prix'];
        $var_stock = $_POST['stock'];
        $var_utilisation = $_POST['utilisation'];

       
       // if(!empty($_FILES['photo']['name']))
        if(!empty($_FILES))
        {   // debug($_FILES);
            $nom_photo = $_FILES['photo']['name']; 
           
            $photo_bdd = "tofs/" . $nom_photo;	
           
            $photo_dossier="C:/xampp/htdocs/Ex/tofs/".$nom_photo;
            copy($_FILES['photo']['tmp_name'],$photo_dossier);            
        }
       
        $req="INSERT INTO fleurs (id_produit, categorie, description, couleur, occasion, utilisation, photo,
        prix, stock) values ('', '$var_categorie',  '$var_description', '$var_couleur', '$var_occasion', 
        '$var_utilisation',  '$photo_bdd',  '$var_prix',  '$var_stock')";
       
        $result = $con->query($req);

        if($result){


            // Redirect to index.php
            header("Location:../View/index_pro.php");
 //          
        }else{
            echo 'Failed to register, try again!';
        }       
       
        
    }
 
    // Fetch products records 
    public function displayData(){
        $connexion=new Connexion();
       $con=$connexion->getConnexion();
        $new_query = "SELECT * FROM fleurs";
        $result = $con->query($new_query);
        if($result->num_rows > 0){
            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            echo 'No found records!';
        }
    }


    
    // Fetch single product data
    public function displayRecordById($id){
        $connexion=new Connexion();
        $con=$connexion->getConnexion();
        $new_query = "SELECT * FROM fleurs WHERE id_produit = '$id'";
        $result = $con->query($new_query);
        if($result->num_rows > 0){            
           $row = $result->fetch_assoc();
            return $row;
        }
        else{
            echo 'Record not found!';
        }
    }
    
    // Update  product record
    public function updateRecord($post)
    
    {
        $connexion=new Connexion();
        $con=$connexion->getConnexion();

        $var_categorie = $_POST['categorie'];
        $var_couleur = $_POST['couleur'];
        $var_description = $_POST['description'];
        $var_occasion = $_POST['occasion'];
        $var_prix = $_POST['prix'];
        $var_stock = $_POST['stock'];
        $var_utilisation = $_POST['utilisation'];
        $var_id = $_POST['id_produit'];

        if(!empty($_FILES['photo']['name']))
            {   // debug($_FILES);
                $nom_photo = $_FILES['photo']['name']; // permet de recuperer le nom de la photo selectionné
            
                $photo_bdd = "tofs/" . $nom_photo;	// le lien du dossier du site a partir du dossier du site.
                	
                $photo_dossier="C:/xampp/htdocs/EX/Eg/tofs/".$nom_photo;
                copy($_FILES['photo']['tmp_name'],$photo_dossier); 
            
                if(!empty($var_id) && !empty($post)){
                  
                    $new_query = "UPDATE fleurs SET categorie = '$var_categorie', couleur ='$var_couleur',
                     description = '$var_description', occasion = '$var_occasion', prix = '$var_prix', 
                     stock = '$var_stock', utilisation = '$var_utilisation', stock = '$var_stock',
                      photo = '$photo_bdd' WHERE id_produit = '$var_id'";
                                       
                    $result = $con->query($new_query);
                    if($result){
                        // echo 'Object updated successfully! <br/>';
                        // Redirect to index.php                  
                        header("Location:../View/index_pro.php");
                    }else{
                        echo 'Failed to update, try again!';
                    }
                }
                
            }
            else{
               
                if(!empty($var_id) && !empty($post)){
                    
                  
                    $new_query = "UPDATE fleurs SET categorie = '$var_categorie', couleur ='$var_couleur',
                     description = '$var_description', occasion = '$var_occasion', prix = '$var_prix',
                      stock = '$var_stock', utilisation = '$var_utilisation', stock = '$var_stock'
                       WHERE id_produit = '$var_id'";
                                       
                    $result = $con->query($new_query);
                    if($result){
                         echo 'Object updated successfully! <br/>';
                        // Redirect to index.php                  
                        header("Location:../View/index_pro.php");
                    }else{
                        echo 'Failed to update, try again!';
                    }
                }

            }

        
    }


    
     // Delete record
     public function deleteRecord($id){
        $connexion=new Connexion();
       $con=$connexion->getConnexion();
        $new_query = "DELETE FROM fleurs WHERE id_produit = '$id'";
        $result = $con->query($new_query);
        if($result){            
             //echo 'Record deleted successfully!';
            // Redirect to index.php
           
            header("Location:../View/index_pro.php");
        }
        else{
            echo 'Could not delete!';
        }
    }


   



}


?>