<?php
session_start();
class panier{
    public function ajout_panier($id_produit_category)
    {
        include 'connexion.php';
        $connexion=new Connexion();
        $con=$connexion->getConnexion();
        $req = $con->prepare("SELECT Products.*, Categories.*, Product_Category.*
            FROM products
            INNER JOIN Product_Category ON products.Id_Product = Product_Category.Id_Product
            INNER JOIN Categories ON Product_Category.Id_Category = categories.Id_Category
            WHERE Product_Category.Id_Product_Category=  ?");
            $req->bind_param('i',$id_produit_category);
            $req->execute();
            $res = $req->get_result();
            if($res->num_rows >0){

                $row = $res->fetch_assoc();
                echo 'products is find!'.$row["Id_Product_Category"];
                echo 'products is find!'.$row["Nom"];
                return $row; 
            }
    }

    public function creation_Panier()
    {
       
          $_SESSION['panier']=array();
          $_SESSION['panier']['category'] = array();
          $_SESSION['panier']['id_produit'] = array();
          $_SESSION['panier']['quantite'] = array();
          $_SESSION['panier']['prix'] = array();
          $_SESSION['panier']['photo'] = array();
       
    }

 
     public function ajouterProduitDansPanier($category,$id_produit,$quantite,$prix,$photo)
    {
	    $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']); 
        if ($position_produit !== false)
        {
            $_SESSION['panier']['quantite'][$position_produit] += $quantite ;
        }
        else 
        {
            $_SESSION['panier']['category'][] = $category;
            $_SESSION['panier']['id_produit'][] = $id_produit;
            $_SESSION['panier']['quantite'][] = $quantite;
            $_SESSION['panier']['prix'][] = $prix;
            $_SESSION['panier']['photo'][] = $photo;

            

        }
    }



    public function retirerproduitDuPanier($id_produit_a_supprimer)
    {
        $position_produit = array_search($id_produit_a_supprimer,  $_SESSION['panier']['id_produit']);
        if ($position_produit !== false)
        {
            array_splice($_SESSION['panier']['category'], $position_produit, 1);
            array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
            array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
            array_splice($_SESSION['panier']['prix'], $position_produit, 1);
            array_splice($_SESSION['panier']['photo'], $position_produit, 1);
        }
    }

    public function viderpanier()
    {
        unset($_SESSION['panier']);
    }

    public function montantparproduit($id_produit)
    {
        $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']);

        $total=0;
        $total = $_SESSION['panier']['quantite'][$position_produit] * $_SESSION['panier']['prix'][$position_produit];
        return round($total,2);
    }
    public function montantTotal()
    {
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
        {
            $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
        }
        return round($total,2);
    }

    public function incrementQuantite($id_produit)
    {
        $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']); 
        
        
        $_SESSION['panier']['quantite'][$position_produit] += 1 ;
        
        
    }
    public function decrementQuantite($id_produit)
    {
        $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']); 
        if($_SESSION['panier']['quantite'][$position_produit] <=1){
            array_splice($_SESSION['panier']['category'], $position_produit, 1);
            array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
            array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
            array_splice($_SESSION['panier']['prix'], $position_produit, 1);
            array_splice($_SESSION['panier']['photo'], $position_produit, 1);
        }else{
            $_SESSION['panier']['quantite'][$position_produit] -= 1 ;
        }
            
        
    }
    

    public function valider_paiement()
    {
        include 'connexion.php';
        $connexion=new Connexion();
        $con=$connexion->getConnexion();
        for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++) 
	    {
            $x=$_SESSION['panier']['quantite'][$i];

            $req = $con->prepare("SELECT Products.*, Categories.*, Product_Category.*
            FROM products
            INNER JOIN Product_Category ON products.Id_Product = Product_Category.Id_Product
            INNER JOIN Categories ON Product_Category.Id_Category = categories.Id_Category
            WHERE Product_Category.Id_Product_Category=  ?");
            $req->bind_param('i',$_SESSION['panier']['id_produit'][$i]);
            $req->execute();
            $res = $req->get_result();
            $row = $res->fetch_assoc();

            $y=$row['Stock_Initial'];
            $req = $con->prepare("UPDATE Products 
            INNER JOIN Product_Category ON Products.Id_Product = Product_Category.Id_Product_Category
            SET  Product_Category.Stock_Initial = ?, Product_Category.Stock_Sell = ?
            WHERE Product_Category.Id_Product_Category = ?");
            $qts =$y-$x;
            $req->bind_param('iii', $qts, $x, $_SESSION['panier']['id_produit'][$i]);
            $res = $req->execute();
        }

        unset($_SESSION['panier']);

    }


}
?>