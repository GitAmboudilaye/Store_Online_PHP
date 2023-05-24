<?php

     include '../model/productDB.php';
   
     // Create object
     $productObj = new ProductDB();
   
     $categoryproducts = $productObj->DisplayProduct();
     

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Bootstrap Theme The Band</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="styles.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .band-pub{
        width: 90%;
        margin: auto;
    }
    .container_product {
        /*background: white;*/
        color: #bdbdbd;
        margin-top: 10px;
    }
    .container_product_categories {
    width: 100%;
    min-height: 20px;
    /*box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);*/
    border: #777 solid 0.5px;
    /*background-color: red;*/
    margin-top: 0px;
    margin: auto;
    
    }
  .display_product {
    width: 100%;
    min-height: 300px;
    display: flex;

    /*flex-wrap: wrap;*/
    
    margin: auto;
  }
  
  .display_categories {
    width: 100%;
    height: 20px;
    /*box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);*/
    /*border: #777 solid 0.5px;*/
    /*background-color: red;*/
    margin: auto;
    margin-bottom: 20px;
    
  }
  .item_product{
    height: 250px;
    /*border: #777 solid 0.5px;*/
    margin-right: 10px;
    width: calc(15% - 10px);
    margin-bottom: 20px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
  }
  .item_img{
    width: 100%;
    height: 90%;
    position: relative;
  }
  .item_desc{
    width: 100%;
    height: 10%;
    background-color: blue;
  }
  .item {
    width: 100%;
    height: 10%;
  }
  .Achat{
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(100, 157, 211, 0.24);
    
    z-index: -1;
    display: flex;
    justify-content: center;
    align-items: center;  
}
.Achat a{
    width: 100px;
    height: 40px;
    background-color: white;
   text-align: center;
    line-height: 1.6;
    border-radius: 3px;
    text-decoration: none;
}
.item_img:hover .Achat{
    z-index: 1;
}
.body {
    
    background-color: white;
    width: 80%;
    min-height: 700px;
    margin: auto;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    /*border: solid;*/
    
  }
  h3, h4 {
    margin: 10px 0 30px 0;
    letter-spacing: 10px;      
    font-size: 20px;
    color: #111;
  }
  

  
  footer {
    background-color: #2d2d30;
    color: #f5f5f5;
    padding: 32px;
  }
  footer a {
    color: #f5f5f5;
  }
  footer a:hover {
    color: #777;
    text-decoration: none;
  }  
  .form-control {
    border-radius: 0;
  }
 /************************ */
 .menunav{
    background-color: #3ED6FF;

 }
 .band-pub {
  max-width: 100%;
  max-height: 200px;
  min-height: 150px;
}
 


  </style>
</head>
  <body style="with :100%; min-height: 700px; background-color: whitesmoke; overflow-x: hidden;" >
  <nav class=" menunav">
  <div class="container">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right"> 
        <li><a href="http://localhost/Cours_CM/projetsession/view/test.php">ACCEUIL</a></li>
        
        
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">PLUS
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Se connecter</a></li>
            <li><a href="#">S'inscrire</a></li>
          </ul>
        </li>
        <li ><a  href="panier.php"><i class='bx bx-cart iconepanier '></i></a></li>
      </ul>
    </div>
  </div>
</nav>
     <div class="body">
     <div id="myCarousel" class="carousel slide band-pub" data-ride="carousel" >
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
      

      <img src=".../photos/jaune.jpeg" alt="New York" >
        <div class="carousel-caption">
          <h3>New York</h3>
          <p>The atmosphere in New York is lorem ipsum.</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
          <div class="container_product">
    <?php
        foreach ($categoryproducts as $category => $products) {
          if (!empty($products)) {
    ?>
    <div class = "container_product_categories">
        
        <div class="display_categories">
            <span> <?php echo $category?></span>
        </div>
        <div class="display_product">
        <?php
            foreach($products as $product){
        ?>
            <div class="item_product">
                <div class ="item_img" >
                    <img src="../<?php echo $product['Photo'] ?>" alt="" style="width:100%;height:100%">
                    <div class="Achat">
                        <a href="../controllers/panierhandler.php?addpanier=<?php echo $product['Id_Product_Category'] ?>" onclick="return confirm('Vous êtes sur le point d\'ajouter au panier?');">Panier</a>
                    </div>
                </div> 
                <div class ="item_desc">
                    <strong><?php echo'$'. $product['Prix'] ?></strong>
                </div>
            </div>
            <?php
            }
            ?>
            
        </div>
    </div>
    <br>
    <br>
    <?php
            
          }
        }
    ?>   
    </div>
  
    </div>
    <footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p> <a href="http://localhost/Cours_CM/projetsession/view/test.php" data-toggle="tooltip" title="Visit w3schools">Acceuil</a></p> 
</footer>

<?php
  //require_once('paniernew.php')
?>
      <script src="scripts.js"></script>
  </body>
</html>
