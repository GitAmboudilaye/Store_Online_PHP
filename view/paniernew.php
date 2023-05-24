<?php

include '../controllers/panierhandler.php';

if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
	
?>
<div id="panier-dialog" class="dialog" >
    <div class="panier">
      <h1 class="containermain">Votre panier est vide</h1>
    </div>
    <span id="btnCloseDialog" class="close">&times;</span>
</div>
<?php    
}else{
    
?>
<div id="panier-dialog" class="dialog" >
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
              
              
              <button class="soustraire">-</button>
              <input class="input" id="quantite" type="number" value=<?php echo $_SESSION['panier']['quantite'][$i];   ?>>
              <input class="hidden" id="id_produit" type="number" value=<?php echo $_SESSION['panier']['id_produit'][$i];   ?>>
              <button class="ajouter">+</button>
              
              
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
          <div><a href='../controllers/pqnierhqndler.php?action=pqyer'>Passer à la caisse</a></div>
        
      </div>
    </div>
    <span id="btnCloseDialog" class="close">&times;</span>
    </div>
<?php    
}
?>