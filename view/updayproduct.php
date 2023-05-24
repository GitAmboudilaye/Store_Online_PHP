<?php
//header.........................................channel......................
	include '../model/productDB.php';
	
	$product = new ProductDB();
	if(isset($_GET['resultat'])){
		$resultat = urldecode($_GET['resultat']);
		$resultat = unserialize($resultat);
	}
	
    /*if(isset($_GET) && $_GET['action'] == 'updaybyid' && $_GET['id_product']){
        echo 'error 6: upday';
        $resultat =$product->DisplayProductbyId($_GET['id_product']);
    }*/
	//http://localhost/Cours_CM/projetsession/view/addproduct.php
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Formulaire</title>
	<style>
		.form-center {
 			margin: 0 auto;
  			width: 50%;
			background-color: aquamarine;
		}
		table {
            width: 100%;
            /*background-color: red;*/
			border-collapse: collapse;
		}
		td{
			padding: 10px;
		}
		.tdcols1 {
			
			width: 25%;
		}
		.tdcols2 {
			
			width: 75%;
		}

		label {
			display: inline-block;
			width: 100px;
			text-align: right;
		}
        input[type='text'], 
		input[type ='submit'], 
		input[type ="Number"],
		input[type ="Decimal"]{
            width: 100%;
			height: 30px;
            
        }

		label {
			display: inline-block;
			width: 100px;
			text-align: right;
		}
	</style>
</head>
<body>
	<form class="form-center" action="../controllers/producthandler.php?action=updaybyid&id_product=<?php echo $resultat['Id_Product_Category']; ?>" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
			<td class ="tdcols1"><label for="categarie">Categorie :</label></td>
			<p> <?php echo $resultat['Id_Product_Category']; ?></p>
				<td class ="tdcols2">
				<?php
				/*<a href="../view/addcategory.php" class="btn btn-primary" style="float:right;background-color:#0513G0"> Add New Category</a>
				<?php if($category['Nom']==$resultat['Nom']) echo "checked"?>
				include '../model/category.php';
				$categories = new Categories();
			
				$categories = $categories->Displayallcategories();
				<?php if(isset($_GET['required'])) echo unserialize(urldecode($_GET['required'])) ;?>*/
				/*$n=0;
				if(!empty($categories)){
					foreach($categories as $category) {
						$n++;
						if ($n <= 2){*/

						
				?>
				<label for="<?php echo $resultat['Nom'];?>"><?php echo $resultat['Nom'];?></label>
				<input type="checkbox" name="categories[]" id="<?php echo $resultat['Nom'];?>" value="<?php echo $resultat['Nom'];?>" checked disabled >
				<?php
							/*if ($n == 2){
								echo '<br>';
								$n = 0;
							}
						}
					}
				}*/
				?>
				

				
				</td>
			</tr>
			<tr>
				<td><label for="description">Description :</label></td>
				<td><input type="text" id="description" name="description" value="<?php echo $resultat['Description_Product']; ?>" required></td>
			</tr>
			<tr>
				<td><label for="couleur">Couleur :</label></td>
				<td><input type="text" id="couleur" name="couleur" value="<?php echo $resultat['Couleur'] ?>" required></td>
			</tr>
		
			<tr>
				<td><label for="photo">Photo :</label></td>
				<td><input type="file" id="photo" name="photo" value="<?php echo $resultat['Photo'] ?>" required></td>
			</tr>
			<tr>
				<td><label for="prix">Prix :</label></td>
				<td><input type="number" step="0.1" id="prix" name="prix" value="<?php echo $resultat['Prix'] ?>" required></td>
			</tr>
			<tr>
				<td><label for="stock">Stock :</label></td>
				<td><input type="number" id="stock" name="stock" value="<?php echo $resultat['Stock_Initial'] ?>" required></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Enregistrer"></td>
			</tr>
		</table>
	</form>
</body>
</html>




