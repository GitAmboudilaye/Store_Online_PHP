<?php
//http://localhost/Cours_CM/projetsession/view/dashboard.php

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <title>Customer </title>
</head>
<body>
  <form action="../controllers/producthandler.php?action=multidelete" method="POST">
    <?php 
        require_once('navAdmin.php')
    ?>

<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th><input class="checkbox_select_all" type="checkbox" name="categories[]"></th>
        <th>Id</th>
        <th>Couleur</th>
        <th>Prix</th>
        <th>Stock Initial</th>
        <th>Stock Vendu</th>
        <th>Photo</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Include customers class
      include '../model/productDB.php';
      include '../model/categoryDB.php';
    
      // Create object
      $productObj = new ProductDB();
    
      $categoryproducts = $productObj->DisplayProduct();
      foreach ($categoryproducts as $category => $products) {   
      ?>
      <tr class="table-primary">
        <th colspan="8"><h4><?php echo $category?></h4></th>
      </tr>
      <?php
        foreach($products as $product){
      ?>
      <tr>
        <td><input class="checkbox_item" type="checkbox" name="id_array[]" value="<?php echo $product['Id_Product_Category']?>"></td>
        <td><?php echo $product['Id_Product'] ?></td>
        <td><?php echo $product['Couleur'] ?></td>
        <td><?php echo $product['Prix'] ?></td>
        <td><?php echo $product['Stock_Initial'] ?></td>
        <td><?php echo $product['Stock_Sell'] ?></td>
        <td><img src="../<?php echo $product['Photo'] ?>" alt="" style="width:50px;height:50px"></td>
        <td>
          <div class="btn-group">
            <a href="../controllers/producthandler.php?action=editbyid&id_product=<?php echo $product['Id_Product_Category']?>" class="btn btn-success">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            <a href="../controllers/producthandler.php?action=deletebyid&id_product=<?php echo $product['Id_Product_Category']?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
          </div>
        </td> 
      </tr>
      <?php
        }
      }
      ?>
      <tr>
        <td><input type="submit" value="Supprimer" class="btn btn-danger"></td>
        <td colspan="7"></td>
      </tr>
    </tbody>
  </table>   
</div>
  </form>

    <script src="../StyleJavaScript/checkbox.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
