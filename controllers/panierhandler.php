<?php
include '../model/panier.php';
$panier=new panier();
if(isset($_GET['addpanier']) && $_GET['addpanier'])
{
    $quantite =1;
    $produit=$panier->ajout_panier($_GET['addpanier']);
    if (!isset($_SESSION['panier']))
	{$panier->creation_Panier();}
    $panier->ajouterProduitDansPanier($produit['Nom'],$_GET['addpanier'],$quantite,$produit['Prix'], $produit['Photo']);
    header('Location:../view/test.php');
    echo 'testetstetets'.$produit['Photo'];
    echo 'ddddddd'.$_SESSION['panier']['photo'][1];
}

//retirer un produit du panier
if(isset($_GET['action']) && $_GET['action'] == "retirer")
{
	$panier->retirerproduitDuPanier($_GET['id_produit']);
}

//vider le panier
if((isset($_GET['action']) && $_GET['action'] == "vider"))
{
	$panier->viderpanier();
    header('Location:http://localhost/Cours_CM/projetsession/view/test.php');
}
//payer le panier
if((isset($_GET['action']) && $_GET['action'] == "payer"))
{
	$panier->valider_paiement();
    header('Location:http://localhost/Cours_CM/projetsession/view/test.php');
}
//MAJ de stock dans la base de données
if(isset($_POST['payer']))
{
   // $produit=$panier->valider_paiement();
    //$panier->viderpanier();
}

if(isset($_POST['decrement']) && isset($_GET['id_produit']))
{
    $panier->decrementQuantite($_GET['id_produit']);
    header('Location:../view/panier.php');
	echo "super ---";
}
if(isset($_POST['increment'])  && isset($_GET['id_produit']))
{
    $panier->incrementQuantite($_GET['id_produit']);
    header('Location:../view/panier.php');
	echo "super +++";
}
?>