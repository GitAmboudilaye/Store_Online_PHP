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

		td {
			padding: 10px;
		}

		label {
			display: inline-block;
			width: 100px;
			text-align: right;
		}
        input{
            width: 100%;
            
        }
        textarea{
            resize: none;
            width: 100%;
            height: 300px;
        }
	</style>
</head>
<body>
<form class="form-center" action="../controllers/producthandler.php?action=addcategory" method="POST">
    <table >
        <tr>
            <td>Nom :</td>
            <td><input type="text" name="nom" required></td>
        </tr>
        <tr>
            <td>Description :</td>
            <td><textarea name="description"  required ></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Ajouter la catégorie"></td>
        </tr>
    </table>
</form>
</body>
