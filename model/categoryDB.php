<?php

    class CategoryDB{
        private $con;
       
        public function Insertcategory($post){
            //Insertion data
            $connexion = new Connexion();
            $this->con = $connexion->getConnexion();
            //$id_category = $_POST['id'];
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $req= $this->con->prepare("INSERT INTO Categories(Nom, Description) 
            values (?, ?)");
            $req->bind_param('ss',$nom, $description);
            $req->execute();
            //$res=$con->query($req);

            if($req->affected_rows === 1) {
                echo "Insertion réussie!";
                header("Location:../view/addproduct.php");
            } else {
                echo '<div style="background: red; padding: 5px;"><center>Failed to register, try again!</center></div>'; 
            }
        }
        public function Displayallcategories(){
            $connexion = new Connexion();
            $this->con = $connexion->getConnexion();
            
            $req = $this->con->prepare("SELECT * FROM Categories");
            $req->execute();
            $result = $req->get_result();
            if($result->num_rows > 0 ){
                $data = array();
                while($rows = $result->fetch_assoc()){
                    $data[] = $rows;
                }
                return $data;
            }else{
                echo '<div style="background: blue; padding: 5px;"><center>No category. Please add news categories</center></div>'; 
                //exit;
            }
        }
    }
?>