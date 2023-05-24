<?php
	/*include '../model/category.php';
    $categories = new Categories();

	$categories = $categories->Displayallcategories();*/
	
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
	<form class="form-center" action="../controllers/producthandler.php?action=insert" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td class ="tdcols1"><label for="categarie">Categorie :</label></td>
				<td class ="tdcols2">
				<?php
				include'../model/connexion.php';
				include '../model/categoryDB.php';
				$categories = new CategoryDB();
			
				$categories = $categories->Displayallcategories();

				/*<?php if(isset($_GET['required'])) echo unserialize(urldecode($_GET['required'])) ;?>*/
				$n=0;
				if(!empty($categories)){
					foreach($categories as $category) {
						$n++;
						if ($n <= 2){

						
				?>
				<label for="<?php echo $category['Nom'];?>"><?php echo $category['Nom'];?></label>
				<input type="checkbox" name="categories[]" id="<?php echo $category['Nom'];?>" value="<?php echo $category['Nom'];?>" >
				<?php
							if ($n == 2){
								echo '<br>';
								$n = 0;
							}
						}
					}
				}
				?>
				<a href="../view/addcategory.php" class="btn btn-primary" style="float:right;background-color:#0513G0"> Add New Category</a>

				
				</td>
				
			</tr>
			
			<tr>
				<td class ="tdcols1"><label for="couleur">Couleur :</label></td>
				<td class ="tdcols2"><input type="text" id="couleur" name="couleur" required></td>
			</tr>
			
			
			<tr>
				<td class ="tdcols1"><label for="photo">Photo :</label></td>
				<td class ="tdcols2"><input type="file" id="photo" name="photo" required></td>
			</tr>
			<tr>
				<td class ="tdcols1"><label for="prix">Prix :</label></td>
				<td class ="tdcols2"><input type="number" id="prix" name="prix" step="0.01" required></td>
			</tr>
			<tr>
				<td class ="tdcols1"><label for="stock">Stock :</label></td>
				<td class ="tdcols2"><input type="number" id="stock" name="stock" required></td>
			</tr>
			<tr>
				<td class ="tdcols1"><label for="description">Description :</label></td>
				<td class ="tdcols2"><input type="text" id="description" name="description" required></td>
			</tr>
		</table>
		<input type="submit" value="Enregistrer" <?php if(empty($categories)) echo  "disabled";?> >
	</form>
</body>
</html>




