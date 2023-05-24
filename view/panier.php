<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
  <?php

include '../controllers/panierhandler.php';

if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
	
?>
<div id="panier-dialog" class="panier-dialog" >
    <div class="panier">
      <h1 class="containermain">Votre panier est vide</h1>
    </div>
    <span id="btnCloseDialog" class="close">&times;</span>
</div>
<?php    
}else{
    
?>
<div id="panier-dialog" class="panier-dialog" >
<?php    
for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
	
{
?>
    <div class="panier">
      <div class="produit">
        <div class="image">
          <img src="../<?php echo $_SESSION['panier']['photo'][$i]; ?>" alt="produit">
        </div>
        <div class="description">
          <div class="titre">
            <h2> <?php echo $_SESSION['panier']['category'][$i];   ?></h2>
          </div>
          <div class="prix">
            <div class="devise">
              <p>$<?php echo $_SESSION['panier']['prix'][$i];   ?></p>
            </div>
            <div class="quantite">
              
              
             <form action="../controllers/panierhandler.php?id_produit=<?php echo $_SESSION['panier']['id_produit'][$i]; ?>" method="POST">
              <input type="submit" name="decrement" value="-" class="soustraire">
              <input class="input" id="quantite" type="number" value=<?php echo $_SESSION['panier']['quantite'][$i]; ?>>
              <input type="submit" name="increment" value="+" class="ajouter">
             </form>
              
            </div>
            <div class="sous-total">
              <p >   $ <?php echo $panier->montantparproduit($_SESSION['panier']['id_produit'][$i]); ?> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php    
}
?>
    <div class="panier">
      <div class="total">
        <div class="titre">
          <h2>Total</h2>
        </div>
        <div class="montant">
          <p>$<?php echo $panier->montantTotal(); ?></p>
        </div>
      </div>
      <div class="caisse">
          <div><a href='../controllers/panierhandler.php?action=vider'>Vider mon panier</a></div>
          <div><a href='../controllers/panierhandler.php?action=payer'>Passer à la caisse</a></div>
        
      </div>
    </div>
    <span id="btnCloseDialog" class="close">&times;</span>
    </div>
<?php    
}
?>
<script src="scripts.js"></script>

  </body>
</html>
