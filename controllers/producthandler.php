<?php




//http://localhost/Boutique_Online/view/dashboard.php


    include '../model/productDB.php';
    include '../model/categoryDB.php';

    $product = new ProductDB();
    $category = new CategoryDB();

    if(!isset($_POST) && !isset($_GET)){
        $categories = $_POST['categories'];
        if(empty($categories)){
            $require ="required";
            $require = urlencode(serialize($require));
            header('Location:../view/addproduct.php?required='.$require);
            exit;
        }
        $product->Insertdata($_POST);
        
    }
    
    //if(isset($_POST['action']) && $_POST['action'] == 'insert' && isset($_POST['submit'])) {
      //  echo 'error 4';
    //Reauest POST
    //Action Insert data
    if(isset($_POST) && $_GET['action'] == 'insert'){
        $categories = $_POST['categories'];
        if(empty($categories)){
            $require ="required";
            $require = urlencode(serialize($require));
            header('Location:../view/addproduct.php?required='.$require);
            exit;
        }
        $product->Insertdata($_POST);
        
    }
  
    
    //Request GET
    //Action Display all data 
    if(isset($_['action']) && $_POST['action'] == 'displayall'){

    }

    //request GET
    //Action Display data by Id (upday item)
    if(isset($_GET) && $_GET['action'] == 'editbyid' && $_GET['id_product']){
        echo 'error 6: Display by id';
        $resultat =$product->DisplayProductbyId($_GET['id_product']);
        $resultat = urlencode(serialize($resultat));
        header("Location:../view/updayproduct.php?resultat=".$resultat);
        //exit;
    }

    //request POST
    //Action Upday data by Id
    if(isset($_POST) && $_GET['action'] == 'updaybyid' && $_GET['id_product']){
        echo 'error 7: upday';
        $product->Updatercord($_GET['id_product']);
        
    }

    //Request GET
    //Action Deleted data by Id
    if(isset($_GET) && $_GET['action'] == 'deletebyid' && $_GET['id_product']){
        echo 'error 6: delete';
        $product->deleteRecord($_GET['id_product']);
    }
    //Request post
    //Action multi Deleted data by Id
    if(isset($_GET) && $_GET['action'] == 'multidelete' && isset($_POST)){
        echo 'multi delete';
        $product->deleteMultiRecord($_POST['id_array']);
    }

    //Reauest GET
    // 
    /*if(isset($_GET) && $_GET['action'] == 'addcategory'){
        $category = $category->Displayallcategories();
        $category = urlencode(serialize($category));
        header("Location:../view/addproduct.php?resultat=".$category);

    }*/

    //Request POST
    //multidelete
    if(isset($_POST) && $_GET['action'] == 'addcategory'){
        
        $category->Insertcategory($_POST);
    }

?>